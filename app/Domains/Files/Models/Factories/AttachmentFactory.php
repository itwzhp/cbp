<?php
namespace App\Domains\Files\Models\Factories;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    public function modelName(): string
    {
        return Attachment::class;
    }

    public function definition(): array
    {
        return [
            'name'        => fake()->file(),
            'path'        => fake()->filePath(),
            'disk'        => 'public',
            'mime'        => fake()->mimeType(),
            'downloads'   => 0,
            'material_id' => Material::factory(),
        ];
    }
}
