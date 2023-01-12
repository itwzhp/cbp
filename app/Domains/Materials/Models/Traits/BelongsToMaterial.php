<?php
namespace App\Domains\Materials\Models\Traits;

use App\Domains\Materials\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property      int      $material_id
 * @property-read Material $material
 *
 * @mixin Model
 */
trait BelongsToMaterial
{
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
