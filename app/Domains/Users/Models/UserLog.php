<?php
namespace App\Domains\Users\Models;

use App\Domains\Users\ActionsEnum;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int             id
 * @property int             user_id
 * @property int|null        model_id
 * @property string|null     model_type
 * @property string          action
 * @property array|null      details
 * @property Carbon          created_at
 * @property Carbon          updated_at
 * @property-read User       $user
 * @property-read Model|null $model
 *
 * @mixin Eloquent
 */
class UserLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'details' => 'array',
        'action'  => ActionsEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
