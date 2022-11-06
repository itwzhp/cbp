<?php
namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;

class UsersRepository
{
    public function findByWpId(int $wpId): ?User
    {
        return User::where('wp_id', $wpId)->first();
    }
}
