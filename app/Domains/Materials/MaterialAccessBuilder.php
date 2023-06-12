<?php
namespace App\Domains\Materials;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RolesEnum;
use Illuminate\Database\Eloquent\Builder;

class MaterialAccessBuilder
{
    const SCOPE_REVIEW = 'reviewer';
    const SCOPE_OWNER = 'owner';

    public static function forUser(User $user, ?string $scope): Builder
    {
        $query = static::getQuery($user);

        if (empty($scope)) {
            return $query;
        }

        if ($scope === static::SCOPE_REVIEW) {
            return $query->whereHas('reviews', function (Builder $subquery) use ($user) {
                $subquery->where('user_id', $user->id);
            });
        }

        if ($scope === static::SCOPE_OWNER) {
            return $query->forOwner($user);
        }

        return $query->where('user_id', '=', 0);
    }

    protected static function getQuery(User $user): Builder
    {
        if ($user->hasRole(RolesEnum::ADMIN)) {
            return Material::query();
        }

        if ($user->hasRole(RolesEnum::EDITOR)) {
            return Material::query();
        }

        if ($user->hasRole(RolesEnum::REVIEWER)) {
            return Material::where(function (Builder $query) use ($user) {
                return $query
                    ->forOwner($user)
                    ->orWhereHas('reviews', function (Builder $subquery) use ($user) {
                        $subquery->where('user_id', $user->id);
                    });
            });
        }

        if ($user->hasRole(RolesEnum::AUTHOR)) {
            return Material::forOwner($user);
        }

        return Material::where('user_id', '=', 0);
    }
}
