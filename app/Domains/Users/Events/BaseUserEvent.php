<?php
namespace App\Domains\Users\Events;

use App\Abstracts\AbstractEvent;
use App\Domains\Users\Models\User;

abstract class BaseUserEvent extends AbstractEvent
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
