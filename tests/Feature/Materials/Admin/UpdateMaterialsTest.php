<?php

use App\Domains\Materials\States\Published;

beforeEach(function () {
    $this->user = $this->createAuthor();

    $this->material = $this->createMaterial([
        'user_id' => $this->user->id,
    ]);
});

test('user can update its own material', function () {
    // Given
    $oldTitle = $this->material->title;
    $newTitle = fake()->sentence();
    $oldDescription = $this->material->description;

    // when
    $this->actingAs($this->user)
        ->postJson(route('api.admin.materials.update', $this->material), [
            'title' => $newTitle,
        ])
        ->assertStatus(200);

    $material = $this->material->fresh();

    // then
    $this->assertEquals($newTitle, $material->title);
    $this->assertNotEquals($oldTitle, $material->title);
    $this->assertEquals($oldDescription, $material->description);
});

test('user cannot update material if it is already published', function () {
    $newTitle = fake()->sentence();
    $this->material->update([
        'state' => Published::class,
    ]);

    // when
    $this->actingAs($this->user)
        ->postJson(route('api.admin.materials.update', $this->material), [
            'title' => $newTitle,
        ])
        ->assertStatus(403);
});
