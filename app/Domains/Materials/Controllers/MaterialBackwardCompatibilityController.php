<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Material;
use App\Http\Controllers\Controller;

class MaterialBackwardCompatibilityController extends Controller
{
    public function __invoke(string $type, Material $material)
    {
        return redirect(route('materials.show', $material), 301);
    }
}
