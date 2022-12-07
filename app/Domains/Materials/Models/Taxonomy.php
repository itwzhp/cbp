<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int                   id
 * @property string                name
 * @property string|null           slug
 * @property Carbon                created_at
 * @property Carbon                updated_at
 * @property-read Collection|Tag[] tags
 */
class Taxonomy extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
    ];

    public function tags(): HasMany
    {
        return $this
            ->hasMany(Tag::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
