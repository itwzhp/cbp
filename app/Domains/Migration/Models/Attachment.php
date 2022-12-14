<?php
namespace App\Domains\Migration\Models;

/**
 * @property-read string path
 */
class Attachment extends Post
{
    public function getPathAttribute(): string
    {
        return str_replace('http://cbp.zhp.pl/wp-content/uploads/', '', $this->guid);
    }
}
