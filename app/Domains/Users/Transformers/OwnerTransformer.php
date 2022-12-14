<?php
namespace App\Domains\Users\Transformers;

use App\Domains\Users\Models\User;
use League\Fractal\TransformerAbstract;

class OwnerTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'id'     => $user->id,
            'name'   => $user->getFullName(),
            'avatar' => $user->getAvatarUrl(),
        ];
    }
}
