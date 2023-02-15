<?php
namespace App\Providers;

use App\Http\Middleware\ForceJsonResponseMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware(['api', ForceJsonResponseMiddleware::class])
                ->name('api.')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware(['middleware', 'auth:sanctum', ForceJsonResponseMiddleware::class])
                ->name('api.admin.')
                ->prefix('api/admin')
                ->group(base_path('routes/admin_api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth'])
                ->name('admin.')
                ->prefix('/admin')
                ->group(base_path('routes/admin.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
