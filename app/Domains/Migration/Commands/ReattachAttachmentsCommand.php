<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Material;
use App\Domains\Migration\Models\Post;

class ReattachAttachmentsCommand extends PostsMigrationCommand
{
    protected $signature = 'wp:attachments {material?}';

    public function __invoke()
    {
        $materdialId = $this->argument('material') ?? $this->ask('Material id: ');

        /** @var Material $material */
        $material = Material::find($materdialId);

        $this->info("Importing material {$materdialId}: {$material->title} (WPID: {$material->wp_id})");

        $post = Post::find($material->wp_id);

        $this->attachFiles($post, $material);
    }
}
