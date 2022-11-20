<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Setup;
use League\Fractal\TransformerAbstract;

class SetupTransformer extends TransformerAbstract
{
    public function transform(Setup $setup): array
    {
        return [
            'id'                     => $setup->id,
            'capacity_min'           => $setup->capacity_min,
            'capacity_opt'           => $setup->capacity_opt,
            'capacity_max'           => $setup->capacity_max,
            'duration'               => $setup->duration,
            'time'                   => $setup->time,
            'instructor_count'       => $setup->instructor_count,
            'instructor_competence'  => $setup->instructor_competence,
            'remarks'                => $setup->remarks,
            'location'               => $setup->location,
            'technical_requirements' => $setup->technical_requirements,
            'materials'              => $setup->materials,
            'participant_materials'  => $setup->participant_materials,
            'participant_clothing'   => $setup->participant_clothing,
        ];
    }
}
