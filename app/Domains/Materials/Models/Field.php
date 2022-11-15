<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int           id
 * @property int           material_id
 * @property string        type
 * @property string        value
 * @property Carbon        created_at
 * @property Carbon        updated_at
 * @property-read Material material
 */
class Field extends Model
{
    public const TYPE_AUTHOR = 'author';
    public const TYPE_REDACTOR = 'redactor';
    public const TYPE_REVIEWER = 'reviewer';
    public const TYPE_CONTENT = 'content';
    public const TYPE_INTENT = 'intent';

    protected $guarded = [];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
