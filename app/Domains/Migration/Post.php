<?php
namespace App\Domains\Migration;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property  int   ID
 * @property int    post_author
 * @property Carbon post_date_gmt
 */
class Post extends Model
{
    const STATUS_PUBLISH = 'publish';

    protected $connection = 'wp';

    protected $table = 'wp_posts';

    protected $dates = [
        'post_date_gmt',
    ];

    protected static $globalScopes = ['published'];

    public function scopePublished(Builder $builder): Builder
    {
        return $builder->where('post_status', static::STATUS_PUBLISH);
    }
}
