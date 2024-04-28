<?php

use App\Domains\Materials\Models\Material;
use App\Domains\Materials\States\Archived;
use App\Domains\Materials\States\ChangesRequested;
use App\Domains\Materials\States\Draft;
use App\Domains\Materials\States\InReview;
use App\Domains\Materials\States\Published;

it('checks if material has editable state', function ($state) {
    /** @var Material $material */
    $material = $this->createMaterial([
        'state' => $state,
    ]);

    $this->assertTrue($material->hasEditableState());
})->with([
    Draft::class,
    InReview::class,
    ChangesRequested::class,
    Archived::class,
]);

it('published material has not editable state', function () {
    /** @var Material $material */
    $material = $this->createMaterial([
        'state' => Published::class,
    ]);

    $this->assertFalse($material->hasEditableState());
});
