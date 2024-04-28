<?php
namespace App\Domains\Materials\Models\Enums;

use App\Enums\EnumCasesValidationTrait;

enum FieldTypeEnum: string
{
    use EnumCasesValidationTrait;

    case AUTHOR = 'author';
    case TRANSLATOR = 'translator';
    case TYPESETTER = 'typesetter';
    case PROOFREADER = 'proofreader';
    case REDACTOR = 'redactor';
    case REVIEWER = 'reviewer';
    case CONTENT = 'content';
    case INTENT = 'intent';
    case REQUIREMENT = 'requirement';
    case FORM_DESCRIPTION = 'form_description';
    case SCOPE = 'scope';
}
