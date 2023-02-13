<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class PintCommand extends Command
{
    protected $signature = 'pint';

    public function __invoke()
    {
        return exec('./vendor/bin/pint --config vendor/apsg/coding-standards/pint.json');
    }
}
