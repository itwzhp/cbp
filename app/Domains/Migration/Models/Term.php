<?php
namespace App\Domains\Migration\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $connection = 'wp';
    protected $table = 'wp_terms';
    protected $primaryKey = 'term_id';
}
