<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Licence;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Materials\States\Published;
use App\Domains\Migration\Models\Post;
use App\Domains\Users\Repositories\UsersRepository;
use Illuminate\Console\Command;

class PostsMigrationCommand extends Command
{
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
        $posts = Post::find(10598);

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

        return $material;
    }
}
