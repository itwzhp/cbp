<?php
namespace App\Domains\Users\Models;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Factories\UserFactory;
use BackedEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int             id
 * @property int             wp_id
 * @property string          name
 * @property string|null     first_name
 * @property string|null     last_name
 * @property string          email
 * @property Carbon|null     email_verified_at
 * @property string          password
 * @property Carbon          created_at
 * @property Carbon          updated_at
 * @property-read Material[] $materials
 * @property-read Role[]     $roles
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles {
        hasPermissionTo as protected parentHasPermissionTo;
        hasRole as protected parentHasRole;
    }

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

    public function owns(Model $model): bool
    {
        if (!isset($model->user_id)) {
            return false;
        }

        return $model->user_id === $this->id;
    }

    public function hasPermissionTo($permission, $guardName = null): bool
    {
        if ($permission instanceof BackedEnum) {
            $permission = $permission->value;
        }

        return $this->parentHasPermissionTo($permission);
    }

    public function hasRole($roles, string $guard = null): bool
    {
        if ($roles instanceof BackedEnum) {
            $roles = $roles->value;
        }

        return $this->parentHasRole($roles);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'user_id');
    }

    public function scopeSearch(Builder $builder, string $search = null): Builder
    {
        if (empty($search)) {
            return $builder;
        }

        return $builder->where(function (Builder $query) use ($search) {
            $query
                ->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");

        });
    }
}
