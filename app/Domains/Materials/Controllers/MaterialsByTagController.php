<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Materials\Models\Tag;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MaterialsByTagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return Inertia::render('Materials')->with([
            'tag' => $tag->id
        ]);
    }
}
