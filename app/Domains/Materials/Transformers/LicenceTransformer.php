<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Materials\Models\Licence;
use League\Fractal\TransformerAbstract;

class LicenceTransformer extends TransformerAbstract
{
    public function transform(Licence $licence): array
    {
        return [
            'id'   => $licence->id,
            'name' => $licence->name,
            'url'  => $licence->url,
            'icon' => $licence->icon,
        ];
    }
}
