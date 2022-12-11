<?php
namespace App\Domains\Users\Factories;

use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function modelName(): string
    {
        return User::class;
    }

    public function definition(): array
    {
        return [
            'name'       => fake()->name(),
            'email'      => fake()->email(),
            'first_name' => fake()->firstName(),
            'last_name'  => fake()->lastName(),
            'password'   => Hash::make(Str::random(32)),
        ];
    }
}
