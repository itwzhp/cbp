<?php
namespace App\Domains\Admin\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => 'string|min:3',
            'description' => 'string',
        ];
    }
}
