<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;

class MaterialsRepository
{
    public function create(User $owner, string $title = null): Material
    {
        return Material::create([
            'user_id' => $owner->id,
            'title'   => $title ?? fake()->sentence(),
        ]);
    }
}
