<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Users\Models\User;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(): Response
    {
        return Inertia::render(ComponentsHelper::ADMIN_USERS_INDEX);
    }

    public function edit(User $user): Response
    {
        $user->load('roles');
        $roles = Role::all();

        return Inertia::render(ComponentsHelper::ADMIN_USERS_EDIT)
            ->with(compact('user', 'roles'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return ['ok'];
    }
}
