<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class HighlightsSeeder extends Seeder
{
    public function run()
    {
        /** @var Tag $highlightedTag */
        $highlightedTag = Tag::where('slug', 'like', '%wyroznione')->firstOrFail();

        /** @var Material[] $materials */
        $materials = Material::whereHas('tags', function (Builder $builder) {
            $builder->where('slug', 'like', '%propozycja-programowa');
        })
            ->published()
            ->inRandomOrder()
            ->take(6)
            ->get();

        foreach ($materials as $material) {
            $material->tags()->syncWithoutDetaching([$highlightedTag->id]);
        }
    }
}
