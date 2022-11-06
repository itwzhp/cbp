<?php
namespace App\Domains\Migration\Models;

use App\Domains\Materials\Repositories\MotifsRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * @property int    ID
 * @property int    post_author
 * @property string post_title
 * @property string post_content
 * @property string post_name
 * @property Carbon post_date_gmt
 * @property string guid
 *
 * @method static Builder published()
 */
class Post extends Model
{
    const STATUS_PUBLISH = 'publish';

    protected $connection = 'wp';

    protected $table = 'wp_posts';

    protected $primaryKey = 'ID';

    protected $dates = [
        'post_date_gmt',
    ];

    protected $with = [
        'attachments',
        'zakres',
    ];

    protected static $globalScopes = ['published'];

    public function scopePublished(Builder $builder): Builder
    {
        return $builder->where('post_status', static::STATUS_PUBLISH);
    }

    public function scopeNotPages(Builder $builder): Builder
    {
        return $builder->whereNot('post_type', 'page');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'post_parent', 'ID')
            ->where('post_type', 'attachment');
    }

    public function zakres(): HasMany
    {
        return $this->hasMany(Postmeta::class, 'post_id', 'ID')
            ->where('meta_key', '=', 'wpcf-zakres');
    }

    public function taxonomies(): BelongsToMany
    {
        return $this
            ->belongsToMany(Taxonomy::class, 'wp_term_relationships', 'object_id', 'term_taxonomy_id')
            ->with('term');
    }

    public function motifs(): \Illuminate\Support\Collection
    {
        /** @var Postmeta $wpMotifs */
        $wpMotifs = $this->getPostmetas('wpcf-motyw-glowny')->first();

        if ($wpMotifs === null) {
            return collect([]);
        }

        $motifIds = array_values(Arr::flatten($wpMotifs->deserialize()));

        /** @var Postmeta $customMotif */
        $customMotif = $this->getPostmetas('wpcf-uszczegolowienie')->first();
        $motifs = collect([]);

        /** @var MotifsRepository $motifRepo */
        $motifRepo = app(MotifsRepository::class);

        foreach ($motifIds as $wpId) {
            if ($wpId > 6) {
                $motifs->push($motifRepo->addCustom($customMotif->meta_value));

                continue;
            }

            $motifs->push($motifRepo->get($wpId));
        }

        return $motifs;
    }

    public function getPostmetas(string $key): Collection
    {
        return Postmeta::where('post_id', $this->ID)
            ->where('meta_key', $key)
            ->get();
    }

    public function tagIds(): array
    {
        return Arr::pluck(DB::connection('wp')
            ->select(DB::raw('select tax.term_id from wp_term_relationships r
            left join wp_term_taxonomy tax on r.term_taxonomy_id = tax.term_taxonomy_id
            where r.object_id = ?'), [$this->ID]), 'term_id');
    }

    public function licence(): ?int
    {
        return $this
            ->getPostmetas('wpcf-licencja')
            ->first()
            ->meta_value ?? null;
    }
}
