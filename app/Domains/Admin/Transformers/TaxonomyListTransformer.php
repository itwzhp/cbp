<?php
namespace App\Domains\Admin\Transformers;

use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Materials\Transformers\TagTransformer;
use League\Fractal\TransformerAbstract;

class TaxonomyListTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['tags'];

    public function transform(Taxonomy $taxonomy): array
    {
        return [
            'taxonomy_id'   => $taxonomy->id,
            'taxonomy_name' => $taxonomy->name,
        ];
    }

    public function includeTags(Taxonomy $taxonomy)
    {
        return $this
            ->collection($taxonomy->tags, new TagTransformer());
    }
}
