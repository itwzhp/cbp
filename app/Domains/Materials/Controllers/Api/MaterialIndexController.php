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
        $materials = Material::search($request->input('search'))
            ->published()
            ->forTags($request->input('tags'))
            ->with('owner', 'tags')
            ->orderBy('published_at', 'desc')
            ->paginate(15);

//        $materials = Material::forTags($request->input('tags'))->paginate(15); // ->toSql(); //->paginate(15);

        return Fractal::create()
            ->collection($materials->items())
            ->transformWith(new DefaultMaterialTransformer())
            ->serializeWith(ArraySerializer::class);
    }
}
