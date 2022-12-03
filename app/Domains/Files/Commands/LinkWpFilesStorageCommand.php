<?php
namespace App\Domains\Files\Commands;

use ErrorException;
use Illuminate\Console\Command;

class LinkWpFilesStorageCommand extends Command
{
    protected $signature = 'wp:storage';

    public function __invoke()
    {
        $source = storage_path('wp');
        $target = public_path('wp');

        try {
            $this->laravel->make('files')->link($source, $target);
        } catch (ErrorException $exception) {
            $this->error('Error. Target directory probably already exists.');
        }
    }
}
