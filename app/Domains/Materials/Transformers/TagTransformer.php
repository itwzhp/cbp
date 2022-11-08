<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $tag): array
    {
        return [
            'id'        => $tag->id,
            'parent_id' => $tag->parent_id,
            'name'      => $tag->name,
        ];
    }
}
