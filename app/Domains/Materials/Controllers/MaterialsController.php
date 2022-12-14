<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Transformers\FullMaterialTransformer;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Fractalistic\ArraySerializer;

class MaterialsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render(ComponentsHelper::MATERIALS);
    }

    public function show(Material $material)
    {
        return Inertia::render(ComponentsHelper::MATERIALS_SHOW)
            ->with([
                'material' => fractal($material)
                    ->transformWith(new FullMaterialTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray(),
            ]);
    }
}
