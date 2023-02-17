<?php
namespace App\Domains\Materials\Models\Enums;

enum PresetEnum: string
{
    case CONSPECTUS = 'konspekt';
    case PROGRAM = 'program';
    case PROPOSITION = 'propozycja';
}
