<?php
namespace App\Domains\Users\Models;

use App\Domains\Users\Factories\UserFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int         id
 * @property int         wp_id
 * @property string      name
 * @property string|null first_name
 * @property string|null last_name
 * @property string      email
 * @property Carbon|null email_verified_at
 * @property string      password
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
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
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'email_verified_at',
        'updated_at',
        'wp_id',
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

    public function getAvatarUrl(): string
    {
        return 'https://www.gravatar.com/avatar/'
            . md5(strtolower(trim($this->email)))
            . '?s=40';
    }

    public function getApiToken(): string
    {
        /** @var PersonalAccessToken $token */
        $token = $this->tokens()
            ->where('name', 'api')
            ->where(function (Builder $q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', Carbon::now());
            })->first();

        if ($token !== null) {
            return $token->token;
        }

        $token = $this->createToken('api');

        return $token->plainTextToken;
    }
}
