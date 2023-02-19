<?php
namespace App\Domains\Users\Roles;

use App\Domains\Users\Models\User;
use Illuminate\Contracts\Support\Arrayable;

class FrontendPermissionsAccessor implements Arrayable
{
    const PERMISSIONS = [
        PermissionsEnum::MATERIAL_CREATE,
        PermissionsEnum::MATERIAL_PUBLISH,
        PermissionsEnum::MATERIAL_REVIEW,
    ];

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toArray(): array
    {
        return collect(static::PERMISSIONS)
            ->map(function (PermissionsEnum $permission) {
                return $this->user->can($permission->value) ? $permission->value : null;
            })
            ->filter()
            ->toArray();
    }
}
