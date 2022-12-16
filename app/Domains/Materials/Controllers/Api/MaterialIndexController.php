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
    public const SIZE_PER_PAGE = 24;

    public function __invoke(IndexRequest $request)
    {
        $materials = MaterialSearcher::make()
            ->search($request->input('search'))
            ->withTags($request->input('tags', []))
            ->setMode($request->input('mode', MaterialSearcher::MODE_OR))
            ->query()
            ->withAuthor()
            ->with('media', 'owner')
            ->orderBy('published_at', 'desc')
            ->paginate(static::SIZE_PER_PAGE);

        return [
            'content' => Fractal::create()
                ->collection($materials->items())
                ->transformWith(new DefaultMaterialTransformer())
                ->serializeWith(ArraySerializer::class)
                ->toArray(),
            'meta'    => [
                'page'        => $materials->currentPage(),
                'size'        => static::SIZE_PER_PAGE,
                'hasNextPage' => $materials->hasMorePages(),
            ],
        ];
    }
}
