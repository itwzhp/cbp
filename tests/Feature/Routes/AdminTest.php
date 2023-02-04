<?php

it('disallows guests to view index', function () {
    $this->get(route('admin.index'))
        ->assertStatus(302);
});

it('allows logged users to view dashboard', function () {
    $user = $this->firstOrCreateUser();
    $this->actingAs($user)
        ->get(route('admin.index'))
        ->assertStatus(200);
});
