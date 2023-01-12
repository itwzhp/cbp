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
        'program'                => '',
        'poradnik'               => '',
        'praca-naukowa'          => '',
        'konspekt-ksztalceniowy' => '',
        'konspekt-programowy'    => '',
        'propozycja-programowa'  => 'propozycja_programowa.png',
    ];

    public static function getFallbackForMaterial(Material $material): string
    {
        $troopDoesTaxonomy = Taxonomy::where('slug', static::TROOP_DOES_SLUG)->first();

        /** @var Tag $troopDoesTag */
        $troopDoesTag = $material->tags->where('taxonomy_id', $troopDoesTaxonomy->id ?? 0)->first();

        if ($troopDoesTag !== null) {
            return $troopDoesTag->thumb();
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
