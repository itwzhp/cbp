<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\Api\CreateFieldRequest;
use App\Domains\Admin\Requests\Api\UpdateFieldRequest;
use App\Domains\Materials\Models\Field;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Transformers\FieldTransformer;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Http\Controllers\AbstractAdminController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractal\Fractal;
use Spatie\Fractalistic\ArraySerializer;

class FieldsController extends AbstractAdminController
{
    public function store(Material $material, CreateFieldRequest $request): Fractal
    {
        /** @var Field $field */
        $field = $material->fields()->create([
            'type' => $request->type(),
        ]);

        return $this->returnField($field);
    }

    public function update(Material $material, Field $field, UpdateFieldRequest $request): Fractal
    {
        $field->update($request->validated());

        return $this->returnField($field);
    }

    public function destroy(Material $material, Field $field): JsonResponse
    {
        if (Auth::user()->cannot('delete', $material)) {
            throw new UnauthorizedException('Brak dostępu');
        }

        return $this->responseOK();
    }

    protected function returnField(Field $field): Fractal
    {
        return fractal()
            ->item($field)
            ->transformWith(new FieldTransformer())
            ->serializeWith(new ArraySerializer());
    }
}
