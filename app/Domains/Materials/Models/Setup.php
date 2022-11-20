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
 * @property-read Material $material
 */
class Setup extends Model
{
    protected $fillable = [
        'material_id',
        'capacity_min',
        'capacity_opt',
        'capacity_max',
        'duration',
        'time',
        'instructor_count',
        'instructor_competence',
        'remarks',
        'location',
        'technical_requirements',
        'materials',
        'participant_materials',
        'participant_clothing',
    ];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function isEmpty(): bool
    {
        foreach ($this->fillable as $field) {
            if ($field === 'material_id') {
                continue;
            }

            if (!empty($this->getAttribute($field))) {
                return false;
            }
        }

        return true;
    }
}
