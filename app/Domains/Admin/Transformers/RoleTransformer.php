<?php
namespace App\Domains\Admin\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Role;

class RoleTransformer extends TransformerAbstract
{
    public function transform(Role $role): array
    {
        return [
            'id'   => $role->id,
            'name' => $role->name,
        ];
    }
}
