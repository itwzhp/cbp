<?php
namespace App\Domains\Files\Enums;

use App\Enums\EnumCasesValidationTrait;

enum SizeEnum: string
{
    use EnumCasesValidationTrait;

    case A4 = 'A4';
    case A3 = 'A3';
    case A2 = 'A2';
    case A1 = 'A1';
    case A5 = 'A5';
    case A6 = 'A6';
    case OTHER = 'OTHER';

    public static function fromWp(?int $wpId): self
    {
        return match ($wpId) {
            1       => self::A4,
            2       => self::A3,
            3       => self::A2,
            4       => self::A1,
            5       => self::A5,
            6       => self::A6,
            7       => self::OTHER,
            default => self::A4,
        };
    }
}
