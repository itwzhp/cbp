<?php
namespace App\Domains\Materials\Models\Enums;

enum FieldTypeEnum: string
{
    case AUTHOR = 'author';
    case REDACTOR = 'redactor';
    case REVIEWER = 'reviewer';
    case CONTENT = 'content';
    case INTENT = 'intent';
    case REQUIREMENT = 'requirement';
    case FORM_DESCRIPTION = 'form_description';
    case SCOPE = 'scope';
}