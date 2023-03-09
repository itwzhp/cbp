<?php
namespace App\Domains\Admin\Requests;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Materials\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/** @extends FormRequest */
trait AuthorizesMaterialElementUpdateTrait
{
    public function authorizeUpdate(Model $model): bool
    {
        /** @var Material $material */
        $material = $this->route('material');

        if ($material->id !== $model->material_id) {
            return false;
        }

        return Auth::user()->can(MaterialActionsEnum::UPDATE->value, $material);
    }
}
