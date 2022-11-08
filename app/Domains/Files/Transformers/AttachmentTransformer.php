<?php
namespace App\Domains\Files\Transformers;

use App\Domains\Files\Models\Attachment;
use League\Fractal\TransformerAbstract;

class AttachmentTransformer extends TransformerAbstract
{
    public function transform(Attachment $attachment): array
    {
        return [
            'id'   => $attachment->id,
            'name' => $attachment->name,
            'mime' => $attachment->mime,
            'url'  => $attachment->url(),
        ];
    }
}
