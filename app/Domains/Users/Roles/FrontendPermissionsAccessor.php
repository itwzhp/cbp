<?php
namespace App\Domains\Users\Roles;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use Illuminate\Contracts\Support\Arrayable;

class FrontendPermissionsAccessor implements Arrayable
{
    const PERMISSIONS = [
        PermissionsEnum::MATERIAL_CREATE,
        PermissionsEnum::MATERIAL_PUBLISH,
        PermissionsEnum::MATERIAL_REVIEW,
        PermissionsEnum::MATERIAL_MANAGE,
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

    public function actionsOn(Material $material): array
    {
        return collect(MaterialActionsEnum::cases())
            ->map(function (MaterialActionsEnum $action) use ($material) {
                return $this->user->can($action->value, $material) ? $action->value : null;
            })
            ->filter()
            ->toArray();
    }
}
