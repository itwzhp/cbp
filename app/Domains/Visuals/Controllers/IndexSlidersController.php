<?php
namespace App\Domains\Visuals\Controllers;

use App\Domains\Visuals\Models\Slide;
use App\Domains\Visuals\Transformers\SlideTransformer;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\ArraySerializer;

/**
 * @deprecated
 */
class IndexSlidersController extends Controller
{
    public function __invoke()
    {
        return fractal(Slide::all())
            ->transformWith(new SlideTransformer())
            ->serializeWith(new ArraySerializer());
    }
}
