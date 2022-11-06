<?php
namespace App\Console;

use App\Domains\Migration\Commands\PostsMigrationCommand;
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
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
