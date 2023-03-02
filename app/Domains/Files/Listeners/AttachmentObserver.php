<?php
namespace App\Domains\Files\Listeners;

use App\Domains\Files\Models\Attachment;
use App\Helpers\FilesystemsHelper;

class AttachmentObserver
{
    public function deleted(Attachment $attachment): void
    {
        FilesystemsHelper::getDisk($attachment->disk)
            ->delete($attachment->path);
    }
}
