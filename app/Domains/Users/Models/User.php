<?php
namespace App\Domains\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domains\Users\Factories\UserFactory;
use Carbon\Carbon;
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

    public function getFullName(): string
    {
        if (empty($this->first_name) && empty($this->last_name)) {
            return $this->name;
        }

        return "{$this->first_name} {$this->last_name}";
    }
}
