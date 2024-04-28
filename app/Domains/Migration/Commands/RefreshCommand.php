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

        $this->info('Database prepared. Importing users and tags.');
        $this->call(WpImportCommand::class);

        $this->info('Importing posts...');
        $this->call(PostsMigrationCommand::class);

        $this->info('Fixing hardcoded links');
        $this->call(FixLinksInDescription::class);

        $this->info('Removing duplicate attachments and creating cover photos');
        $this->call(RemoveDuplicateAttachmentsCommand::class);

        $this->info('Attaching new taxonomies');
        $this->call(TaxonomyChangerCommand::class);

        $this->info('Attaching images to tags');
        $this->call(AttachImagesToTagsCommand::class);

        $this->info('Merging materials');
        $this->call(MaterialsMergerCommand::class);
    }
}
