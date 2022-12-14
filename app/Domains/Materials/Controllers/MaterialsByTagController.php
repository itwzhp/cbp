<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Tag;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MaterialsByTagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return Inertia::render(ComponentsHelper::MATERIALS)->with([
            'tag' => $tag->id,
        ]);
    }
}
