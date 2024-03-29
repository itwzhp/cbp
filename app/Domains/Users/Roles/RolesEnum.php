<?php
namespace App\Domains\Users\Roles;

enum RolesEnum: string
{
    case ADMIN = 'Admin';
    case AUTHOR = 'Author';

    /** @deprecated  */
    case CONTRIBUTOR = 'Contributor';

    case EDITOR = 'Editor';
    case REVIEWER = 'Reviewer';
    case REVIEW_MANAGER = 'Review Manager';
}
