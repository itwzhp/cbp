<?php
namespace App\Domains\Files;

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Domains\Materials\Models\Taxonomy;

class ImagesHelper
{
    const TROOP_DOES_SLUG = 'robi-sie-w-druzynie';
    const TYPE_SLUG = 'typ';
    const TROOP_DOES_LUT = [
        'obrzedowoscsymbolika'             => 'obrzedowosc-symbolika.png',
        'uczenie-w-dzialaniu'              => 'uczenie_w_dzialaniu.png',
        'prawo-i-przyrzeczenie-harcerskie' => 'prawo_i_przyrzeczenie.png',
        'system-malych-grup'               => 'system_malych_grup.png',
        'harcerz-i-natura'                 => 'harcerz_i_natura.png',
        'sluzba'                           => 'sluzba.png',
        'osobisty-przyklad-instruktora'    => 'przyklad_osobisty.png',
        'sim'                              => 'sim.png',
    ];
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

    protected ?Taxonomy $troopDoesTaxonomy;

    protected ?Taxonomy $typeTaxonomy;

    public function __construct()
    {
        $this->troopDoesTaxonomy = Taxonomy::where('slug', static::TROOP_DOES_SLUG)->first();
        $this->typeTaxonomy = Taxonomy::where('slug', static::TYPE_SLUG)->first();
    }

    public function getFallbackForMaterial(Material $material): string
    {
        /** @var Tag $troopDoesTag */
        $troopDoesTag = $material->tags->where('taxonomy_id', $this->troopDoesTaxonomy->id ?? 0)->first();

        if ($troopDoesTag !== null) {
            return $troopDoesTag->thumb();
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
