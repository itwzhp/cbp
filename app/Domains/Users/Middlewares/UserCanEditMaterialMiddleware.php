<?php
namespace App\Domains\Users\Middlewares;

use App\Domains\Materials\Models\Material;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Domains\Users\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCanEditMaterialMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        if (($user = Auth::user()) === null) {
            throw new UnauthorizedException('Brak zalogowanego użytkownika');
        }

        /** @var Material $material */
        $material = $request->route('material');

        if ($user->cannot('update', $material)) {
            throw new UnauthorizedException('Brak dostępu');
        }

        return $next($request);
    }
}
