<?php
namespace App\Domains\Admin\Transformers;

use App\Domains\Admin\MaterialActionsEnum;
use App\Domains\Materials\Models\Material;
use App\Domains\Materials\Transformers\DefaultMaterialTransformer;
use App\Domains\Users\Models\User;
use League\Fractal\Resource\Primitive;

class MaterialWIthActionsTransformer extends DefaultMaterialTransformer
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->availableIncludes[] = 'actions';
        $this->defaultIncludes[] = 'actions';
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
