<?php
namespace Tests\Feature\Concerns;

use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RolesEnum;
use BackedEnum;

trait UserConcerns
{
    public function createUser(array $params = []): User
    {
        return User::factory()->create($params);
    }

    public function createUserAndAssignRole(array $params = [], string|RolesEnum $role = RolesEnum::AUTHOR): User
    {
        /** @var User $user */
        $user = User::factory()->create($params);

        if ($role instanceof BackedEnum) {
            $role = $role->value;
        }

        $user->assignRole($role);

        return $user;
    }

    public function createAuthor(array $params = []): User
    {
        return $this->createUserAndAssignRole($params, RolesEnum::AUTHOR);
    }

    public function firstOrCreateUser(): User
    {
        if ($user = User::first()) {
            return $user;
        }

        return $this->createUser();
    }

    public function createReviewer(array $params = []): User
    {
        return $this->createUserAndAssignRole($params, RolesEnum::REVIEWER);
    }

    public function createAdmin(array $params = []): User
    {
        return $this->createUserAndAssignRole($params, RolesEnum::ADMIN);
    }
}
