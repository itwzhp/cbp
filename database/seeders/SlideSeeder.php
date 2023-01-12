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

        /** @var Slide $slide */
        $slide = Slide::firstOrCreate([
            'url' => route('materials.tag', $tags[0]),
        ]);
        $slide->addMedia(storage_path('scouts.jpg'))
            ->toMediaCollection('slide');
    }
}
