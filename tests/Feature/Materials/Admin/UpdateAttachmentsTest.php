<?php
beforeEach(function () {
    $this->user = $this->createAuthor();

    $this->material = $this->createMaterial([
        'user_id' => $this->user->id,
    ]);

//    $this->attachment = $this->createAttachment(
//        [
//            'material_id' => $this->material->id,
//        ]
//    );
});

it('can update elements of attachment', function () {
//    $this->actingAs($this->user)
//        ->postJson(
//            route('api.admin.materials.attachments.update', [$this->material, $this->attachment]),
//            [
//            ]
//        )->assertStatus(200);
});
