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
            $konspektTag = Tag::where('slug', 'like', '%konspekt-programowy')->first() ?? $randomTag;
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
            $programTag = Tag::where('slug', 'like', '%program')->first() ?? $randomTag;

            return [
                [
                    'name' => 'Konspekty zuchowe',
                    'url'  => route('materials.tag', [$konspektTag, $zuchyTag]),
                ],
                [
                    'name' => 'Konspekty harcerskie',
                    'url'  => route('materials.tag', [$konspektTag, $harcerzeTag]),
                ],
                [
                    'name' => 'Konspekty starszoharcerskie',
                    'url'  => route('materials.tag', [$konspektTag, $harcerzeStarsiTag]),
                ],
                [
                    'name' => 'Konspekty wędrownicze',
                    'url'  => route('materials.tag', [$konspektTag, $wedrownicyTag]),
                ],
                [
                    'name' => 'Konspekty kształceniowe',
                    'url'  => route('materials.tag', [$konspektKsztalceniowyTag]),
                ],
                [
                    'name' => 'Gry programowe',
                    'url'  => route('materials.tag', [$graProgramowaTag]),
                ],
                [
                    'name' => 'Gry kształceniowe',
                    'url'  => route('materials.tag', [$graKsztalceniowaTag]),
                ],
                [
                    'name' => 'Propozycje programowe',
                    'url'  => route('materials.tag', [$propozycjeTag]),
                ],
                [
                    'name' => 'Poradniki',
                    'url'  => route('materials.tag', [$poradnikiTag]),
                ],
                [
                    'name' => 'Czasopisma',
                    'url'  => route('materials.tag', [$czasopismaTag]),
                ],
                [
                    'name' => 'Artykuły',
                    'url'  => route('materials.tag', [$artykulyTag]),
                ],
                [
                    'name' => 'Programy pracy i szkoleń',
                    'url'  => route('materials.tag', [$programTag]),
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
