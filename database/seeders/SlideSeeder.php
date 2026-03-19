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
                'img' => public_path('/images/materialy/slider1a.webp'),
            ],
            [
                'url' => route('materials.tags', ['harcerz-i-natura,oboz']),
                'img' => public_path('/images/materialy/slider2a.webp'),
            ],
            [
                'url' => route('materials.tags', ['wychowanie-ekonomiczne']),
                'img' => public_path('/images/materialy/slider3a.webp'),
            ],
            [
                'url' => route('materials.tags', ['system-malych-grup']),
                'img' => public_path('/images/materialy/slider4a.webp'),
            ],
            [
                'url' => route('materials.tags', ['bezpieczenstwo']),
                'img' => public_path('/images/materialy/slider_bezp.webp'),
            ],
            [
                'url' => route('materials.tags', ['zasady-harcerskiego-wychowania']),
                'img' => public_path('/images/materialy/slider1a_brat.webp'),
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
