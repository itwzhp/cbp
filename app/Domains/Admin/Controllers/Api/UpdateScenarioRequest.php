<?php
namespace App\Domains\Admin\Controllers\Api;

use App\Domains\Admin\Requests\AuthorizesMaterialElementUpdateTrait;
use App\Domains\Materials\Models\Scenario;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScenarioRequest extends FormRequest
{
    use AuthorizesMaterialElementUpdateTrait;

    public function authorize(): bool
    {
        /** @var Scenario $scenario */
        $scenario = $this->route('scenario');

        return $this->authorizeUpdate($scenario);
    }

    public function rules(): array
    {
        return [
            'order'       => ['nullable', 'integer', 'min:0'],
            'title'       => ['nullable', 'string'],
            'form'        => ['nullable', 'string'],
            'duration'    => ['nullable', 'integer', 'min:0'],
            'responsible' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'materials'   => ['nullable', 'string'],
        ];
    }
}
