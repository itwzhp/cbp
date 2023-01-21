<?php
namespace Database\Seeders;

use App\Domains\Users\Roles\RoleHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::findOrCreate(RoleHelper::ADMIN);
        Role::findOrCreate(RoleHelper::AUTHOR);
        Role::findOrCreate(RoleHelper::CONTRIBUTOR);
        Role::findOrCreate(RoleHelper::EDITOR);
        Role::findOrCreate(RoleHelper::REVIEWER);
    }
}
