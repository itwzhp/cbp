<?php
namespace App\Domains\Materials\Models\Policies;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\PermissionsEnum;
use App\Domains\Users\Roles\RolesEnum;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->hasRole(RolesEnum::ADMIN);
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
        return $user->hasPermissionTo(PermissionsEnum::MATERIAL_CREATE);
    }

    public function update(User $user, Material $material): bool
    {
        if ($user->hasRole(RolesEnum::ADMIN)) {
            return true;
        }

        if ($user->hasPermissionTo(PermissionsEnum::MATERIAL_EDIT_ANY)) {
            return true;
        }

        if (!$user->hasPermissionTo(PermissionsEnum::MATERIAL_EDIT_OWN)) {
            return false;
        }
        if (!$user->owns($material)) {
            return false;
        }

        return $material->hasEditableState();
    }

    public function delete(User $user, Material $material): bool
    {
        if ($user->hasPermissionTo(PermissionsEnum::MATERIAL_MANAGE)) {
            return true;
        }

        if (!$user->owns($material)) {
            return false;
        }

        return $material->hasEditableState();
    }

    public function restore(User $user, Material $material): bool
    {
        return $user->hasRole(RolesEnum::ADMIN);
    }

    public function forceDelete(User $user, Material $material): bool
    {
        return $user->hasRole(RolesEnum::ADMIN);
    }

    public function publish(User $user, Material $material): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::MATERIAL_PUBLISH);
    }

    public function submit(User $user, Material $material): bool
    {
        if ($user->hasRole(RolesEnum::ADMIN)) {
            return true;
        }

        if (!$user->owns($material)) {
            return false;
        }

        if (!$user->hasPermissionTo(PermissionsEnum::MATERIAL_EDIT_OWN)) {
            return false;
        }

        return $material->hasEditableState();
    }

    public function archive(User $user, Material $material): bool
    {
        return $user->hasPermissionTo(PermissionsEnum::MATERIAL_MANAGE);
    }

    public function review(User $user, Material $material): bool
    {
        if (!$material->hasEditableState()) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::MATERIAL_REVIEW);
    }

    public function manageMaterial(User $user, Material $material): bool
    {
        if (!$material->hasEditableState()) {
            return false;
        }

        return $user->hasPermissionTo(PermissionsEnum::MATERIAL_MANAGE);
    }
}
