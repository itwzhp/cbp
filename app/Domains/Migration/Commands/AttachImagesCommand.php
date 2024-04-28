<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Files\Models\Attachment;
use App\Helpers\FilesystemsHelper;
use Illuminate\Console\Command;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class AttachImagesCommand extends Command
{
    protected $signature = 'wp:images';

    public function __invoke()
    {
        /** @var Attachment[] $attachments */
        $attachments = Attachment::whereIn('mime', [
            'image/png',
            'image/jpeg',
        ])->get();

        foreach ($attachments as $attachment) {
            try {
                if ($attachment->material->hasMedia('cover')) {
                    continue;
                }

                $attachment->material
                    ->addMediaFromDisk($attachment->path, FilesystemsHelper::PUBLIC)
                    ->preservingOriginal()
                    ->toMediaCollection('cover');
                $this->info('Added cover: ' . $attachment->path);
            } catch (FileDoesNotExist $exception) {
                $this->error($attachment->path);
            } catch (FileIsTooBig $exception) {
                $this->error('file too big');
                $this->error($attachment->path);
            }
        }
    }
}
