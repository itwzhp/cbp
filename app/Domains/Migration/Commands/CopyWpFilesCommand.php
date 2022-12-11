<?php
namespace App\Domains\Migration\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class CopyWpFilesCommand extends Command
{
    protected $signature = 'wp:files {dir?}';

    protected Filesystem $local;

    protected Filesystem $azure;

    public function __invoke()
    {
        $this->local = Storage::disk('wp_local');
        $this->azure = Storage::disk('azure_public');

        $dir = $this->argument('dir') ?? $this->selectDir();

        foreach ($this->local->allFiles($dir) as $filePath) {
            if ($this->azure->exists($filePath)) {
                continue;
            }

            $this->info("Uploading: {$filePath}");
            $file = $this->azure->put($filePath, $this->local->get($filePath));
        }

        $this->info('Finished');
    }

    protected function selectDir(): string
    {
        $dirs = array_values(Arr::sort($this->local->directories('/', false)));

        return $this->choice('Which directory?', $dirs);
    }
}
