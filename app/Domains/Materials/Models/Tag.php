<?php
namespace App\Domains\Materials\Models;

use App\Domains\Materials\Factories\TagFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int           id
 * @property string        name
 * @property string|null   slug
 * @property int           taxonomy_id
 * @property int|null      parent_id
 * @property int|null      wp_id
 * @property Carbon        created_at
 * @property Carbon        updated_at
 * @property-read Taxonomy taxonomy
 * @property-read Tag|null parent
 */
class Tag extends Model
{
    use HasSlug;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'taxonomy_id',
        'wp_id',
        'parent_id',
    ];

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['taxonomy_id', 'name'])
            ->saveSlugsTo('slug');
    }

    protected static function newFactory(): TagFactory
    {
        return new TagFactory();
    }
}
