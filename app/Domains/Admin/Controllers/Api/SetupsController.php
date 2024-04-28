<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\DestroySetupRequest;
use App\Domains\Admin\Requests\Api\UpdateSetupRequest;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Setup;
use App\Http\Controllers\AbstractAdminController;

class SetupsController extends AbstractAdminController
{
    public function store(Material $material)
    {
        if ($material->setups->count() > 0) {
            throw new \InvalidArgumentException('Wymagania już istnieją');
        }

        $setup = $material->setups()->create([]);

        return $setup->toArray();
    }

    public function update(Material $material, Setup $setup, UpdateSetupRequest $request)
    {
        $setup->update($request->validated());

        return $this->responseOK();
    }

    public function destroy(Material $material, Setup $setup, DestroySetupRequest $request)
    {
        $setup->delete();

        return $this->responseOK();
    }
}
