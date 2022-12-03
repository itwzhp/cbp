<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Material;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class MaterialsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Materials');
    }

    public function show(Material $material)
    {
        return Inertia::render('Materials/Show')->with(compact('material'));
    }
}
