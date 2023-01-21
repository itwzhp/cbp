<?php
namespace App\Domains\Visuals\Models\Factories;

use App\Domains\Visuals\Models\Slide;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlideFactory extends Factory
{
    public function modelName(): string
    {
        return Slide::class;
    }

    public function definition(): array
    {
        return [
            'url' => fake()->url(),
        ];
    }
}
