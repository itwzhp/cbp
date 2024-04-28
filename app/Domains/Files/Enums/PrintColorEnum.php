<?php
namespace App\Domains\Files\Enums;

use App\Enums\EnumCasesValidationTrait;

enum PrintColorEnum: string
{
    use EnumCasesValidationTrait;

    case COLOR = 'color';
    case BLACK = 'black';

    public static function fromWp(?int $wpId): ?self
    {
        return match ($wpId) {
            1       => self::COLOR,
            2       => self::BLACK,
            default => null
        };
    }
}
