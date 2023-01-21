<?php

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\States\Archived;
use App\Domains\Materials\States\Published;
use Carbon\Carbon;

it('has published material in db', function () {
    /** @var Material $material */
    $material = Material::factory()->published()->create();

    $this->assertInstanceOf(Material::class, $material);
    $this->assertEquals(Published::class, $material->state);
    $this->assertTrue($material->published_at->isPast());
});

it('published state takes precedence before published at', function () {
    /** @var Material $material */
    $material = Material::factory()->published()->create();
    $material->state->transitionTo(Archived::class);

    $this->assertEquals(0, Material::published()->where('id', $material->id)->count());
});

it('planned publish materials are hidden in current scopes', function () {
    // given
    /** @var Material $material */
    $material = Material::factory()->published()->create([
        'published_at' => Carbon::now()->addDay(),
    ]);

    // then
    $this->assertEquals(0, Material::published()->where('id', $material->id)->count());

    // when
    Carbon::setTestNow(Carbon::now()->addDays(2));

    // then
    $this->assertEquals(1, Material::published()->where('id', $material->id)->count());
});
