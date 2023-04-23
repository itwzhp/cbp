<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Tag;

class TagWithIconTransformer extends TagTransformer
{
    public function transform(Tag $tag): array
    {
        return parent::transform($tag) + [
            'icon' => $tag->icon(),
        ];
    }
}
