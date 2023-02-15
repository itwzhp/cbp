<?php

use App\Domains\Reviews\ReviewsRepository;

beforeEach(function () {
    $this->user = $this->createAuthor();
    $this->otherUser = $this->createUser();
    $this->reviewer = $this->createReviewer();
    $this->admin = $this->createAdmin();

    $this->usersMaterial = $this->createMaterial([
        'user_id' => $this->user->id,
    ]);

    $this->otherMaterial = $this->createMaterial([
        'user_id' => $this->user->id,
    ]);

    app(ReviewsRepository::class)->startReview($this->usersMaterial, $this->reviewer);
});

it('tests prerequisities have beed met', function () {
    $this->assertDatabaseHas('reviews', [
        'material_id' => $this->usersMaterial->id,
        'user_id'     => $this->reviewer->id,
    ]);
});

it('user can see only his own material', function () {
    $this
        ->actingAs($this->user)
        ->getJson(route('api.admin.materials.index'))
        ->assertJsonFragment([
            'id'    => $this->usersMaterial->id,
            'title' => $this->usersMaterial->title,
        ])
        ->assertJsonMissing([
            'id'    => $this->otherMaterial->id,
            'title' => $this->otherMaterial->title,
        ]);
});
