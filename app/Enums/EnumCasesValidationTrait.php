<?php
namespace App\Enums;

use BackedEnum;

/** @extends BackedEnum */
trait EnumCasesValidationTrait
{
    public static function rules(): string
    {
        return 'in:'
            . collect(static::cases())
                ->map(function (BackedEnum $enum) {
                    return $enum->value;
                })
                ->implode(',');
    }
}
