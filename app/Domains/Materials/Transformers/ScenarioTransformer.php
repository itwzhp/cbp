<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Scenario;
use League\Fractal\TransformerAbstract;

class ScenarioTransformer extends TransformerAbstract
{
    public function transform(Scenario $scenario): array
    {
        return [
            'id'          => $scenario->id,
            'order'       => $scenario->order,
            'title'       => $scenario->title,
            'form'        => $scenario->form,
            'duration'    => $scenario->duration,
            'responsible' => $scenario->responsible,
            'description' => $scenario->description,
            'materials'   => $scenario->materials,
        ];
    }
}
