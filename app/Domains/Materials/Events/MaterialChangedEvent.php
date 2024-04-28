<?php
namespace App\Domains\Materials\Events;

use App\Abstracts\AbstractEvent;
use App\Domains\Materials\Models\Material;

class MaterialChangedEvent extends AbstractEvent
{
    public Material $material;

    public function __construct(Material $material)
    {
        $this->material = $material;
    }
}
