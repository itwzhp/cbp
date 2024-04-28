<?php
namespace App\Domains\Files\Listeners;

use App\Abstracts\AbstractQueuedListener;
use App\Domains\Files\ZipService;
use App\Domains\Materials\Events\MaterialChangedEvent;

class ClearCachedZipListener extends AbstractQueuedListener
{
    public function handle(MaterialChangedEvent $event)
    {
        app(ZipService::class)->deleteZipForMaterial($event->material);
    }
}
