<?php
namespace App\Http\Middleware;

use App\Domains\Users\Models\User;
use App\Domains\Users\Roles\FrontendPermissionsAccessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request)
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        /** @var User $user */
        $user = $request->user();

        return array_merge(parent::share($request), [
            'auth' => [
                'user'        => $user,
                'permissions' => $this->getUserPermissions($user),
                'photo'       => Cache::get('image#' . $user?->id),
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => session('laravel_flash_message') ?? session('message'),
            ],
        ]);
    }

    protected function getUserPermissions(?User $user = null): array
    {
        if ($user === null) {
            return [];
        }

        return (new FrontendPermissionsAccessor($user))->toArray();
    }
}
