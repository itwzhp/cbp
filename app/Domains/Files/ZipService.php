<?php
namespace App\Domains\Files;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipService
{
    public function ensureZipExists(Material $material): bool
    {
        if (Storage::exists($this->path($material))) {
            return true;
        }

        $this->create($material);

        return false;
    }

    public function path(Material $material): string
    {
        return '/zip/'
            . $material->published_at->format('Y')
            . DIRECTORY_SEPARATOR
            . $material->slug
            . '.zip';
    }

    protected function create(Material $material): void
    {
        $filename = Storage::path($this->path($material));

        $zip = new ZipArchive();
        $zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        /** @var Attachment $attachment */
        foreach ($material->attachments as $attachment) {
            $zip->addFile($attachment->getAbsolutePath(), basename($attachment->path));
        }
        $zip->close();
    }
}
