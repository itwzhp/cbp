<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                   id
 * @property string                name
 * @property Carbon                created_at
 * @property Carbon                updated_at
 *
 * @property-read Collection|Tag[] tags
 */
class Taxonomy extends Model
{
    protected $fillable = [
        'name',
    ];

    public function tags(): HasMany
    {
        return $this
            ->hasMany(Tag::class);
    }
}
