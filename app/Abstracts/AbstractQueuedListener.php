<?php
namespace App\Abstracts;

use Illuminate\Contracts\Queue\ShouldQueue;

abstract class AbstractQueuedListener extends AbstractListener implements ShouldQueue
{
    //
}
