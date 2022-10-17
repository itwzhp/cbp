<?php
namespace App\Domains\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int         id
 * @property int         wp_id
 * @property string      name
 * @property string|null first_name
 * @property string|null last_name
 * @property string      email
 * @property string      password
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'wp_id',
        'created_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function findByWPId(int $wpId): self
    {
        return User::where('wp_id', $wpId)->first();
    }
}
