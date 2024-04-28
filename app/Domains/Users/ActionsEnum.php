<?php
namespace App\Domains\Users;

enum ActionsEnum: string
{
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';
    case EDITED = 'edited';
}
