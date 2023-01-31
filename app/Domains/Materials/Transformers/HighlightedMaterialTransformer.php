<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Material;
use Illuminate\Support\Str;
use League\Fractal\TransformerAbstract;

class HighlightedMaterialTransformer extends TransformerAbstract
{
    public function transform(Material $material): array
    {
        return [
            'id'      => $material->id,
            'title'   => $material->title,
            'excerpt' => Str::excerpt($material->description),
            'thumb'   => $material->thumb(),
            'url'     => route('materials.show', $material),
        ];
    }
}
