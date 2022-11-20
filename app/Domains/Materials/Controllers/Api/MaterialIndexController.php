<?php
namespace App\Domains\Materials\Controllers\Api;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Requests\Api\IndexRequest;
use App\Domains\Materials\Transformers\DefaultMaterialTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class MaterialIndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $materialsQuery = Material::search($request->input('search'))
            ->query(function (Builder $builder) {
                $builder
                    ->published()
                    ->with('owner', 'tags')
                    ->orderBy('published_at', 'desc');
            });

//        if ($request->hasSearch()) {
//            $materialsQuery->search($request->input('search'));
//        }

        $materials = $materialsQuery->paginate(15);

        return Fractal::create()
            ->collection($materials->items())
            ->transformWith(new DefaultMaterialTransformer())
            ->serializeWith(ArraySerializer::class);
    }
}
