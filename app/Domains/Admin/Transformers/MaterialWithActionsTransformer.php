<?php
namespace App\Domains\Admin\Transformers;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use League\Fractal\Resource\Primitive;
use League\Fractal\TransformerAbstract;

class MaterialWithActionsTransformer extends TransformerAbstract
{
    protected User $user;

    protected array $availableIncludes = ['actions'];

    protected array $defaultIncludes = ['actions'];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function transform(Material $material): array
    {
        return [
            'id'           => $material->id,
            'slug'         => $material->slug,
            'title'        => $material->title,
            'content'      => $material->description,
            'published_at' => $material->published_at->timestamp ?? null,
            'author'       => $material->owner->getFullName(),
            'type'         => $material->type,
            'state'        => $material->state->toSimplifiedString(),
        ];
    }

    public function includeActions(Material $material): Primitive
    {
        $actions = collect(MaterialActionsEnum::cases())
            ->filter(function (MaterialActionsEnum $action) use ($material) {
                return $this->user->can($action->value, $material);
            })
            ->map(function (MaterialActionsEnum $action) {
                return $action->value;
            })
            ->toArray();

        return $this->primitive($actions);
    }
}
