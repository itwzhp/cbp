<?php
namespace App\Domains\Materials\Transformers;

use App\Domains\Files\Transformers\AttachmentTransformer;
use App\Domains\Materials\Models\Field;
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
        'authors',
        'licence',
    ];

    protected array $defaultIncludes = [
    ];

    public function transform(Material $material): array
    {
        return [
            'id'           => $material->id,
            'slug'         => $material->slug,
            'title'        => $material->title,
            'content'      => $material->description,
            'published_at' => $material->published_at->timestamp ?? null,
            'author'       => $this->getAuthor($material),
            'thumb'        => $material->thumb(),
            'cover'        => $material->cover(),
            'type'         => $material->type,
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

    public function includeAuthors(Material $material): Collection
    {
        return $this->collection(
            $material->fields->where('type', Field::TYPE_AUTHOR),
            new FieldTransformer()
        );
    }

    public function includeLicence(Material $material): Item
    {
        return $this->item($material->licence, new LicenceTransformer());
    }

    protected function getAuthor(Material $material): string
    {
        if ($material->authors_count === 1) {
            return $material->author ?? $material->owner->getFullName();
        }

        if ($material->authors_count > 1) {
            return $material->author . ' et al.';
        }

        return $material->owner->getFullName();
    }
}
