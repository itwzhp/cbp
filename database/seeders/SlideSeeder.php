<?php
namespace Database\Seeders;

use App\Domains\Visuals\Models\Slide;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class SlideSeeder extends Seeder
{
    public function run()
    {
        $slides = [
            [
                'url' => route('materials.tags', ['planowanie-w-druzynie']),
                'img' => public_path('/images/planowanie.jpg'),
            ],
            [
                'url' => route('materials.tags', ['harcerz-i-natura']),
                'img' => public_path('/images/oboz.jpg'),
            ],
            [
                'url' => route('materials.tags', ['system-malych-grup']),
                'img' => public_path('/images/zastep.jpg'),
            ],
            [
                'url' => route('materials.tags', ['wychowanie-ekonomiczne']),
                'img' => public_path('/images/ekonomia.jpg'),
            ],
        ];

        Slide::truncate();

        foreach ($slides as $slideData) {
            /** @var Slide $slide */
            $slide = Slide::firstOrCreate([
                'url' => $slideData['url'],
            ]);
            $slide->addMedia($slideData['img'])
                ->preservingOriginal()
                ->toMediaCollection('slide');
        }

        Cache::clear();
    }
}
