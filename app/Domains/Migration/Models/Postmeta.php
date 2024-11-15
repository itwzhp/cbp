<?php
namespace App\Domains\Migration\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    meta_id
 * @property int    post_id
 * @property string meta_key
 * @property string meta_value
 */
class Postmeta extends Model
{
    protected $connection = 'wp';

    protected $table = 'wp_postmeta';

    protected $primaryKey = 'meta_id';

    public function deserialize()
    {
        // @phpstan-ignore-next-line
        return unserialize($this->meta_value);
    }
}
