<?php
namespace Database\Seeders;

use App\Domains\Materials\Models\Tag;
use App\Domains\Visuals\Models\Slider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run()
    {
        /** @var Collection|Tag[] $tags */
        $tags = Tag::inRandomOrder()->take(3)->get();

        /** @var Slider $slide */
        $slide = Slider::firstOrCreate([
            'url' => route('materials.tag', $tags[0]),
        ]);
        $slide->addMedia(storage_path('scouts.jpg'))
            ->toMediaCollection('slide');
    }
}
