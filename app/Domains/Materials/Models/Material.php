<?php
namespace App\Domains\Materials\Models;

use App\Domains\Materials\States\MaterialState;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

/**
 * @property int         id
 * @property int         user_id
 * @property string      title
 * @property string      slug
 * @property string|null description
 * @property int|null    wp_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property Carbon|null published_at
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
}
