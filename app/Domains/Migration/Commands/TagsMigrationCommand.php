<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Materials\Repositories\TaxonomiesRepository;
use App\Domains\Migration\Models\Taxonomy as WpTaxonomy;
use Illuminate\Console\Command;

class TagsMigrationCommand extends Command
{
    protected $signature = 'wp:tags';

    public function __invoke(TaxonomiesRepository $taxonomiesRepository, TagsRepository $tagsRepository)
    {
        /** @var WpTaxonomy[] $taxonomies */
        $taxonomies = WpTaxonomy::exclude()->with('term')->get();

        foreach ($taxonomies as $taxonomy) {
            $this->info("Dodaję {$taxonomy->taxonomy}");
            $tax = $taxonomiesRepository->firstOrCreate($taxonomy->taxonomy);
            $tag = $tagsRepository->create($tax, $taxonomy->term->name, $taxonomy->term->term_id);
        }

        $this->info('Zakończono');
    }
}
