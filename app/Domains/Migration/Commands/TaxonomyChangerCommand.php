<?php
namespace App\Domains\Migration\Commands;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Materials\Repositories\TagsRepository;
use App\Domains\Materials\States\Archived;
use Illuminate\Console\Command;

class TaxonomyChangerCommand extends Command
{
    public const TAXONOMIES_SLUGS_TO_DELETE = [
        'motyw',
        'category',
        'typ-materialu',
        'forma',
        'cel',
        'adresaci',
        'kierunki',
        'rodzaj-programu',
        'seria',
        'post-tag',
        'post_format',
    ];

    protected $signature = 'wp:change_tax';

    protected TagsRepository $tagsRepository;

    public function __invoke()
    {
        $this->tagsRepository = app(TagsRepository::class);

        $this->attachNewTaxonomies();
        $this->dropUnwantedTaxonomies();
    }

    private function attachNewTaxonomies(): void
    {
        $filepath = storage_path('CBP_materialy.csv');

        if (($handle = fopen($filepath, 'r')) === false) {
            return;
        }

        $taxonomies = fgetcsv($handle, 8000, ',');
        $tags = fgetcsv($handle, 8000, ',');

        while (($row = fgetcsv($handle, 8000, ',')) !== false) {
            $this->processRow($taxonomies, $tags, $row);
        }
    }

    private function dropUnwantedTaxonomies(): void
    {
        Taxonomy::whereIn('slug', static::TAXONOMIES_SLUGS_TO_DELETE)->delete();
    }

    private function processRow(array $taxonomies, array $tags, array $row): void
    {
        $material = Material::findByWp($row[0]);
        if ($material === null) {
            return;
        }

        if (!empty($row[1])) {
            $this->info("Mam zarchiwizować materiał: {$material->id}: {$material->title}");
            $material->state->transitionTo(Archived::class);

            return;
        }

        foreach ($row as $key => $value) {
            if ($key < 2) {
                continue;
            }

            if (!empty($value)) {
                $this->attachTaxonomy($material, $taxonomies[$key], $tags[$key]);
            }
        }
    }

    protected function attachTaxonomy(Material $material, string $taxonomyName, string $tagName)
    {
        $this->info("M: {$material->id} Attaching {$taxonomyName} tag: {$tagName}");
        $tag = $this->tagsRepository->createWithTax($taxonomyName, $tagName);
        $material->tags()->attach($tag->id);
    }
}
