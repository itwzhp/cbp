<?php

use App\Domains\Materials\Models\Material;

it('has single material page', function () {
    $material = Material::inRandomOrder()->first();

    $this->assertInstanceOf(Material::class, $material);
    $this->get(route('materials.show', $material))
        ->assertStatus(200);
});

it('tests pages are ok', function ($url) {
    $this->get($url)->assertStatus(200);
})->with([
    '/m',
    fn () => route('about'),
]);
