<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Taxonomy;

class TaxonomiesRepository
{
    public function firstOrCreate(string $name): Taxonomy
    {
        return Taxonomy::firstOrCreate([
            'name' => $name,
        ]);
    }

    public function getCZR(): ?Taxonomy
    {
        return Taxonomy::where('slug', 'cele-zrownowazonego-rozwoju')->first();
    }
}
