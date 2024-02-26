<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Material;
use App\Domains\Migration\Models\Attachment;
use App\Domains\Migration\Models\Post;

class FixFilesCommand extends PostsMigrationCommand
{
    protected $signature = 'wp:fix_files {wpid}';

    protected FileFixerService $service;

    public function handle()
    {
        /** @var Material $material */
        foreach (Material::with('post')->get() as $material) {
            $this->attachFiles($material->post, $material);
        }
    }

    protected function generateName(Post $post, Attachment $attachment): string
    {
        $extension = pathinfo($attachment->guid, PATHINFO_EXTENSION);

        return "post{$post->ID}_file{$attachment->ID}.{$extension}";
    }
}
