<?php
namespace App\Domains\Files\Enums;

enum ThicknessEnum: string
{
    case NORMAL = 'normal';
    case THICK = 'thick';
    case VERY_THICK = 'very_thick';

    public static function fromWp(?int $wpId): ?self
    {
        if ($wpId === null) {
            return null;
        }

        return match ($wpId) {
            1 => self::NORMAL,
            2 => self::THICK,
            3 => self::VERY_THICK,
            default => null
        };
    }
}
