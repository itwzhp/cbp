<?php
namespace Tests\Feature\Concerns;

use App\Domains\Files\Models\Attachment;

trait AttachmentsConcerns
{
    public function createAttachment(array $attributes = []): Attachment
    {
        return Attachment::factory()->create($attributes);
    }
}
