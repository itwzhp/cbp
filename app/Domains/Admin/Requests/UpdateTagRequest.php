<?php
namespace App\Domains\Admin\Requests;

use App\Domains\Users\Roles\PermissionsEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(PermissionsEnum::TAGS_MANAGE->value);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }
}
