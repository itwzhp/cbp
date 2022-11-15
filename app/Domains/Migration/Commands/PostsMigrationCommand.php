<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Field;
use App\Domains\Materials\Models\Licence;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Materials\States\Published;
use App\Domains\Migration\Helpers\TypesHelper;
use App\Domains\Migration\Models\Post;
use App\Domains\Migration\Models\Postmeta;
use App\Domains\Migration\Operators\Zalacznik;
use App\Domains\Users\Repositories\UsersRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Throwable;

class PostsMigrationCommand extends Command
{
    const FIELD_MAP = [
        'wpcf-dane-recenzenta' => Field::TYPE_REVIEWER,
        'wpcf-dane-autora'     => Field::TYPE_AUTHOR,
        'wpcf-tresc'           => Field::TYPE_CONTENT,
        'wpcf-zamierzenia'     => Field::TYPE_INTENT,
    ];

    protected $signature = 'wp:posts';

    protected UsersRepository $usersRepository;

    protected TagsRepository $tagsRepository;

    public function __construct()
    {
        parent::__construct();

        $this->usersRepository = app(UsersRepository::class);
        $this->tagsRepository = app(TagsRepository::class);
    }

    public function __invoke()
    {
        $this->importPostsOfType('poradniki');
        $this->importPostsOfType('programy');
        $this->importPostsOfType('propozycje');
        $this->importPostsOfType('ksztalcenie');
    }

    protected function importPostsOfType(string $type)
    {
        $posts = Post::published()->where('post_type', $type)->get();

        /** @var Post $post */
        foreach ($posts as $post) {
            try {
                $this->info("Importing post: {$post->post_title}");
                DB::transaction(function () use ($post, $type) {
                    $this->importPost($post, $type);
                });
            } catch (\Exception $exception) {
                $this->error("Post id: {$post->ID}");
                $this->error($exception->getMessage());
            }
        }
    }

    protected function importPost(Post $post, string $type = null): Material
    {
        $author = $this->usersRepository->findByWpId($post->post_author);
        if ($author === null) {
            throw new InvalidArgumentException('Missing author');
        }

        $licence = Licence::where('wp_id', $post->licence())->first();

        /** @var Material $material */
        $material = Material::updateOrCreate([
            'wp_id' => $post->ID,
        ], [
            'user_id'      => $author->id,
            'state'        => Published::class,
            'published_at' => $post->post_date_gmt,
            'title'        => $post->post_title,
            'description'  => strip_tags($post->post_content, '<p><strong><img><span>'),
            'slug'         => $post->post_name,
            'licence_id'   => $licence->id ?? null,
        ]);

        $this->addTags($post, $material, $type);

        $material->fields()->delete();
        $this->mapFields($post, $material);

        $material->attachments()->delete();
        $this->attachFiles($post, $material);

        $this->attachSetup($post, $material);
        $this->attachSubposts($post, $material);

        return $material;
    }

    protected function addTags(Post $post, Material $material, ?string $type): void
    {
        $material->tags()->detach();

        $this->attachType($material, $type);

        foreach ($post->motifs() as $motif) {
            $material->tags()->attach($motif->id);
        }

        foreach ($post->tagIds() as $wpId) {
            $this->tagsRepository->attachWpTag($material, $wpId);
        }
    }

    protected function mapFields(Post $post, Material $material)
    {
        foreach (static::FIELD_MAP as $postmetaKey => $fieldType) {
            $postMetas = $post->getPostmetas($postmetaKey);

            /** @var Postmeta $postMeta */
            foreach ($postMetas as $postMeta) {
                if (empty($postMeta->meta_value)) {
                    continue;
                }

                $lines = $this->split($postMeta->meta_value);
                foreach ($lines as $line) {
                    try {
                        $material->fields()->firstOrCreate([
                            'type'  => $fieldType,
                            'value' => trim($line),
                        ]);
                    } catch (Throwable $exception) {
                        // DO nothing, we can ignore fields;
                    }
                }
            }
        }

        $this->mapFieldAuthorRedactor($post, $material);
    }

    protected function mapFieldAuthorRedactor(Post $post, Material $material)
    {
        /** @var Postmeta $arData */
        $arData = $post->getPostmetas('wpcf-red-ar')->first();

        /** @var Postmeta $arData */
        $arField = $post->getPostmetas('wpcf-red-wszystko')->first();

        $type = Field::TYPE_AUTHOR;
        if ($arData->meta_value == 2) {
            $type = Field::TYPE_REDACTOR;
        }
        if (!empty($arField->meta_value)) {
            $lines = $this->split($arField->meta_value);
            foreach ($lines as $line) {
                try {
                    $material->fields()->firstOrCreate([
                        'type'  => $type,
                        'value' => trim($line),
                    ]);
                } catch (Throwable $exception) {
                    // Do nothing, we can ignore fields;
                }
            }
        }
    }

    protected function split(string $string): array
    {
        $lines = explode(PHP_EOL, $string);
        if (count($lines) > 1) {
            return $lines;
        }

        if (strlen($string) > 128) {
            return explode(',', $string);
        }

        return [$string];
    }

    protected function attachFiles(Post $post, Material $material)
    {
        $files = $post->getPostmetas('wpcf-plik-materialu');
        foreach ($files as $file) {
            $path = $this->urlToPath($file->meta_value);
            if (Storage::exists($path)) {
                $mime = Storage::mimeType($path);
                $material->attachments()->firstOrCreate([
                    'name' => basename($path),
                    'path' => $path,
                    'mime' => $mime,
                ]);
            }
        }

        /** @var Post $attachment */
        foreach ($post->attachments as $attachment) {
            $path = $this->urlToPath($attachment->guid);

            if (Storage::exists($path)) {
                $mime = Storage::mimeType($path);
                $material->attachments()->firstOrCreate([
                    'name' => $attachment->post_title,
                    'path' => $path,
                    'mime' => $mime,
                ]);
            }
        }
    }

    protected function urlToPath(string $url): string
    {
        return Str::of(parse_url($url, PHP_URL_PATH))->after('/wp-content/uploads')->toString();
    }

    protected function attachType(Material $material, ?string $type)
    {
        $tag = TypesHelper::getTag($type);

        if ($tag === null) {
            return;
        }

        $material->tags()->attach($tag->id);
    }

    protected function attachSetup(Post $post, Material $material)
    {
        $postmetas = $post->getPostmetas();

        $material->setups()->firstOrCreate([
            'capacity_min'           => intval($postmetas->where('meta_key', 'wpcf-liczba-min')?->value('meta_value')),
            'capacity_opt'           => intval($postmetas->where('meta_key',
                'wpcf-liczba-optymalna')?->value('meta_value')),
            'capacity_max'           => intval($postmetas->where('meta_key', 'wpcf-liczba-maks')?->value('meta_value')),
            'duration'               => intval($postmetas->where('meta_key',
                'wpcf-czas-trwania')?->value('meta_value')),
            'time'                   => $postmetas->where('meta_key', 'wpcf-pora-dnia')?->value('meta_value'),
            'instructor_count'       => intval($postmetas->where('meta_key',
                'wpcf-liczba-prowadzacych')?->value('meta_value')),
            'instructor_competence'  => $postmetas
                ->where('meta_key', 'wpcf-kompetencje-prowadzacy')?->value('meta_value'),
            'remarks'                => $postmetas->where('meta_key', 'wpcf-org-uwagi')?->value('meta_value'),
            'location'               => $postmetas->where('meta_key', 'wpcf-miejsce')?->value('meta_value'),
            'technical_requirements' => $postmetas->where('meta_key', 'wpcf-warunki-techniczne')?->value('meta_value'),
            'materials'              => $postmetas->where('meta_key', 'wpcf-materialy')?->value('meta_value'),
            'participant_materials'  => $postmetas->where('meta_key',
                'wpcf-materialy-uczestnika')?->value('meta_value'),
            'participant_clothing'   => $postmetas->where('meta_key', 'wpcf-ubior-uczestnika')?->value('meta_value'),
        ]);
    }

    protected function attachSubposts(Post $post, Material $material)
    {
        /** @var Post $subpost */
        foreach ($post->subposts() as $subpost) {
            if ($subpost->post_type === 'przebieg') {
                $this->attachPrzebieg($subpost, $material);
            }

            if ($subpost->post_type === 'zalacznik') {
                $this->attachZalacznik($subpost, $material);
            }
        }
    }

    protected function attachZalacznik(Post $subpost, Material $material)
    {
        try {
            $attachment = (new Zalacznik($subpost))->toAttachment();
        } catch (InvalidArgumentException $exception) {
            dump($exception->getMessage(), $material->id);

            return;
        }

        if ($attachment->material_id) {
            $attachment->save();
        } else {
            $material->attachments()->save($attachment);
        }
    }

    protected function attachPrzebieg(Post $subpost, Material $material)
    {
        $material->scenarios()->firstOrCreate([
            'title'       => $subpost->post_title,
            'order'       => $subpost->getPostmetas('wpcf-kolejn')?->value('meta_value'),
            'form'        => $subpost->getPostmetas('wpcf-forma')?->value('meta_value'),
            'duration'    => $subpost->getPostmetas('wpcf-czas')?->value('meta_value'),
            'responsible' => $subpost->getPostmetas('wpcf-odpowiedzialny')?->value('meta_value'),
            'description' => $subpost->getPostmetas('wpcf-opis-czynnosci')?->value('meta_value'),
            'materials'   => $subpost->getPostmetas('wpcf-materialy-i-zalaczniki')?->value('meta_value'),
            'wp_id'       => $subpost->ID,
        ]);
    }
}
