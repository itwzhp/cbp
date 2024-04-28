<?php
namespace App\Domains\Materials\Controllers\Api;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Transformers\FullMaterialTransformer;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class MaterialShowController extends Controller
{
    public function __invoke(Material $material): Fractal
    {
        return Fractal::create()
            ->item($material)
            ->transformWith(new FullMaterialTransformer())
            ->serializeWith(new ArraySerializer());
    }
}
