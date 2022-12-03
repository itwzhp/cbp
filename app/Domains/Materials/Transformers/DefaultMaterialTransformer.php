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
        'owner',
        'taxonomies',
        'fields',
        'setups',
        'scenarios',
    ];

    protected array $defaultIncludes = [
        'owner',
        'taxonomies',
    ];

    public function transform(Material $material): array
    {
        return [
            'id'           => $material->id,
            'slug'         => $material->slug,
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

    public function includeOwner(Material $material): Item
    {
        return $this->item($material->owner, new OwnerTransformer());
    }

    public function includeTaxonomies(Material $material): Collection
    {
        return $this->collection($material->getTagsGrouped(), new TagGroupTransformer());
    }

    public function includeFields(Material $material): Collection
    {
        return $this->collection($material->fields->groupBy('type'), new FieldGroupTransformer());
    }

    public function includeSetups(Material $material): Collection
    {
        return $this->collection($material->setups, new SetupTransformer());
    }

    public function includeScenarios(Material $material): Collection
    {
        return $this->collection($material->scenarios, new ScenarioTransformer());
    }
}
