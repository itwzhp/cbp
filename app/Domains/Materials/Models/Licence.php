<?php
namespace App\Domains\Materials\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int id
 * @property string name
 * @property string|null url
 * @property int|null wp_id
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property-read string icon
 */
class Licence extends Model
{
    protected $guarded = [];

    protected $appends = ['icon'];

    public function getIconAttribute(): string
    {
        if (Str::contains($this->name, 'BY')) {
            return url('/images/licence/cc-by.png');
        }

        if (Str::contains($this->name, 'ZHP')) {
            return url('/images/licence/zhp.png');
        }

        return url('/images/licence/cc-sa.png');
    }
}
