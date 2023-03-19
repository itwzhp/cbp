<?php
namespace App\Domains\Visuals\Menu;

class TagsLink
{
    protected array $tags;

    public function __construct(array $tags = [])
    {
        $this->tags = $tags;
    }

    public function __toString(): string
    {
        return route('materials.tags', implode(',', $this->tags));
    }
}
