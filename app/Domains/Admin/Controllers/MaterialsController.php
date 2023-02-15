<?php
namespace App\Domains\Admin\Controllers;

use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MaterialsController extends Controller
{
    public function index()
    {
        return Inertia::render(ComponentsHelper::ADMIN_MATERIALS_INDEX);
    }
}
