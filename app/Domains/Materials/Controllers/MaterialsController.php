<?php

namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Repositories\TaxonomiesRepository;
use App\Domains\Materials\Transformers\FullMaterialTransformer;
use App\Domains\Materials\Transformers\TagWithIconTransformer;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Fractalistic\ArraySerializer;

class MaterialsController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render(ComponentsHelper::MATERIALS)
            ->with([
                'search' => $request->input('search')
            ]);
    }

    public function show(Material $material, TaxonomiesRepository $taxonomiesRepository)
    {
        $czrTax = $taxonomiesRepository->getCZR();
        $material->load('tags.media');

        return Inertia::render(ComponentsHelper::MATERIALS_SHOW)
            ->with([
                'material' => fractal($material)
                    ->transformWith(new FullMaterialTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->toArray(),
                'czr' => fractal()
                    ->collection(
                        $material->tags->where('taxonomy_id', $czrTax->id)
                            ->sortBy('name', SORT_NATURAL)
                    )
                    ->transformWith(new TagWithIconTransformer())
                    ->serializeWith(new ArraySerializer()),
            ]);
    }
}
