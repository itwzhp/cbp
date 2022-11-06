<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Repositories\MotifsRepository;
use App\Domains\Migration\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class PostsMigrationCommand extends Command
{
    protected $signature = 'wp:posts';

    public function __invoke()
    {
        $posts = Post::find(10598);

        dd(array_values(Arr::flatten($posts->motyw()->deserialize())));
    }
}
