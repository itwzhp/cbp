<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaterialsIndexController extends Controller
{
    public function __invoke()
    {
        return [
            'user' => Auth::user(),
        ];

//        $builder = MaterialAccessBuilder::forUser(Auth::user());
//
//        return $builder->get();
    }
}
