<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\DestroyScenarioRequest;
use App\Domains\Admin\Requests\Api\StoreScenarioRequest;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Scenario;
use App\Http\Controllers\AbstractAdminController;
use Illuminate\Http\JsonResponse;

class ScenariosController extends AbstractAdminController
{
    public function store(Material $material, StoreScenarioRequest $request)
    {
        return $material->scenarios()->create();
    }

    public function update(Material $material, Scenario $scenario, UpdateScenarioRequest $request): JsonResponse
    {
        $scenario->update($request->validated());

        return $this->responseOK();
    }

    public function destroy(Material $material, Scenario $scenario, DestroyScenarioRequest $request): JsonResponse
    {
        $scenario->delete();

        return $this->responseOK();
    }
}
