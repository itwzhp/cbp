<?php
namespace App\Domains\Files;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;
use Illuminate\Support\Str;

class ImagesHelper
{
    const TYPE_SLUG = 'typ-materialu';
    const TYPE_LUT = [
        'program'                => 'program.png',
        'poradnik'               => 'poradnik.png',
        'praca-naukowa'          => 'praca_naukowa.png',
        'konspekt-ksztalceniowy' => 'konspekt_ksztalceniowy.png',
        'konspekt-programowy'    => 'konspekt_programowy.png',
        'propozycja-programowa'  => 'propozycja_programowa.png',
        'element-zajec'          => 'element_zajec.png',
        'gra-programowa'         => 'gra_programowa.png',
        'gra-ksztalceniowa'      => 'gra_ksztalceniowa.png',
        'artykul'                => 'artykul.png',
        'czasopisma'             => 'czasopisma.png',
        'recenzja'               => 'recenzja.png',
    ];
    const HSW_TYPE = 'harcerski-system-wychowawczy';

    protected ?Taxonomy $typeTaxonomy;

    protected ?Taxonomy $hswTaxonomy;

    public function __construct()
    {
        $this->typeTaxonomy = Taxonomy::where('slug', static::TYPE_SLUG)->first();
        $this->hswTaxonomy = Taxonomy::where('slug', static::HSW_TYPE)->first();
    }

    public function getFallbackForMaterial(Material $material): string
    {
        /** @var Tag $hswTag */
        $hswTag = $material->tags->where('taxonomy_id', $this->hswTaxonomy->id ?? 0)->first();

        if ($hswTag !== null) {
            return $this->hswTagToImage($hswTag);
        }

        /** @var Tag $typeTag */
        $typeTag = $material->tags->where('taxonomy_id', $this->typeTaxonomy->id ?? 0)->first();

        if ($typeTag !== null) {
            return $this->typeTagToImage($typeTag);
        }

        return url('/images/scout_thumb.jpg');
    }

    public static function getSlugFromTag(Tag $tag): string
    {
        $slugExploded = explode('-', $tag->slug);
        unset($slugExploded[0]);

        return implode('-', $slugExploded);
    }

    protected function hswTagToImage(Tag $tag): string
    {
        if (Str::endsWith($tag->slug, 'planowanie-w-druzynie')) {
            return url('/images/materialy/planowanie.jpg');
        }

        if (Str::endsWith($tag->slug, 'zasady-harcerskiego-wychowania')) {
            return url('/images/materialy/zasady.jpg');
        }

        if (Str::endsWith($tag->slug, 'system-malych-grup')) {
            return url('/images/materialy/system.jpg');
        }

        if (Str::endsWith($tag->slug, 'obrzedowosc-i-symbolika')) {
            return url('/images/materialy/obrzedowosc.jpg');
        }

        if (Str::endsWith($tag->slug, 'sluzba')) {
            return url('/images/materialy/sluzba.jpg');
        }

        if (Str::endsWith($tag->slug, 'uczenie-w-dzialaniu')) {
            return url('/images/materialy/uczenie.jpg');
        }

        if (Str::endsWith($tag->slug, 'prawa-przyrzeczenie-i-obietnica')) {
            return url('/images/materialy/prawa.jpg');
        }

        if (Str::endsWith($tag->slug, 'system-instrumentow-metodycznych')) {
            return url('/images/materialy/sim.jpg');
        }

        if (Str::endsWith($tag->slug, 'praca-z-metodykami')) {
            return url('/images/materialy/praca-z-metodykami.jpg');
        }

        if (Str::endsWith($tag->slug, 'cechy-metody-harcerskiej')) {
            return url('/images/materialy/cechy.jpg');
        }

        if (Str::endsWith($tag->slug, 'osobisty-przyklad-instruktora')) {
            return url('/images/materialy/osobisty.jpg');
        }

        if (Str::endsWith($tag->slug, 'harcerski-system-wychowawczy')) {
            return url('/images/materialy/hsw.jpg');
        }

        return '';
    }

    protected function typeTagToImage(Tag $tag): string
    {

        if (Str::endsWith($tag->slug, 'gra-ksztalceniowa')) {
            return url('/images/materialy/graksztalceniowa.jpg');
        }

        if (Str::endsWith($tag->slug, 'element-zajec')) {
            return url('/images/materialy/element.jpg');
        }

        if (Str::endsWith($tag->slug, 'poradnik')) {
            return url('/images/materialy/poradnik.jpg');
        }

        if (Str::endsWith($tag->slug, 'propozycja-programowa')) {
            return url('/images/materialy/propozycjaprogramowa.jpg');
        }

        if (Str::endsWith($tag->slug, 'konspekt-programowy')) {
            return url('/images/materialy/konspektprogramowy.jpg');
        }

        if (Str::endsWith($tag->slug, 'artykul')) {
            return url('/images/materialy/artykul.jpg');
        }

        if (Str::endsWith($tag->slug, 'konspekt-ksztalceniowy')) {
            return url('/images/materialy/konspektksztalceniowy.jpg');
        }

        if (Str::endsWith($tag->slug, 'gra-programowa')) {
            return url('/images/materialy/graprogramowa.jpg');
        }

        if (Str::endsWith($tag->slug, 'recenzja')) {
            return url('/images/materialy/recenzja.jpg');
        }

        if (Str::endsWith($tag->slug, 'czasopisma')) {
            return url('/images/materialy/czasopismo.jpg');
        }

        return '';
    }
}
