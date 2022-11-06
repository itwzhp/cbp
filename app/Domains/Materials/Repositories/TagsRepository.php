<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;

class TagsRepository
{
    public function create(Taxonomy $taxonomy, string $name, int $parentId = null, int $wpId = null): Tag
    {
        return $taxonomy
            ->tags()
            ->firstOrCreate([
                'parent_id' => $parentId,
                'name'      => $name,
                'wp_id'     => $wpId,
            ]);
    }

    public function findByWpId(int $wpId): ?Tag
    {
        return Tag::where('wp_id', $wpId)->first();
    }
}
