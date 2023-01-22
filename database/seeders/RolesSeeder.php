<?php
namespace Database\Seeders;

use App\Domains\Users\Roles\RoleHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seedPermissions();

        $this->seedAuthor();
        $this->seedReviewer();
        $this->seedEditor();
        Role::findOrCreate(RoleHelper::ADMIN);
        Role::findOrCreate(RoleHelper::CONTRIBUTOR);
    }

    private function seedReviewer()
    {
        /** @var Role $role */
        $role = Role::findOrCreate(RoleHelper::REVIEWER);
        $role->syncPermissions([
            RoleHelper::MATERIAL_REVIEW,
        ]);
    }

    private function seedEditor()
    {
        $role = Role::findOrCreate(RoleHelper::EDITOR);
        $role->syncPermissions([
            RoleHelper::MATERIAL_PUBLISH,
            RoleHelper::MATERIAL_DELETE_ANY,
            RoleHelper::MATERIAL_EDIT_ANY,
            RoleHelper::MATERIAL_REVIEW,
        ]);
    }

    private function seedAuthor()
    {
        $role = Role::findOrCreate(RoleHelper::AUTHOR);
        $role->syncPermissions([
            RoleHelper::MATERIAL_CREATE,
            RoleHelper::MATERIAL_EDIT_OWN,
            RoleHelper::MATERIAL_DELETE_OWN,
        ]);
    }

    private function seedPermissions()
    {
        Permission::findOrCreate(RoleHelper::MATERIAL_CREATE);
        Permission::findOrCreate(RoleHelper::MATERIAL_CREATE);
        Permission::findOrCreate(RoleHelper::MATERIAL_EDIT_OWN);
        Permission::findOrCreate(RoleHelper::MATERIAL_EDIT_ANY);
        Permission::findOrCreate(RoleHelper::MATERIAL_DELETE_OWN);
        Permission::findOrCreate(RoleHelper::MATERIAL_DELETE_ANY);
        Permission::findOrCreate(RoleHelper::MATERIAL_REVIEW);
        Permission::findOrCreate(RoleHelper::MATERIAL_PUBLISH);
    }
}
