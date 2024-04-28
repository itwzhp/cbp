<?php
namespace App\Domains\Materials\Controllers;

use App\Domains\Users\Models\User;
use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;

class MaterialsByOwnerController extends Controller
{
    public function __invoke(User $user)
    {
        return Inertia::render(ComponentsHelper::MATERIALS)->with([
            'owner' => $user->id,
        ]);
    }
}
