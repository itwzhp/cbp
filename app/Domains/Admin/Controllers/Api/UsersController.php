<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\ToggleRoleRequest;
use App\Domains\Admin\Transformers\UserWithActionsTransformer;
use App\Domains\Users\Models\User;
use App\Domains\Users\Repositories\UsersRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\ArraySerializer;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        /** @var LengthAwarePaginator $builder */
        $builder = User::query()
            ->with('roles')
            ->search($request->input('search'))
            ->orderBy('name', 'asc')
            ->paginate();

        return fractal()
            ->collection($builder->getCollection())
            ->transformWith(new UserWithActionsTransformer())
            ->serializeWith(new ArraySerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($builder));
    }

    public function roles(User $user, ToggleRoleRequest $request, UsersRepository $repository)
    {
        $repository->toggleRole($user, $request->role());

        return 'OK';
    }
}
