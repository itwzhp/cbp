<?php
namespace App\Domains\Materials\Factories;

use App\Domains\Materials\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    public function modelName(): string
    {
        return Tag::class;
    }

    public function definition(): array
    {
        return [
            'name' => fake()->words(random_int(1, 3), true),
        ];
    }
}
