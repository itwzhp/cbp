<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Http\Controllers\AbstractAdminController;
use Illuminate\Http\JsonResponse;

class TagsController extends AbstractAdminController
{
    public function attach(Material $material, Tag $tag): JsonResponse
    {
        $material->tags()->syncWithoutDetaching([$tag->id]);

        return $this->responseOK();
    }

    public function detach(Material $material, Tag $tag): JsonResponse
    {
        $material->tags()->detach($tag->id);

        return $this->responseOK();
    }
}
