<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceJsonResponseMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('accept', 'application/json');

        return $next($request);
    }
}
