<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Tag;
use App\Domains\Visuals\Models\Slide;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run()
    {
        /** @var Collection|Tag[] $tags */
        $tags = Tag::inRandomOrder()->take(3)->get();

        foreach ($tags as $tag) {
            /** @var Slide $slide */
            $slide = Slide::firstOrCreate([
                'url' => route('materials.tag', $tag),
            ]);
            $slide->addMedia(public_path('images/scout.jpg'))
                ->preservingOriginal()
                ->toMediaCollection('slide');
        }
    }
}
