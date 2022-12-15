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
 * @property int                          id
 * @property int                          user_id
 * @property string                       title
 * @property string                       slug
 * @property string|null                  description
 * @property int|null                     wp_id
 * @property string                       state
 * @property Carbon                       created_at
 * @property Carbon                       updated_at
 * @property Carbon|null                  published_at
 * @property-read Collection|Attachment[] $attachments
 * @property-read User                    owner
 * @property-read Collection|Tag[]        $tags
 * @property-read Collection|Field[]      $fields
 * @property-read Collection|Setup[]      $setups
 * @property-read Collection|Scenario[]   $scenarios
 *
 * @method static Builder published()
 * @method static Builder search(string $search)
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

    public function scenarios(): HasMany
    {
        return $this
            ->hasMany(Scenario::class)
            ->orderBy('order');
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
        if (empty($search)) {
            return;
        }

        $builder->where(function (Builder $builder) use ($search) {
            $builder->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
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
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_FILL, 300, 300)
            ->nonQueued();
    }

    public function thumb(): string
    {
        return url('/images/scout.jpg');
    }
}
