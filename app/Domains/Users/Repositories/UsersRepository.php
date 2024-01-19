<?php
namespace App\Domains\Users\Repositories;

use App\Domains\Users\Models\User;
use Spatie\Permission\Models\Role;

class UsersRepository
{
    public function findByWpId(int $wpId): ?User
    {
        return User::where('wp_id', $wpId)->first();
    }

    public function toggleRole(User $user, Role $role): User
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
        } else {
            $user->assignRole($role);
        }

        return $user;
    }
}
