<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class PintCommand extends Command
{
    protected $signature = 'pint';

    public function __invoke(): int
    {
        $process = (new Process([
            './vendor/bin/pint',
            '--config',
            'vendor/apsg/coding-standards/pint.json',
        ]))->setTimeout(null);

        return $process->run(function ($type, $line) {
            $this->output->write($line);
        });
    }
}
