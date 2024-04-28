<?php
namespace App\Http\Controllers;

use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Transformers\HighlightedMaterialTransformer;
use App\Domains\Visuals\Models\Slide;
use App\Domains\Visuals\Transformers\SlideTransformer;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Fractalistic\ArraySerializer;

class WelcomePageController extends Controller
{
    const TTL = 3600;

    public function __invoke(): Response
    {
        return Inertia::render('Welcome')
            ->with([
                'slider'      => $this->getSlider(),
                'topics'      => $this->getTopics(),
                'suggestions' => $this->getSuggestions(),
            ]);
    }

    private function getTopics(): array
    {
        return Cache::remember('topics', static::TTL, function () {
            $randomTag = Tag::first();
            $zuchyTag = Tag::where('slug', 'like', '%zuchy')->first() ?? $randomTag;
            $harcerzeTag = Tag::where('slug', 'like', '%harcerze')->first() ?? $randomTag;
            $harcerzeStarsiTag = Tag::where('slug', 'like', '%harcerze-starsi')->first() ?? $randomTag;
            $wedrownicyTag = Tag::where('slug', 'like', '%wedrownicy')->first() ?? $randomTag;
            $konspektKsztalceniowyTag = Tag::where('slug', 'like', '%konspekt-ksztalceniowy')->first() ?? $randomTag;
            $graKsztalceniowaTag = Tag::where('slug', 'like', '%gra-ksztalceniowa')->first() ?? $randomTag;
            $graProgramowaTag = Tag::where('slug', 'like', '%gra-programowa')->first() ?? $randomTag;
            $propozycjeTag = Tag::where('slug', 'like', '%propozycja-programowa')->first() ?? $randomTag;
            $poradnikiTag = Tag::where('slug', 'like', '%poradnik')->first() ?? $randomTag;
            $czasopismaTag = Tag::where('slug', 'like', '%czasopisma')->first() ?? $randomTag;
            $artykulyTag = Tag::where('slug', 'like', '%artykul')->first() ?? $randomTag;
            $recenzjeTag = Tag::where('slug', 'like', '%recenzja')->first() ?? $randomTag;

            return [
                [
                    'name' => 'Materiały zuchowe',
                    'url'  => route('materials.tag', [$zuchyTag]),
                    'icon' => url('images/ikony/materialy_zuchowe.png'),
                ],
                [
                    'name' => 'Materiały harcerskie',
                    'url'  => route('materials.tag', [$harcerzeTag]),
                    'icon' => url('images/ikony/materialy_harcerskie.png'),
                ],
                [
                    'name' => 'Materiały starszoharcerskie',
                    'url'  => route('materials.tag', [$harcerzeStarsiTag]),
                    'icon' => url('images/ikony/materialy_starszoharcerskie.png'),
                ],
                [
                    'name' => 'Materiały wędrownicze',
                    'url'  => route('materials.tag', [$wedrownicyTag]),
                    'icon' => url('images/ikony/materialy_wedrownicze.png'),
                ],
                [
                    'name' => 'Propozycje programowe',
                    'url'  => route('materials.tag', [$propozycjeTag]),
                    'icon' => url('images/ikony/propozycje_programowe.png'),
                ],
                [
                    'name' => 'Gry programowe',
                    'url'  => route('materials.tag', [$graProgramowaTag]),
                    'icon' => url('images/ikony/gry_programowe.png'),
                ],
                [
                    'name' => 'Gry kształceniowe',
                    'url'  => route('materials.tag', [$graKsztalceniowaTag]),
                    'icon' => url('images/ikony/gry_ksztalceniowe.png'),
                ],
                [
                    'name' => 'Konspekty kształceniowe',
                    'url'  => route('materials.tag', [$konspektKsztalceniowyTag]),
                    'icon' => url('images/ikony/konspekty_ksztalceniowe.png'),
                ],
                [
                    'name' => 'Poradniki',
                    'url'  => route('materials.tag', [$poradnikiTag]),
                    'icon' => url('images/ikony/poradniki.png'),
                ],
                [
                    'name' => 'Czasopisma',
                    'url'  => route('materials.tag', [$czasopismaTag]),
                    'icon' => url('images/ikony/czasopisma.png'),
                ],
                [
                    'name' => 'Artykuły',
                    'url'  => route('materials.tag', [$artykulyTag]),
                    'icon' => url('images/ikony/artykuly.png'),
                ],
                [
                    'name' => 'Recenzje',
                    'url'  => route('materials.tag', [$recenzjeTag]),
                    'icon' => url('images/ikony/artykuly.png'),
                ],
            ];
        });
    }

    private function getSuggestions(): array
    {
        return Cache::remember('suggestions', static::TTL, function () {
            $highlightedTag = Tag::where('slug', 'like', '%wyroznione')->firstOrFail();

            return fractal($highlightedTag->materials)
                ->transformWith(new HighlightedMaterialTransformer())
                ->serializeWith(new ArraySerializer())
                ->toArray();
        });
    }

    private function getSlider(): array
    {
        return Cache::remember('slider', static::TTL, function () {
            return fractal(Slide::all())
                ->transformWith(new SlideTransformer())
                ->serializeWith(new ArraySerializer())
                ->toArray();
        });
    }
}
