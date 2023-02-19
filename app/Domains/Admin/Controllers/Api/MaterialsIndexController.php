<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\MaterialsIndexRequest;
use App\Domains\Admin\Transformers\MaterialWIthActionsTransformer;
use App\Domains\Materials\MaterialAccessBuilder;
use App\Domains\Users\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\ArraySerializer;

class MaterialsIndexController extends Controller
{
    public function __invoke(MaterialsIndexRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var LengthAwarePaginator $builder */
        $builder = MaterialAccessBuilder::forUser($user)
            ->search($request->input('search'))
            ->orderBy('created_at', 'desc')
            ->paginate();

        return fractal()
            ->collection($builder->getCollection())
            ->transformWith(new MaterialWIthActionsTransformer($user))
            ->serializeWith(new ArraySerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($builder));
    }
}
