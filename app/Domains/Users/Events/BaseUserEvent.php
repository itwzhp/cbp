<?php
namespace App\Domains\Users\Events;

use App\Domains\Users\Models\User;
use Illuminate\Queue\SerializesModels;

abstract class BaseUserEvent
{
    use SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
