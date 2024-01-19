<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Users\Roles\PermissionsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ToggleRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->can(PermissionsEnum::USERS_MANAGE->value);
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'int',
                'exists:roles,id',
            ],
        ];
    }

    public function role(): Role
    {
        return Role::find($this->input('id'));
    }
}
