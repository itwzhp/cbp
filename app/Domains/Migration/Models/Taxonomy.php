<?php
namespace App\Domains\Migration\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Taxonomy extends Model
{
    protected $connection = 'wp';
    protected $table = 'wp_term_taxonomy';
    protected $primaryKey = 'term_taxonomy_id';

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    public function scopeExclude(Builder $builder): Builder
    {
        return $builder->whereNotIn('taxonomy', [
            'nav_menu'
        ]);
    }
}
