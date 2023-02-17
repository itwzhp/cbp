<?php
namespace App\Domains\Reviews\Models;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int           id
 * @property int           user_id
 * @property int           material_id
 * @property Carbon|null   accepted_at
 * @property Carbon        created_at
 * @property Carbon        updated_at
 * @property-read User     reviewer
 * @property-read Material $material
 */
class Review extends Model
{
    protected $guarded = [];

    protected $casts = [
        'accepted_at' => 'datetime',
    ];

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
