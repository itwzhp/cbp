<?php
namespace App\Domains\Admin;

enum MaterialActionsEnum: string
{
    case PUBLISH = 'publish';
    case SUBMIT = 'submit';
    case ARCHIVE = 'archive';
    case DELETE = 'delete';
    case REVIEW = 'review';
    case UPDATE = 'update';
    case VIEW = 'view';
}
