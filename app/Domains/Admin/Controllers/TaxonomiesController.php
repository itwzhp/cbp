<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Admin\Requests\Api\UpdateTaxonomyRequest;
use App\Domains\Admin\Transformers\TaxonomyListTransformer;
use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Materials\Repositories\TaxonomiesRepository;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class TaxonomiesController extends Controller
{
    public function index(): Response
    {
        return Inertia::render(ComponentsHelper::ADMIN_TAXONOMIES_INDEX);
    }

    public function list(): Fractal
    {
        return Fractal::create()
            ->collection(
                Taxonomy::with('tags')
                    ->orderBy('name')
                    ->get()
            )
            ->transformWith(new TaxonomyListTransformer())
            ->serializeWith(new ArraySerializer());
    }

    public function store(UpdateTaxonomyRequest $request, TaxonomiesRepository $repository)
    {
        $repository->firstOrCreate($request->input('name'));

        return 'ok';
    }

    public function destroy(Taxonomy $taxonomy)
    {
        $taxonomy->delete();

        return 'ok';
    }

    public function update(Taxonomy $taxonomy, UpdateTaxonomyRequest $request)
    {
        $taxonomy->update([
            'name' => $request->input('name'),
        ]);

        return 'ok';
    }
}
