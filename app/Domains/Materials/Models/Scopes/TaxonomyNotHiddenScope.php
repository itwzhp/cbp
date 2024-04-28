<?php
namespace App\Domains\Materials\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TaxonomyNotHiddenScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('is_hidden', false);
    }
}
