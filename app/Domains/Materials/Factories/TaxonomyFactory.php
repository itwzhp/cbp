<?php
namespace App\Domains\Materials\Factories;

use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxonomyFactory extends Factory
{
    public function modelName(): string
    {
        return Taxonomy::class;
    }

    public function definition(): array
    {
        return [
            'name' => fake()->words(random_int(1, 3), true),
            'slug' => fake()->slug(2),
        ];
    }
}
