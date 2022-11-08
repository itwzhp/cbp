<?php
namespace App\Domains\Materials\Transformers;

use Illuminate\Database\Eloquent\Collection;
use League\Fractal\TransformerAbstract;

class FieldGroupTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['fields'];

    public function transform(Collection $fieldsGroup): array
    {
        return [
            'type' => $fieldsGroup->first()->type,
        ];
    }

    public function includeFields(Collection $fieldsGroup)
    {
        return $this->collection($fieldsGroup, new FieldTransformer());
    }
}
