<?php
namespace App\Domains\Materials\Controllers\Api;

use App\Domains\Materials\MaterialSearcher;
use App\Domains\Materials\Requests\Api\IndexRequest;
use App\Domains\Materials\Transformers\DefaultMaterialTransformer;
use App\Http\Controllers\Controller;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class MaterialIndexController extends Controller
{
    public function __invoke(IndexRequest $request)
    {
        $materials = MaterialSearcher::make()
            ->search($request->input('search'))
            ->withTags($request->input('tags', []))
            ->setMode($request->input('mode', MaterialSearcher::MODE_OR))
            ->query()
            ->withAuthor()
            ->orderBy('published_at', 'desc')
            ->paginate(24);

        return [
            'content' => Fractal::create()
                ->collection($materials->items())
                ->transformWith(new DefaultMaterialTransformer())
                ->serializeWith(ArraySerializer::class)
                ->toArray(),
            'meta'    => [
                'page'        => $materials->currentPage(),
                'size'        => 15,
                'hasNextPage' => $materials->hasMorePages(),
            ],
        ];
    }
}
