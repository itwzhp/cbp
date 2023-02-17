<?php
namespace App\Domains\Materials\Controllers\Api;

use App\Domains\Materials\MaterialSearcher;
use App\Domains\Materials\Requests\Api\IndexRequest;
use App\Domains\Materials\Transformers\DefaultMaterialTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Fractalistic\ArraySerializer;
use Spatie\Fractalistic\Fractal;

class MaterialIndexController extends Controller
{
    public const SIZE_PER_PAGE = 24;

    public function __invoke(IndexRequest $request): array
    {
        /** @var Builder $materialsBuilder */
        $materialsBuilder = MaterialSearcher::make()
            ->search($request->input('search'))
            ->withTags($request->input('tags', []))
            ->setMode($request->input('mode', MaterialSearcher::MODE_OR))
            ->query()
            ->published()
            ->withAuthor()
            ->with('media', 'owner', 'tags.media');

        if (empty($request->input('search'))) {
            $materialsBuilder = $materialsBuilder->orderBy('published_at', 'desc');
        }

        $materialsBuilder = $materialsBuilder->paginate(static::SIZE_PER_PAGE);

        return [
            'content' => Fractal::create()
                ->collection($materialsBuilder->items())
                ->transformWith(new DefaultMaterialTransformer())
                ->serializeWith(ArraySerializer::class)
                ->toArray(),
            'meta'    => [
                'page'        => $materialsBuilder->currentPage(),
                'size'        => static::SIZE_PER_PAGE,
                'hasNextPage' => $materialsBuilder->hasMorePages(),
            ],
        ];
    }
}
