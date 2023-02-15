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

it('allows user to authorize via token', function () {
    $user = $this->createUser();
    $token = $user->getApiToken();

    $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])
        ->getJson(route('api.admin.materials.index'))
        ->assertStatus(200);
});
