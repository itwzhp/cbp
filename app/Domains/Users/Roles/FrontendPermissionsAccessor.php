<?php
namespace App\Domains\Users\Roles;

use App\Domains\Users\Models\User;
use Illuminate\Contracts\Support\Arrayable;

class FrontendPermissionsAccessor implements Arrayable
{
    const PERMISSIONS = [
        RoleHelper::MATERIAL_CREATE,
        RoleHelper::MATERIAL_PUBLISH,
        RoleHelper::MATERIAL_REVIEW,
    ];

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function toArray(): array
    {
        return collect(static::PERMISSIONS)
            ->map(function ($permission) {
                return $this->user->can($permission) ? $permission : null;
            })
            ->filter()
            ->toArray();
    }
}
