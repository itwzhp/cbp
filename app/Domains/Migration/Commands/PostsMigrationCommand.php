<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Migration\Models\Post;
use Illuminate\Console\Command;

class PostsMigrationCommand extends Command
{
    protected $signature = 'wp:posts';

    public function __invoke()
    {
        /** @var Post $posts */
        $posts = Post::find(10598);


        dd($posts->motifs()->toArray());
    }
}
