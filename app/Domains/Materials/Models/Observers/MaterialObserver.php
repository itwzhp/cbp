<?php
namespace App\Domains\Materials\Models\Observers;

use App\Domains\Files\ZipService;
use App\Domains\Materials\Models\Material;

class MaterialObserver
{
    public function created(Material $material)
    {
        //
    }

    public function updated(Material $material)
    {
        //
    }

    public function deleted(Material $material)
    {
        app(ZipService::class)->deleteZipForMaterial($material);
    }

    public function restored(Material $material)
    {
        //
    }

    public function forceDeleted(Material $material)
    {
        //
    }
}
