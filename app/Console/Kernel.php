<?php
namespace App\Console;

use App\Console\Commands\PintCommand;
use App\Domains\Files\Commands\LinkWpFilesStorageCommand;
use App\Domains\Materials\Commands\RegenerateSlugsCommand;
use App\Domains\Migration\Commands\AttachImagesCommand;
use App\Domains\Migration\Commands\AttachImagesToTagsCommand;
use App\Domains\Migration\Commands\CopyWpFilesCommand;
use App\Domains\Migration\Commands\FixFilesCommand;
use App\Domains\Migration\Commands\FixLinksInDescription;
use App\Domains\Migration\Commands\MaterialsMergerCommand;
use App\Domains\Migration\Commands\MergeAccountDuplicatesCommand;
use App\Domains\Migration\Commands\PostsMigrationCommand;
use App\Domains\Migration\Commands\ReattachAttachmentsCommand;
use App\Domains\Migration\Commands\RefreshCommand;
use App\Domains\Migration\Commands\RemoveDuplicateAttachmentsCommand;
use App\Domains\Migration\Commands\SanitizeFieldsValuesCommand;
use App\Domains\Migration\Commands\TagsMigrationCommand;
use App\Domains\Migration\Commands\TaxonomyChangerCommand;
use App\Domains\Migration\Commands\UsersMigrationCommand;
use App\Domains\Migration\Commands\WpImportCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        UsersMigrationCommand::class,
        TagsMigrationCommand::class,
        PostsMigrationCommand::class,
        WpImportCommand::class,
        RefreshCommand::class,
        LinkWpFilesStorageCommand::class,
        RegenerateSlugsCommand::class,
        CopyWpFilesCommand::class,
        RemoveDuplicateAttachmentsCommand::class,
        FixLinksInDescription::class,
        AttachImagesCommand::class,
        TaxonomyChangerCommand::class,
        AttachImagesToTagsCommand::class,
        SanitizeFieldsValuesCommand::class,
        PintCommand::class,
        MaterialsMergerCommand::class,
        MergeAccountDuplicatesCommand::class,
        ReattachAttachmentsCommand::class,
        FixFilesCommand::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('sanctum:prune-expired --hours=24')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
