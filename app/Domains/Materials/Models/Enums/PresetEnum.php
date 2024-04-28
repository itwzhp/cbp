<?php
namespace App\Domains\Materials\Models\Enums;

enum PresetEnum: string
{
    case CONSPECTUS_TRAINING = 'konspekt_ksztalceniowy';
    case CONSPECTUS_PROGRAM = 'konspekt_programowy';
    case PROGRAM = 'program';
    case PROPOSITION = 'propozycja';
    case TRAINING_GAME = 'gra_ksztalceniowa';
    case PROGRAM_GAME = 'gra_programowa';
    case HANDBOOK = 'poradnik';
    case REVIEW = 'recenzja';
    case MAGAZINE = 'czasopismo';
    case ARTICLE = 'artykul';

    public static function options(): array
    {
        return [
            [
                'slug' => self::CONSPECTUS_PROGRAM,
                'name' => 'Konspekt programowy',
                'icon' => url('/images/ikony/konspekty_programowe.png'),
            ],
            [
                'slug' => self::CONSPECTUS_TRAINING,
                'name' => 'Konspekt kształceniowy',
                'icon' => url('/images/ikony/konspekty_ksztalceniowe.png'),
            ],
            [
                'slug' => self::PROGRAM_GAME,
                'name' => 'Gra programowa',
                'icon' => url('/images/ikony/gry_programowe.png'),
            ],
            [
                'slug' => self::TRAINING_GAME,
                'name' => 'Gra kształceniowa',
                'icon' => url('/images/ikony/gry_ksztalceniowe.png'),
            ],
            [
                'slug' => self::ARTICLE,
                'name' => 'Artykuł',
                'icon' => url('/images/ikony/artykuly.png'),
            ],
            [
                'slug' => self::PROPOSITION,
                'name' => 'Propozycja',
                'icon' => url('/images/ikony/propozycje_programowe.png'),
            ],
            [
                'slug' => self::HANDBOOK,
                'name' => 'Poradnik',
                'icon' => url('/images/ikony/poradniki.png'),
            ],
            [
                'slug' => self::MAGAZINE,
                'name' => 'Czasopismo',
                'icon' => url('/images/ikony/czasopisma.png'),
            ],
            [
                'slug' => self::REVIEW,
                'name' => 'Recenzja',
                'icon' => url('/images/ikony/recenzja.png'),
            ],
        ];
    }
}
