<?php
namespace App\Providers;

use App\Domains\Files\Listeners\AttachmentObserver;
use App\Domains\Files\Listeners\ClearCachedZipListener;
use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Events\MaterialChangedEvent;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Observers\MaterialObserver;
use App\Domains\Reviews\Events\ReviewStartedEvent;
use App\Domains\Users\Events\UserLoggedInViaSocialiteEvent;
use App\Domains\Users\Listeners\AdjustUserEmailConfirmationListener;
use App\Domains\Users\Listeners\LogMaterialStateChangeListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Microsoft\MicrosoftExtendSocialite;
use Spatie\ModelStates\Events\StateChanged;

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
        StateChanged::class                  => [
            LogMaterialStateChangeListener::class,
        ],
        ReviewStartedEvent::class            => [],
    ];

    /**
     * @var array<class-string, array<int, class-string>>
     */
    protected $observers = [
        Material::class   => [MaterialObserver::class],
        Attachment::class => [AttachmentObserver::class],
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
