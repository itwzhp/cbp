<?php

it('protects admin api behind authorization', function () {
    $this->getJson(route('api.admin.materials.index'))
        ->assertStatus(401);
});

it('allows logged user to see admin api routes', function () {
    $user = $this->createUser();

    $this->actingAs($user)
        ->getJson(route('api.admin.materials.index'))
        ->assertStatus(200);
});
