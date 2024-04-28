<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Admin\Requests\AuthorizesMaterialElementUpdateTrait;
use App\Domains\Materials\Models\Field;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFieldRequest extends FormRequest
{
    use AuthorizesMaterialElementUpdateTrait;

    public function authorize(): bool
    {
        /** @var Field $field */
        $field = $this->route('field');

        return $this->authorizeUpdate($field);
    }

    public function rules(): array
    {
        return [
            'value' => 'required|string',
        ];
    }
}
