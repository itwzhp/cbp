<?php
namespace Database\Seeders;

use App\Domains\Users\Roles\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RemoveContributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::where('name', RolesEnum::CONTRIBUTOR->value)->delete();
    }
}
