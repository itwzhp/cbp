<?php

it('author cannot publish own material', function () {
    $user = $this->createUser()->assignRole(\App\Domains\Users\Roles\RoleHelper::AUTHOR);
});
