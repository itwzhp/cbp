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
                'in:' . implode(',', FieldTypeEnum::cases()),
            ],
        ];
    }

    public function type(): FieldTypeEnum
    {
        return FieldTypeEnum::tryFrom($this->input('type'));
    }
}
