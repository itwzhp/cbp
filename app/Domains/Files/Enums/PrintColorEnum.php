<?php
namespace App\Domains\Files\Enums;

enum PrintColorEnum: string
{
    case COLOR = 'color';
    case BLACK = 'black';

    public static function fromWp(?int $wpId): ?self
    {
        return match ($wpId) {
            1 => self::COLOR,
            2 => self::BLACK,
            default => null
        };
    }
}
