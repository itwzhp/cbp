<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Files\Transformers\AttachmentTransformer;
use App\Domains\Materials\Models\Material;
use App\Domains\Users\Transformers\OwnerTransformer;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class DefaultMaterialTransformer extends TransformerAbstract
{
    protected array $availableIncludes = [
        'attachments',
    ];

    protected array $defaultIncludes = [
        'author',
    ];

    public function transform(Material $material): array
    {
        return [
            'id'           => $material->id,
            'title'        => $material->title,
            'content'      => $material->description,
            'published_at' => $material->published_at->timestamp ?? null,
        ];
    }

    public function includeAttachments(Material $material): Collection
    {
        return $this
            ->collection($material->attachments, new AttachmentTransformer());
    }

    public function includeAuthor(Material $material): Item
    {
        return $this->item($material->owner, new OwnerTransformer());
    }
}
