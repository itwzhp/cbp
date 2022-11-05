<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;

class TagsRepository
{
    public function create(Taxonomy $taxonomy, string $name, int $wpId = null): Tag
    {
        return $taxonomy
            ->tags()
            ->firstOrCreate([
                'name'  => $name,
                'wp_id' => $wpId,
            ]);
    }
}
