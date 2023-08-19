<?php
namespace App\Domains\Materials\Models;

use App\Domains\Materials\Factories\TagFactory;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int id
 * @property string name
 * @property string|null slug
 * @property int taxonomy_id
 * @property int|null parent_id
 * @property int|null wp_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property-read Taxonomy taxonomy
 * @property-read Tag|null parent
 * @property-read Collection|Material[] materials
 *
 * @method static Builder findBySlugs(array $slugs)
 * @method static Builder notHidden()
 *
 * @mixin Eloquent
 */
class Tag extends Model implements HasMedia
{
    use HasSlug;
    use HasFactory;
    use TagHasMedia;

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

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['taxonomy_id', 'name'])
            ->saveSlugsTo('slug');
    }

    public function scopeExcludedTaxonomies(Builder $builder): Builder
    {
        return $builder->whereHas('taxonomy', function ($whereHasTaxonomies){
            $whereHasTaxonomies->whereNotIn('slug', [
                'metodyka',
                'typ-materialu',
                'cele-zrownowazonego-rozwoju',
            ]);
        });
    }

    public function scopeFindBySlugs(Builder $query, array $slugs = []): Builder
    {
        if (empty($slugs)) {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($slugs) {
            foreach ($slugs as $slug) {
                $builder->orWhere('slug', 'like', '%' . $slug);
            }

            return $builder;
        });
    }

    public function scopeNotHidden(Builder $builder): Builder
    {
        return $builder->whereRelation('taxonomy', 'is_hidden', false);
    }

    protected static function newFactory(): TagFactory
    {
        return new TagFactory();
    }
}
