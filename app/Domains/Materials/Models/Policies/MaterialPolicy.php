<?php
namespace App\Domains\Materials\Models\Policies;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RoleHelper;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole(RoleHelper::ADMIN);
    }

    public function view(User $user, Material $material): bool
    {
        if ($material->isPublished()) {
            return true;
        }

        return $this->update($user, $material);
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo(RoleHelper::MATERIAL_CREATE);
    }

    public function update(User $user, Material $material): bool
    {
        if ($user->hasRole(RoleHelper::ADMIN)) {
            return true;
        }

        if ($user->can(RoleHelper::MATERIAL_EDIT_ANY)) {
            return true;
        }

        if ($user->can(RoleHelper::MATERIAL_EDIT_OWN)) {
            if ($material->user_id !== $user->id) {
                return false;
            }

            return $material->hasEditableState();
        }

        return false;
    }

    public function delete(User $user, Material $material): bool
    {
        return $this->update($user, $material);
    }

    public function restore(User $user, Material $material): bool
    {
        return $user->hasRole(RoleHelper::ADMIN);
    }

    public function forceDelete(User $user, Material $material): bool
    {
        return $user->hasRole(RoleHelper::ADMIN);
    }
}
