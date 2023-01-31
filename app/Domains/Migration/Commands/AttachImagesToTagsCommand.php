<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Files\ImagesHelper;
use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Console\Command;

class AttachImagesToTagsCommand extends Command
{
    protected $signature = 'wp:tag_images';

    public function __invoke()
    {
        $this->attachThumbsToCategories();
    }

    private function attachThumbsToCategories()
    {
        /** @var Taxonomy $troopDoesTaxonomy */
        $troopDoesTaxonomy = Taxonomy::where('slug', ImagesHelper::TROOP_DOES_SLUG)->first();

        foreach ($troopDoesTaxonomy->tags as $tag) {
            $slug = ImagesHelper::getSlugFromTag($tag);

            $tag->addMedia(public_path('/images/' . ImagesHelper::TROOP_DOES_LUT[$slug]))
                ->preservingOriginal()
                ->toMediaCollection('thumb');
        }

        /** @var Taxonomy $typeTaxonomy */
        $typeTaxonomy = Taxonomy::where('slug', 'typ')->first();

        foreach ($typeTaxonomy->tags as $tag) {
            $slug = ImagesHelper::getSlugFromTag($tag);

            if (!file_exists(public_path('/images/' . ImagesHelper::TYPE_LUT[$slug]))) {
                continue;
            }

            $tag->addMedia(public_path('/images/' . ImagesHelper::TYPE_LUT[$slug]))
                ->preservingOriginal()
                ->toMediaCollection('thumb');
        }
    }
}
