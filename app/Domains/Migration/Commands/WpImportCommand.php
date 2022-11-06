<?php
namespace App\Domains\Migration\Commands;

use Illuminate\Console\Command;

class WpImportCommand extends Command
{
    protected $signature = 'wp:import';

    public function __invoke()
    {
//        $this->call('db:seed');
        $this->call(UsersMigrationCommand::class);
        $this->call(TagsMigrationCommand::class);
    }
}
