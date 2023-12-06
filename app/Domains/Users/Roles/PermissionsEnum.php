<?php
namespace App\Domains\Users\Roles;

enum PermissionsEnum: string
{
    case MATERIAL_CREATE = 'create materials';
    case MATERIAL_EDIT_OWN = 'edit own materials';
    case MATERIAL_EDIT_ANY = 'edit any materials';
    case MATERIAL_DELETE_OWN = 'delete own materials';
    case MATERIAL_DELETE_ANY = 'delete any materials';
    case MATERIAL_REVIEW = 'review materials';
    case REVIEW_SET = 'review set';
    case MATERIAL_PUBLISH = 'publish materials';
    case MATERIAL_MANAGE = 'manage materials';
    case TAGS_MANAGE = 'manage tags';
}
