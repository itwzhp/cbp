<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Material;
use App\Http\Controllers\Controller;

class MaterialBackwardCompatibilityController extends Controller
{
    public function __invoke(string $type, ?string $slug = null)
    {
        $search = $slug ?? $type;
        $material = Material::where('slug', $search)->first();

        if ($material === null) {
            return redirect(route('materials.index') . "?search={$search}");
        }

        return redirect(route('materials.show', $material), 301);
    }
}
