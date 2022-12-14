<?php
namespace App\Domains\Materials\Factories;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\States\Draft;
use App\Domains\Materials\States\Published;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    public function modelName(): string
    {
        return Material::class;
    }

    public function definition(): array
    {
        return [
            'title'       => fake()->sentence(),
            'description' => fake()->text(),
            'state'       => Draft::class,
        ];
    }

    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'state' => Published::class,
            ];
        });
    }
}
