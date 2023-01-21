<?php
namespace App\Domains\Users\Roles;

class RoleHelper
{
    const ADMIN = 'Admin';
    const AUTHOR = 'Author';
    const CONTRIBUTOR = 'Contributor';
    const EDITOR = 'Editor';
    const REVIEWER = 'Reviewer';

    // Authors
    const MATERIAL_CREATE = 'create materials';
    const MATERIAL_EDIT = 'edit materials';
    const MATERIAL_DELETE = 'delete materials';
}
