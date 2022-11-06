<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int         id
 * @property string      name
 * @property string|null url
 * @property int|null    wp_id
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class Licence extends Model
{
    protected $guarded = [];
}
