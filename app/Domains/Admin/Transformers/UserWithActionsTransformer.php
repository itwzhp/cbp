<?php
namespace App\Domains\Admin\Transformers;

use App\Domains\Users\Models\User;
use League\Fractal\TransformerAbstract;

class UserWithActionsTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = ['roles'];

    public function transform(User $user): array
    {
        return [
            'id'       => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,
            'fullname' => $user->getFullName(),
        ];
    }

    public function includeRoles(User $user)
    {
        return $this
            ->collection($user->roles, new RoleTransformer());
    }
}
