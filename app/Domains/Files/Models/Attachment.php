<?php
namespace App\Domains\Files\Models;

use App\Domains\Materials\Models\Material;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int      id
 * @property string   name
 * @property int      material_id
 * @property int|null wp_id
 * @property string   path
 * @property string   mime
 * @property int      downloads
 * @property Carbon   created_at
 * @property Carbon   updated_at
 *
 * @property Material material
 */
class Attachment extends Model
{
    protected $guarded = [];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
