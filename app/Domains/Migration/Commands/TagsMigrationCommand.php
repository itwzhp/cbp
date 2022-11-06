<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Materials\Repositories\TaxonomiesRepository;
use App\Domains\Migration\Models\Taxonomy as WpTaxonomy;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class TagsMigrationCommand extends Command
{
    protected $signature = 'wp:tags';

    protected TaxonomiesRepository $taxonomiesRepository;

    protected TagsRepository $tagsRepository;

    public function __construct(TaxonomiesRepository $taxonomiesRepository, TagsRepository $tagsRepository)
    {
        parent::__construct();
        $this->taxonomiesRepository = $taxonomiesRepository;
        $this->tagsRepository = $tagsRepository;
    }

    public function __invoke()
    {
        /** @var WpTaxonomy[] $taxonomies */
        $taxonomies = WpTaxonomy::exclude()
            ->where('parent', '=', 0)
            ->with('term')
            ->get();

        $this->addTaxonomies($taxonomies);

        /** @var WpTaxonomy[] $taxonomies */
        $taxonomies = WpTaxonomy::exclude()
            ->where('parent', '!=', 0)
            ->orderBy('parent', 'asc')
            ->with('term')
            ->get();
        $this->addTaxonomies($taxonomies);

        $this->info('Zakończono');
    }

    protected function addTaxonomies(Collection $taxonomies)
    {
        foreach ($taxonomies as $taxonomy) {
            $this->info("Dodaję {$taxonomy->taxonomy}");
            $tax = $this->taxonomiesRepository->firstOrCreate($taxonomy->taxonomy);
            $parent = $this->tagsRepository->findByWpId($taxonomy->parent);
            $tag = $this->tagsRepository->create(
                taxonomy: $tax,
                name: $taxonomy->term->name,
                parentId: $parent->id ?? null,
                wpId: $taxonomy->term->term_id
            );
        }
    }
}
