<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Field;
use League\Fractal\TransformerAbstract;

class FieldTransformer extends TransformerAbstract
{
    public function transform(Field $field): array
    {
        return [
            'id'    => $field->id,
            'value' => $field->value,
            'type'  => $field->type,
        ];
    }
}
