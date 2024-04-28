<?php
namespace App\Domains\Admin\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => 'nullable|string|min:3',
            'description' => 'nullable|string',
            'licence_id'  => 'nullable|numeric',
        ];
    }
}
