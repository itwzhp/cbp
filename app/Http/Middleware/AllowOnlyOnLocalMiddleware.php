<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;

class AllowOnlyOnLocalMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!app()->environment('local')) {
            throw new UnauthorizedException();
        }

        return $next($request);
    }
}
