<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Materials\Models\Tag;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return 'ok';
    }
}
