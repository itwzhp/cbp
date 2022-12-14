<?php
namespace App\Domains\Users\Listeners;

use App\Domains\Users\Events\UserLoggedInViaSocialiteEvent;
use Carbon\Carbon;

class AdjustUserEmailConfirmationListener
{
    public function handle(UserLoggedInViaSocialiteEvent $event)
    {
        if (!empty($event->user->email_verified_at)) {
            return;
        }

        $event->user->update([
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
