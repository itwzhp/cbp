<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(LicensesSeeder::class);
        $this->call(RemoveContributorSeeder::class);
        $this->call(SlideSeeder::class);
    }
}
