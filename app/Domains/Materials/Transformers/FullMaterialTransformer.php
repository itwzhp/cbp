<?php
namespace App\Domains\Materials\Transformers;

class FullMaterialTransformer extends DefaultMaterialTransformer
{
    protected array $defaultIncludes = [
        'owner',
        'attachments',
        'taxonomies',
    ];
}
