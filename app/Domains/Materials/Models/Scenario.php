<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         id
 * @property int         material_id
 * @property int|null    order
 * @property string|null title
 * @property string|null form
 * @property int|null    duration
 * @property string|null responsible
 * @property string|null description
 * @property string|null materials
 * @property int|null    wp_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class Scenario extends Model
{
    protected $guarded = [];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
