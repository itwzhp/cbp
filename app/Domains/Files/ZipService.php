<?php
namespace App\Domains\Files;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use App\Helpers\FilesystemsHelper;
use Illuminate\Contracts\Filesystem\Filesystem;
use ZipArchive;

class ZipService
{
    protected Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = FilesystemsHelper::getPublic();
    }

    public function ensureZipExists(Material $material): bool
    {
        if ($this->filesystem->exists($this->path($material))) {
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
        $tmpFilename = tempnam('/tmp/', '');

        $zip = new ZipArchive();
        $zip->open($tmpFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        /** @var Attachment $attachment */
        foreach ($material->attachments as $attachment) {
            $zip->addFromString(
                basename($attachment->path),
                $attachment->getContents()
            );
        }
        $zip->close();

        $this->filesystem->put($this->path($material), file_get_contents($tmpFilename));
    }
}
