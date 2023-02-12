<?php

it('disallows guests to view dashboard', function () {
    $this->get(route('admin.dashboard'))
        ->assertStatus(302);
});

it('allows logged users to view dashboard', function () {
    $user = $this->firstOrCreateUser();
    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertStatus(200);
});
