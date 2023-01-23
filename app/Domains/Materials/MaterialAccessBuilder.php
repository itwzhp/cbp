<?php
namespace App\Domains\Materials;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RoleHelper;
use Illuminate\Database\Eloquent\Builder;

class MaterialAccessBuilder
{
    public static function forUser(User $user)
    {
        if ($user->hasRole(RoleHelper::ADMIN)) {
            return Material::query();
        }

        if ($user->hasRole(RoleHelper::EDITOR)) {
            return Material::query();
        }

        if ($user->hasRole(RoleHelper::REVIEWER)) {
            return Material::where(function (Builder $query) use ($user) {
                return $query
                    ->forOwner($user)
                    ->orWhereHas('reviews', function (Builder $subquery) use ($user) {
                        $subquery->where('user_id', $user->id);
                    });
            });
        }

        if ($user->hasRole(RoleHelper::AUTHOR)) {
            return Material::forOwner($user);
        }

        return Material::where('user_id', '=', 0);
    }
}
