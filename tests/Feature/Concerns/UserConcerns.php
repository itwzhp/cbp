<?php
namespace Tests\Feature\Concerns;

use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\RoleHelper;

trait UserConcerns
{
    public function createUser(array $params = []): User
    {
        return User::factory()->create($params);
    }

    public function createAuthor(array $params = []): User
    {
        /** @var User $user */
        $user = User::factory()->create($params);

        $user->assignRole(RoleHelper::AUTHOR);

        return $user;
    }

    public function firstOrCreateUser(): User
    {
        if ($user = User::first()) {
            return $user;
        }

        return $this->createUser();
    }
}
