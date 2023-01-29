<?php
namespace App\Domains\Users\Listeners;

use App\Domains\Materials\States\Archived;
use App\Domains\Materials\States\Published;
use App\Domains\Users\ActionsEnum;
use App\Domains\Users\Repositories\UserLogsRepository;
use Illuminate\Support\Facades\Auth;
use Spatie\ModelStates\Events\StateChanged;

class LogMaterialStateChangeListener
{
    protected UserLogsRepository $userLogs;

    protected array $actionsLUT = [
        Published::class => ActionsEnum::PUBLISHED,
        Archived::class  => ActionsEnum::ARCHIVED,
    ];

    public function __construct()
    {
        $this->userLogs = app(UserLogsRepository::class);
    }

    public function handle(StateChanged $event): void
    {
        if (Auth::guest()) {
            return;
        }

        if (!array_key_exists(get_class($event->finalState), $this->actionsLUT)) {
            return;
        }

        $this->userLogs->log(
            Auth::user(),
            $this->actionsLUT[get_class($event->finalState)],
            $event->model,
        );
    }
}
