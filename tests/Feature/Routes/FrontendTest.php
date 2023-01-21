<?php

use App\Domains\Materials\Models\Material;

it('has materials page')
    ->get('/m')
    ->assertStatus(200);

it('has single material page', function () {
    $material = Material::inRandomOrder()->first();

    $this->assertInstanceOf(Material::class, $material);
    $this->get(route('materials.show', $material))
        ->assertStatus(200);
});

it('has about page', function () {
    $this->get(route('about'))->assertStatus(200);
});
