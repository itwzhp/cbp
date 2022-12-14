<?php
namespace App\Domains\Migration\Commands;

use App\Helpers\FilesystemsHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixLinksInDescription extends Command
{
    public const QUERY = 'update materials set description = REPLACE(description, ?, ?)';
    public const BAD_DOMAINS = [
        'https://cbp.zhp.pl/wp-content/uploads',
        'http://cbp.zhp.pl/wp-content/uploads',
    ];

    protected $signature = 'wp:links';

    public function __invoke()
    {
        $replaceUrl = config('filesystems.disks.' . FilesystemsHelper::PUBLIC . '.url') . 'public';

        foreach (static::BAD_DOMAINS as $domain) {
            DB::statement(static::QUERY, [$domain, $replaceUrl]);
        }
    }
}
