<?php
namespace App\Domains\Admin\Requests\Api;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Setup;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSetupRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var Material $material */
        $material = $this->route('material');
        /** @var Setup $setup */
        $setup = $this->route('setup');

        return $material->id === $setup->material_id;
    }

    public function rules(): array
    {
        return [
            'capacity_min'           => 'numeric|min:0',
            'capacity_opt'           => 'numeric|min:0',
            'capacity_max'           => 'numeric|min:0',
            'duration'               => 'numeric|min:0',
            'time'                   => 'numeric|min:0',
            'instructor_count'       => 'numeric|min:0',
            'instructor_competence'  => 'string|min:3',
            'remarks'                => 'string|min:3',
            'location'               => 'string|min:3',
            'technical_requirements' => 'string|min:3',
            'materials'              => 'string|min:3',
            'participant_materials'  => 'string|min:3',
            'participant_clothing'   => 'string|min:3',
        ];
    }
}
