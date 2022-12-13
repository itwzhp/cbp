<?php
namespace App\Http\Middleware;

use App\Domains\Users\Exceptions\UnauthorizedException;
use Illuminate\Http\Request;

class AfterMiddleware
{
    public function handle(Request $request, \Closure $next)
    {
        try {
            return $next($request);
        } catch (UnauthorizedException $exception) {
            flash($exception->getMessage());

            return redirect('/');
        }
    }
}
