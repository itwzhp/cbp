<?php
namespace App\Domains\Materials\Models;

use App\Domains\Files\Models\Attachment;
use App\Domains\Materials\States\MaterialState;
use App\Domains\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\ModelStates\HasStates;

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
 *
 * @property-read Collection|Attachment[] $attachments
 * @property-read User                    owner
 * @property-read Collection|Tag[]        $tags
 * @property-read Collection|Field[]      $fields
 *
 * @method static Builder published()
 */
class Material extends Model
{
    use HasStates;

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

    public function scopePublished(Builder $builder): Builder
    {
        return $this->where('published_at', '<', Carbon::now());
    }

    public function getTagsGrouped(): Collection
    {
        return $this->tags->groupBy('taxonomy_id');
    }
}
