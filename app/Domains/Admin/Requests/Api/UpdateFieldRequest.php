<?php
namespace App\Domains\Admin\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFieldRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => 'required|string',
        ];
    }
}
