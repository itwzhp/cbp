<?php
namespace App\Domains\Materials\Models;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\Factories\MaterialFactory;
use App\Domains\Materials\States\MaterialState;
use App\Domains\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ModelStates\HasStates;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * @property int           $id
 * @property int           $user_id
 * @property string        $title
 * @property string        $slug
 * @property string|null   $description
 * @property int|null      $wp_id
 * @property MaterialState $state
 * @property Carbon        $created_at
 * @property Carbon        $updated_at
 * @property Carbon|null   $published_at
 * @property-read Collection|Attachment[] $attachments
 * @property-read User                    $owner
 * @property-read Collection|Tag[]        $tags
 * @property-read Collection|Field[]      $fields
 * @property-read Collection|Setup[]      $setups
 * @property-read Collection|Scenario[]   $scenarios
 * @property-read string|null             $author
 * @property-read int|null                $authors_count
 * @property-read Licence|null            $licence
 *
 * @method static Builder published()
 * @method static Builder search(string $search)
 * @method static Builder withAuthor()
 */
class Material extends Model implements HasMedia
{
    use HasStates;
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    protected $dates = [
        'published_at',
    ];

    protected $casts = [
        'state' => MaterialState::class,
    ];

    protected $guarded = [];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)
            ->with('taxonomy')
            ->orderBy('name');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    public function setups(): HasMany
    {
        return $this->hasMany(Setup::class);
    }

    public function licence(): BelongsTo
    {
        return $this->belongsTo(Licence::class);
    }

    public function scenarios(): HasMany
    {
        return $this
            ->hasMany(Scenario::class)
            ->orderBy('order');
    }

    public static function findByWp(int $wpId): ?Material
    {
        return Material::where('wp_id', $wpId)->first();
    }

    public function scopePublished(Builder $builder): Builder
    {
        return $builder->where('published_at', '<', Carbon::now());
    }

    public function scopeForTags(Builder $builder, ?array $tags)
    {
        if (empty($tags)) {
            return;
        }

        $builder->where(function (Builder $builder) use ($tags) {
            foreach ($tags as $tag) {
                $builder->orWhereHas('tags', function (Builder $query) use ($tag) {
                    $query->where('id', $tag);
                });
            }
        });
    }

    public function scopeSearch(Builder $builder, ?string $search)
    {
        return $builder->when($search, function (Builder $query, string $search) {
            $query->whereRaw('match(title, description) against (? in boolean mode)', [$search]);
        });
    }

    public function scopeWithAuthor(Builder $builder): Builder
    {
        $builder->addSelect([
            'author' => Field::authors()
                ->whereColumn('material_id', 'materials.id')
                ->select('value')
                ->take(1),
        ]);

        $builder->addSelect([
            'authors_count' => Field::authors()
                ->whereColumn('material_id', 'materials.id')
                ->selectRaw('count(*)'),
        ]);

        return $builder;
    }

    public function getTagsGrouped(): Collection
    {
        return $this->tags->groupBy('taxonomy_id');
    }

    public function toSearchableArray(): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
        ];
    }

    protected static function newFactory(): MaterialFactory
    {
        return MaterialFactory::new();
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_FILL, 290, 192)
            ->nonQueued();

        $this->addMediaConversion('cover')
            ->fit(Manipulations::FIT_CROP, 1000, 300)
            ->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->useFallbackUrl(url('/images/scout.jpg'))
            ->useFallbackUrl(url('/images/scout_thumb.jpg'), 'thumb')
            ->useFallbackUrl(url('/images/scout_cover.jpg'), 'cover')
            ->singleFile();
    }

    public function thumb(): string
    {
        return $this->getFirstMediaUrl('cover', 'thumb');
    }

    public function cover(): string
    {
        return $this->getFirstMediaUrl('cover', 'cover');
    }
}
