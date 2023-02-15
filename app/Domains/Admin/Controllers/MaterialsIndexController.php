<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Materials\MaterialAccessBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaterialsIndexController extends Controller
{
    public function __invoke()
    {
        $builder = MaterialAccessBuilder::forUser(Auth::user());

        return $builder->get();
    }
}
