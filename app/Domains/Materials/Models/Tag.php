<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int           id
 * @property string        name
 * @property int           taxonomy_id
 * @property int|null      wp_id
 * @property Carbon        created_at
 * @property Carbon        updated_at
 *
 * @property-read Taxonomy taxonomy
 */
class Tag extends Model
{
    protected $fillable = [
        'name',
        'taxonomy_id',
        'wp_id',
    ];

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }
}
