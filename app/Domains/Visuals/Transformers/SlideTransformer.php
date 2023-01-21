<?php
namespace App\Domains\Visuals\Transformers;

use App\Domains\Visuals\Models\Slide;
use League\Fractal\TransformerAbstract;

class SlideTransformer extends TransformerAbstract
{
    public function transform(Slide $slide): array
    {
        return [
            'id'    => $slide->id,
            'url'   => $slide->url,
            'image' => $slide->slide(),
        ];
    }
}
