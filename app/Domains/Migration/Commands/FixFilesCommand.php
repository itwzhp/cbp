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
        /** @var Post $post */
        $post = Post::find($this->argument('wpid'));

        $material = Material::where('wp_id', $post->ID)->first();
        $this->attachFiles($post, $material);

        //        /** @var Attachment $attachment */
        //        foreach ($post->attachments as $attachment) {
        //        }
    }

    protected function generateName(Post $post, Attachment $attachment): string
    {
        $extension = pathinfo($attachment->guid, PATHINFO_EXTENSION);

        return "post{$post->ID}_file{$attachment->ID}.{$extension}";
    }
}
