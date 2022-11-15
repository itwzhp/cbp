<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int           id
 * @property int           material_id
 * @property int|null      capacity_min
 * @property int|null      capacity_opt
 * @property int|null      capacity_max
 * @property int|null      duration
 * @property string|null   time
 * @property int|null      instructor_count
 * @property string|null   instructor_competence
 * @property string|null   remarks
 * @property string|null   location
 * @property string|null   technical_requirements
 * @property string|null   materials
 * @property string|null   participant_materials
 * @property string|null   participant_clothing
 * @property Carbon        created_at
 * @property Carbon        updated_at
 *
 * @property-read Material $material
 */
class Setup extends Model
{
    protected $guarded = [];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
}
