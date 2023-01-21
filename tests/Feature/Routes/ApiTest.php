<?php

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;
use App\Domains\Visuals\Models\Slide;

it('has taxonomies endpoint', function () {
    /** @var Tag $tag */
    $tag = Tag::first();

    $this->get(route('api.taxonomies.index'))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id'   => $tag->id,
            'name' => $tag->name,
        ]);
});

it('has material index API endpoint', function () {
    /** @var Material $material */
    $material = Material::published()
        ->orderBy('published_at', 'desc')
        ->first();

    $this->get(route('api.materials.index'))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id'    => $material->id,
            'title' => $material->title,
        ]);
});

it('has sliders api route', function () {
    /** @var Slide $slide */
    $slide = Slide::factory()->create();

    $this->assertInstanceOf(Slide::class, $slide);

    $this->get(route('api.sliders.index'))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id'  => $slide->id,
            'url' => $slide->url,
        ]);
});
