<?php
namespace App\Console;

use App\Domains\Files\Commands\LinkWpFilesStorageCommand;
use App\Domains\Materials\Commands\RegenerateSlugsCommand;
use App\Domains\Migration\Commands\AttachImagesCommand;
use App\Domains\Migration\Commands\CopyWpFilesCommand;
use App\Domains\Migration\Commands\FixLinksInDescription;
use App\Domains\Migration\Commands\PostsMigrationCommand;
use App\Domains\Migration\Commands\RefreshCommand;
use App\Domains\Migration\Commands\RemoveDuplicateAttachmentsCommand;
use App\Domains\Migration\Commands\TagsMigrationCommand;
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
    ];

    protected function schedule(Schedule $schedule)
    {
        //
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
