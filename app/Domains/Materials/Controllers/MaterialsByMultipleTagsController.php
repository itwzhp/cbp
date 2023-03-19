<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Tag;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MaterialsByMultipleTagsController extends Controller
{
    public function __invoke(string $tags)
    {
        $tags = explode(',', $tags);

        $tags = Tag::findBySlugs($tags)->get();

        return Inertia::render(ComponentsHelper::MATERIALS)->with([
            'tags' => $tags->pluck('id'),
        ]);
    }
}
