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
        return true;
    }

    public function view(User $user, Material $material)
    {
        return true;
    }

    public function create(User $user)
    {
        $user->hasPermissionTo(RoleHelper::MATERIAL_CREATE);
    }

    public function update(User $user, Material $material)
    {
        //
    }

    public function delete(User $user, Material $material)
    {
        //
    }

    public function restore(User $user, Material $material)
    {
        //
    }

    public function forceDelete(User $user, Material $material)
    {
        //
    }
}
