<?php
namespace App\Domains\Files\Transformers;

use App\Domains\Files\Models\Attachment;
use League\Fractal\TransformerAbstract;

class AttachmentTransformer extends TransformerAbstract
{
    public function transform(Attachment $attachment): array
    {
        return [
            'id'          => $attachment->id,
            'name'        => $attachment->name,
            'mime'        => $attachment->mime,
            'url'         => $attachment->url(),
            'element'     => $attachment->element,
            'copies'      => $attachment->copies,
            'print_color' => $attachment->print_color,
            'thickness'   => $attachment->thickness,
            'size'        => $attachment->size,
            'comment'     => $attachment->comment,
            'paper_color' => $attachment->paper_color,
        ];
    }
}
