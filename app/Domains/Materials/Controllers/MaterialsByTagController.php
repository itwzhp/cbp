<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Tag;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class MaterialsByTagController extends Controller
{
    public function __invoke(Tag $tag, string $subtag = null): Response
    {
        /**
         * Route model binding does not work for multiple instances of the same class.
         */
        if (!empty($subtag)) {
            $subtag = Tag::where('slug', $subtag)->first();
        }

        return Inertia::render(ComponentsHelper::MATERIALS)->with([
            'tags' => array_filter([
                $tag->id,
                $subtag->id ?? null,
            ]),
        ]);
    }
}
