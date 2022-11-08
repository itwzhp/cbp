<?php
namespace App\Domains\Materials\Transformers;

use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

class TagGroupTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['tags'];

    public function transform(Collection $group)
    {
        return [
            'taxonomy_id'   => $group->first()->taxonomy_id,
            'taxonomy_name' => $group->first()->taxonomy->name ?? '',
        ];
    }

    public function includeTags(Collection $group)
    {
        return $this->collection($group, new TagTransformer());
    }
}
