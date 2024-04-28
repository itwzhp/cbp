<?php
namespace App\Abstracts;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AbstractEvent
{
    use SerializesModels;
    use Dispatchable;
    use InteractsWithSockets;
}
