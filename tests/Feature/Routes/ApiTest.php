<?php

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Models\Tag;

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
