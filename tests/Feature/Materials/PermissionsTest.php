<?php

use App\Domains\Materials\States\Draft;
use App\Domains\Materials\States\InReview;
use App\Domains\Materials\States\Published;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Domains\Users\Roles\RolesEnum;

beforeEach(function () {
    $this->author = $this->createUser()->assignRole(RolesEnum::AUTHOR->value);
    $this->material = $this->createMaterial([
        'user_id' => $this->author->id,
        'state'   => Draft::class,
    ]);
});

test('author cannot publish own material', function () {
    // given
    $this->actingAs($this->author);

    // then
    $this->expectException(UnauthorizedException::class);

    // when
    $this->material->state->transitionTo(Published::class);

    // when
    $this->material->state->transitionTo(InReview::class);

    // then
    $this->assertEquals(InReview::class, $this->material->state);
});

test('editor can publish any material', function () {
    // given
    $editor = $this->createUser()->assignRole(RolesEnum::EDITOR->value);
    $this->actingAs($editor);

    // when
    $this->material->state->transitionTo(Published::class);

    // then
    $this->assertEquals(Published::class, $this->material->state);
});
