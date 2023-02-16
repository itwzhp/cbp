<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\MaterialsIndexRequest;
use App\Domains\Materials\MaterialAccessBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaterialsIndexController extends Controller
{
    public function __invoke(MaterialsIndexRequest $request)
    {
        $builder = MaterialAccessBuilder::forUser(Auth::user())
            ->search($request->input('search'));

        return $builder->paginate();
    }
}
