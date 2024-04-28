<?php
namespace App\Domains\Materials\Controllers\Api;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Transformers\TagGroupTransformer;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class TaxonomiesGroupsIndexController extends Controller
{
    public function __invoke()
    {
        return Fractal::create()
            ->collection(
                Tag::notHidden()
                    ->with('taxonomy')
                    ->get()
                    ->groupBy('taxonomy_id')
            )
            ->transformWith(new TagGroupTransformer())
            ->serializeWith(new ArraySerializer());
    }
}
