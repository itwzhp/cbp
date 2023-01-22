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
    const MATERIAL_EDIT_OWN = 'edit own materials';
    const MATERIAL_EDIT_ANY = 'edit any materials';
    const MATERIAL_DELETE_OWN = 'delete own materials';
    const MATERIAL_DELETE_ANY = 'delete any materials';
    const MATERIAL_REVIEW = 'review materials';
    const MATERIAL_PUBLISH = 'publish materials';
}
