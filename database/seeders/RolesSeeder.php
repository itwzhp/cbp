<?php
namespace Database\Seeders;

use App\Domains\Users\Roles\PermissionsEnum;
use App\Domains\Users\Roles\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seedPermissions();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seedAuthor();
        $this->seedReviewer();
        $this->seedReviewManager();
        $this->seedEditor();
        Role::findOrCreate(RolesEnum::ADMIN->value);
        Role::findOrCreate(RolesEnum::CONTRIBUTOR->value);
    }

    private function seedReviewer(): void
    {
        /** @var Role $role */
        $role = Role::findOrCreate(RolesEnum::REVIEWER->value);
        $role->syncPermissions([
            PermissionsEnum::MATERIAL_REVIEW->value,
        ]);
    }

    private function seedReviewManager(): void
    {
        /** @var Role $role */
        $role = Role::findOrCreate(RolesEnum::REVIEW_MANAGER->value);
        $role->syncPermissions([
            PermissionsEnum::MATERIAL_REVIEW->value,
            PermissionsEnum::REVIEW_SET->value,
        ]);
    }

    private function seedEditor(): void
    {
        $role = Role::findOrCreate(RolesEnum::EDITOR->value);
        $role->syncPermissions([
            PermissionsEnum::MATERIAL_PUBLISH->value,
            PermissionsEnum::MATERIAL_DELETE_ANY->value,
            PermissionsEnum::MATERIAL_EDIT_ANY->value,
            PermissionsEnum::MATERIAL_REVIEW->value,
            PermissionsEnum::MATERIAL_MANAGE->value,
        ]);
    }

    private function seedAuthor(): void
    {
        $role = Role::findOrCreate(RolesEnum::AUTHOR->value);
        $role->syncPermissions([
            PermissionsEnum::MATERIAL_CREATE->value,
            PermissionsEnum::MATERIAL_EDIT_OWN->value,
            PermissionsEnum::MATERIAL_DELETE_OWN->value,
        ]);
    }

    private function seedPermissions(): void
    {
        foreach (PermissionsEnum::cases() as $permission) {
            Permission::findOrCreate($permission->value);
        }
    }
}
