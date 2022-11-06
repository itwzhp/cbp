<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Licence;
use Illuminate\Database\Seeder;

class LicensesSeeder extends Seeder
{
    public function run()
    {
        Licence::updateOrCreate([
            'wp_id' => 1,
        ], [
            'name' => 'CC BY-NC-SA 3.0 PL',
            'url'  => 'https://creativecommons.org/licenses/by-nc-sa/3.0/pl/',
        ]);

        Licence::updateOrCreate([
            'wp_id' => 2,
        ], [
            'name' => 'ZHP',
        ]);

        Licence::updateOrCreate([
            'wp_id' => 3,
        ], [
            'name' => 'CC BY 3.0 PL',
        ]);
    }
}
