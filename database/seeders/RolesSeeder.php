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

        Role::create(['name' => RoleHelper::ADMIN]);
        Role::create(['name' => RoleHelper::AUTHOR]);
        Role::create(['name' => RoleHelper::CONTRIBUTOR]);
        Role::create(['name' => RoleHelper::EDITOR]);
        Role::create(['name' => RoleHelper::REVIEWER]);
    }
}
