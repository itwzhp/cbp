<?php
namespace App\Domains\Migration\Commands;

use Illuminate\Console\Command;

class RefreshCommand extends Command
{
    protected $signature = 'wp:refresh';

    public function __invoke()
    {
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call(WpImportCommand::class);
        $this->call(PostsMigrationCommand::class);
        $this->call(FixLinksInDescription::class);
        $this->call(RemoveDuplicateAttachmentsCommand::class);
    }
}
