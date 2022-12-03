<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Transformers\FullMaterialTransformer;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Fractalistic\ArraySerializer;

class MaterialsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Materials');
    }

    public function show(Material $material)
    {
        return Inertia::render('Materials/Show')
            ->with([
                'material' => fractal($material)
                    ->transformWith(new FullMaterialTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray(),
            ]);
    }
}
