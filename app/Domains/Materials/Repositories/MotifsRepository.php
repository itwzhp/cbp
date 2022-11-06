<?php
namespace App\Domains\Materials\Repositories;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Database\Seeders\TagsSeeder;

class MotifsRepository extends TagsRepository
{
    protected Taxonomy $motifTaxonomy;

    public function __construct()
    {
        $this->motifTaxonomy = Taxonomy::where('name', TagsSeeder::MOTIF_NAME)
            ->with('tags')
            ->firstOrFail();
    }

    public function get(int $wpId): Tag
    {
        if ($wpId > 6) {
            throw  new \InvalidArgumentException('Wrong default motif');
        }

        return $this->motifTaxonomy->tags->sortBy('id')[$wpId-1];
    }

    public function addCustom(string $name): Tag
    {
        return $this
            ->motifTaxonomy
            ->tags()
            ->firstOrCreate([
                'name' => $name,
            ]);
    }
}
