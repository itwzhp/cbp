<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\MaterialsIndexRequest;
use App\Domains\Materials\MaterialAccessBuilder;
use App\Domains\Materials\Transformers\DefaultMaterialTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class MaterialsIndexController extends Controller
{
    public function __invoke(MaterialsIndexRequest $request)
    {
        /** @var LengthAwarePaginator $builder */
        $builder = MaterialAccessBuilder::forUser(Auth::user())
            ->search($request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate();

        return fractal()
            ->collection($builder->getCollection())
            ->transformWith(new DefaultMaterialTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($builder));
    }
}
