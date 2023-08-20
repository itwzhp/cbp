<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Taxonomy;
use App\Domains\Materials\Repositories\TaxonomiesRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MetSeeder extends Seeder
{
    public function run(): void
    {
        /** @var Taxonomy $metTax */
        $metTax = app(TaxonomiesRepository::class)->getMethodics();

        foreach ($metTax->tags as $tag) {
            if (Str::endsWith($tag->slug, 'harcerze')) {
                $tag->addMedia(public_path('/images/met/h.png'))
                    ->preservingOriginal()
                    ->toMediaCollection('icon');
            }

            if (Str::endsWith($tag->slug, 'starsi')) {
                $tag->addMedia(public_path('/images/met/hs.png'))
                    ->preservingOriginal()
                    ->toMediaCollection('icon');
            }

            if (Str::endsWith($tag->slug, 'zuchy')) {
                $tag->addMedia(public_path('/images/met/z.png'))
                    ->preservingOriginal()
                    ->toMediaCollection('icon');
            }

            if (Str::endsWith($tag->slug, 'wedrownicy')) {
                $tag->addMedia(public_path('/images/met/w.png'))
                    ->preservingOriginal()
                    ->toMediaCollection('icon');
            }
        }
    }
}
