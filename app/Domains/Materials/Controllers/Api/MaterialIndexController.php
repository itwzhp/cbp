<?php
namespace App\Domains\Materials\Controllers\Api;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Transformers\DefaultMaterialTransformer;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class MaterialIndexController extends Controller
{
    public function __invoke()
    {
        $materials = Material::published()
            ->with('owner', 'tags')
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return Fractal::create()
            ->collection($materials->items())
            ->transformWith(new DefaultMaterialTransformer())
            ->serializeWith(ArraySerializer::class);
    }
}
