<?php
namespace App\Domains\Materials\Models;

use App\Domains\Materials\Models\Traits\BelongsToMaterial;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int           id
 * @property string        type
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

    public const TYPE_AUTHOR = 'author';
    public const TYPE_REDACTOR = 'redactor';
    public const TYPE_REVIEWER = 'reviewer';
    public const TYPE_CONTENT = 'content';
    public const TYPE_INTENT = 'intent';
    public const TYPE_REQUIREMENT = 'requirement';
    public const TYPE_FORM_DESCRIPTION = 'form_description';
    public const TYPE_SCOPE = 'scope';

    protected $guarded = [];

    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    public function scopeAuthors(Builder $query): Builder
    {
        return $query->ofType(static::TYPE_AUTHOR);
    }
}
