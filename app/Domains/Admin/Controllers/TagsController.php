<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Admin\Requests\StoreTagRequest;
use App\Domains\Admin\Requests\UpdateTagRequest;
use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Repositories\TagsRepository;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return 'ok';
    }

    public function store(StoreTagRequest $request, TagsRepository $repository)
    {
        $repository->create($request->taxonomy(), $request->input('name'));

        return 'ok';
    }

    public function update(Tag $tag, UpdateTagRequest $request)
    {
        $tag->update([
            'name' => $request->input('name', ''),
        ]);

        return 'ok';
    }
}
