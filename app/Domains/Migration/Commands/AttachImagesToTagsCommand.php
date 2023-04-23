<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Files\ImagesHelper;
use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Materials\Repositories\TaxonomiesRepository;
use Illuminate\Console\Command;

class AttachImagesToTagsCommand extends Command
{
    protected $signature = 'wp:tag_images';

    public function __invoke()
    {
//        $this->attachThumbsToCategories();
        $this->attachThumbsToCZRs();
    }

    private function attachThumbsToCategories(): void
    {
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

    private function attachThumbsToCZRs(): void
    {
        /** @var Taxonomy $czrTaxonomy */
        $czrTaxonomy = app(TaxonomiesRepository::class)->getCZR();

        foreach ($czrTaxonomy->tags as $tag) {
            $number = explode('.', $tag->name)[0];
            $path = storage_path("/app/czr/{$number}.png");

            if (!file_exists($path)) {
                $this->error('Brakujący plik:');
                $this->error($path);

                continue;
            }

            $tag->addMedia($path)
                ->preservingOriginal()
                ->toMediaCollection('icon');
        }
    }
}
