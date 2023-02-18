<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\MaterialUpdateRequest;
use App\Domains\Materials\Models\Material;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Http\Controllers\AdminController;

class MaterialUpdateController extends AdminController
{
    public function update(Material $material, MaterialUpdateRequest $request)
    {
        $material->update($request->validated());

        return
    }

    public function delete(Material $material)
    {
        if ($this->user->cannot('delete', $material)) {
            throw  new UnauthorizedException('Nie możesz tego zrobić');
        }

        $material->delete();

        return response(['ok'], 200);
    }
}
