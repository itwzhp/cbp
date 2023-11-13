<?php
namespace App\Domains\Files;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;

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
            return $hswTag->thumb();
        }

        /** @var Tag $typeTag */
        $typeTag = $material->tags->where('taxonomy_id', $this->typeTaxonomy->id ?? 0)->first();

        if ($typeTag !== null) {
            return $typeTag->thumb();
        }

        return url('/images/scout_thumb.jpg');
    }

    public static function getSlugFromTag(Tag $tag): string
    {
        $slugExploded = explode('-', $tag->slug);
        unset($slugExploded[0]);

        return implode('-', $slugExploded);
    }
}
