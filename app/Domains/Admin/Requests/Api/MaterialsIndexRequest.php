<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Materials\States\MaterialState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MaterialsIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|sometimes|string',
            'scope'  => 'nullable|sometimes|string',
            'state'  => 'nullable|sometimes|' . MaterialState::getStatesValidationRule(),
        ];
    }

    public function state(): ?string
    {
        if (empty($this->input('state'))) {
            return null;
        }

        return array_search($this->input('state'), MaterialState::NAMES);
    }
}
