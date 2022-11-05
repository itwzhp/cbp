<?php
namespace App\Domains\Migration\Models;

use App\Domains\Migration\Models\Postmeta;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    ID
 * @property int    post_author
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

    protected static $globalScopes = ['published'];

    public function scopePublished(Builder $builder): Builder
    {
        return $builder->where('post_status', static::STATUS_PUBLISH);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'post_parent', 'ID')
            ->where('post_type', 'attachment');
    }

    public function zakres()
    {
        return $this->hasMany(Postmeta::class, 'post_id', 'ID')
            ->where('meta_key', '=', 'wpcf-zakres');
    }
}
