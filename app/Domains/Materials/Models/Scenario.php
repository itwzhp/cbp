<?php
namespace App\Domains\Materials\Models;

use App\Domains\Materials\Models\Traits\BelongsToMaterial;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int         id
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
    use BelongsToMaterial;

    protected $guarded = [];
}
