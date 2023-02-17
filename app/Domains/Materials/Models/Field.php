<?php
namespace App\Domains\Materials\Models;

use App\Domains\Materials\Models\Enums\FieldTypeEnum;
use App\Domains\Materials\Models\Traits\BelongsToMaterial;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int           id
 * @property FieldTypeEnum type
 * @property string        value
 * @property Carbon        created_at
 * @property Carbon        updated_at
 *
 * @method static Builder ofType(string $type)
 * @method static Builder authors()
 * @method static Builder redactors()
 */
class Field extends Model
{
    use BelongsToMaterial;

    protected $guarded = [];

    protected $casts = [
        'type' => FieldTypeEnum::class,
    ];

    public function scopeOfType(Builder $query, string|FieldTypeEnum $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeAuthors(Builder $query): Builder
    {
        return $query->ofType(FieldTypeEnum::AUTHOR);
    }
}
