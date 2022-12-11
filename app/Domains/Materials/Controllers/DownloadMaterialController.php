<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Files\ZipService;
use App\Domains\Materials\Models\Material;
use App\Helpers\FilesystemsHelper;

class DownloadMaterialController
{
    public function __invoke(Material $material, ZipService $zipService)
    {
        if ($material->attachments->isEmpty()) {
            return;
        }

        $zipService->ensureZipExists($material);

        return FilesystemsHelper::getPublic()
            ->download($zipService->path($material));
    }
}
