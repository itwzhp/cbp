<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Files\ZipService;
use App\Domains\Materials\Models\Material;
use App\Helpers\FilesystemsHelper;
use Illuminate\Support\Facades\DB;

class DownloadMaterialController
{
    public function __invoke(Material $material, ZipService $zipService)
    {
        if ($material->attachments->isEmpty()) {
            return;
        }

        $zipService->ensureZipExists($material);

        $this->incrementDownloadCounts($material);

        return FilesystemsHelper::getPublic()
            ->download($zipService->path($material));
    }

    private function incrementDownloadCounts(Material $material)
    {
        DB::update('update attachments set downloads = downloads + 1 where material_id = ?', [$material->id]);
    }
}
