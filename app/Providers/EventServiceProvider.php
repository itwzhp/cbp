<?php
namespace App\Providers;

use App\Domains\Files\Listeners\ClearCachedZipListener;
use App\Domains\Materials\Events\MaterialChangedEvent;
use App\Domains\Users\Events\UserLoggedInViaSocialiteEvent;
use App\Domains\Users\Listeners\AdjustUserEmailConfirmationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Microsoft\MicrosoftExtendSocialite;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class                    => [
            SendEmailVerificationNotification::class,
        ],
        SocialiteWasCalled::class            => [
            MicrosoftExtendSocialite::class . '@handle',
        ],
        UserLoggedInViaSocialiteEvent::class => [
            AdjustUserEmailConfirmationListener::class,
        ],
        MaterialChangedEvent::class          => [
            ClearCachedZipListener::class,

        ],
    ];

    public function boot()
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
