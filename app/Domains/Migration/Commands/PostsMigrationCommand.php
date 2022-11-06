<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Field;
use App\Domains\Materials\Models\Licence;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Materials\States\Published;
use App\Domains\Migration\Models\Post;
use App\Domains\Migration\Models\Postmeta;
use App\Domains\Users\Repositories\UsersRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class PostsMigrationCommand extends Command
{
    const FIELD_MAP = [
        'wpcf-dane-recenzenta' => Field::TYPE_REVIEWER,
        'wpcf-dane-autora'     => Field::TYPE_AUTHOR,
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
        /** @var Post $posts */
        $posts = Post::find(11572);

        $this->importPost($posts);
    }

    protected function importPost(Post $post): Material
    {
        $author = $this->usersRepository->findByWpId($post->post_author);
        if ($author === null) {
            throw new \InvalidArgumentException('Missing author');
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

        $material->tags()->detach();

        foreach ($post->motifs() as $motif) {
            $material->tags()->attach($motif->id);
        }

        foreach ($post->tagIds() as $wpId) {
            $this->tagsRepository->attachWpTag($material, $wpId);
        }

        $this->mapFields($post, $material);
        $this->attachFiles($post, $material);

        return $material;
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

                $material->fields()->firstOrCreate([
                    'type'  => $fieldType,
                    'value' => $postMeta->meta_value,
                ]);
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
            $material->fields()->firstOrCreate([
                'type'  => $type,
                'value' => $arField->meta_value,
            ]);
        }
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
}
