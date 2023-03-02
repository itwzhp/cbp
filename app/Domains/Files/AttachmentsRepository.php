<?php
namespace App\Domains\Files;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Models\Material;
use App\Helpers\FilesystemsHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class AttachmentsRepository
{
    public function fromFileUpload(Material $material, UploadedFile $file): Attachment
    {
        $disk = $material->isPublished()
            ? FilesystemsHelper::PUBLIC
            : FilesystemsHelper::PRIVATE;

        $path = $this->generatePath($material, $file);
        FilesystemsHelper::getDisk($disk)
            ->put(
                $path,
                $file->getContent(),
                [
                    'CacheControl'    => 'max-age=315360000, no-transform, public',
                ]
            );

        return $material->attachments()->create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'disk' => $disk,
            'mime' => $file->getClientMimeType(),
        ]);
    }

    private function generatePath(Material $material, UploadedFile $file): string
    {
        return "{$material->id}/"
            . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '.' . $file->getClientOriginalExtension();
    }
}
