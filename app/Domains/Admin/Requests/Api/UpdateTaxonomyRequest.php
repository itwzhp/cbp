<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Users\Roles\PermissionsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaxonomyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->can(PermissionsEnum::MATERIAL_MANAGE->value);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
