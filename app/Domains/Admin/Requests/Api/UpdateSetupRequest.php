<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Admin\Requests\AuthorizesMaterialElementUpdateTrait;
use App\Domains\Materials\Models\Setup;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSetupRequest extends FormRequest
{
    use AuthorizesMaterialElementUpdateTrait;

    public function authorize(): bool
    {
        /** @var Setup $setup */
        $setup = $this->route('setup');

        return $this->authorizeUpdate($setup);
    }

    public function rules(): array
    {
        return [
            'capacity_min'           => 'nullable|numeric|min:0',
            'capacity_opt'           => 'nullable|numeric|min:0',
            'capacity_max'           => 'nullable|numeric|min:0',
            'duration'               => 'nullable|numeric|min:0',
            'time'                   => 'nullable|numeric|min:0',
            'instructor_count'       => 'nullable|numeric|min:0',
            'instructor_competence'  => 'nullable|string|min:3',
            'remarks'                => 'nullable|string|min:3',
            'location'               => 'nullable|string|min:3',
            'technical_requirements' => 'nullable|string|min:3',
            'materials'              => 'nullable|string|min:3',
            'participant_materials'  => 'nullable|string|min:3',
            'participant_clothing'   => 'nullable|string|min:3',
        ];
    }
}
