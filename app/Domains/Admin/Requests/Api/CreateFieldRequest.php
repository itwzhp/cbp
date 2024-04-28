<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Materials\Models\Enums\FieldTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateFieldRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'type' => [
                'required',
                FieldTypeEnum::rules(),
            ],
        ];
    }

    public function type(): FieldTypeEnum
    {
        return FieldTypeEnum::tryFrom($this->input('type'));
    }
}
