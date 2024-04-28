<?php
namespace App\Domains\Admin\Controllers;

use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function dashboard(): Response
    {
        return Inertia::render(ComponentsHelper::ADMIN_DASHBOARD);
    }

    public function settings(): Response
    {
        return Inertia::render(ComponentsHelper::ADMIN_SETTINGS);
    }

    public function testAuth()
    {
        return [
            'test auth',
        ];
    }

    public function testSanctum()
    {
        return [
            'test sanctum',
        ];
    }

    public function clearCache()
    {
        Cache::clear();

        return back();
    }
}
