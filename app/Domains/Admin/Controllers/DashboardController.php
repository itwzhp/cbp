<?php
namespace App\Domains\Admin\Controllers;

use App\Helpers\ComponentsHelper;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render(ComponentsHelper::DASHBOARD);
    }

    public function settings(): Response
    {
        return Inertia::render(ComponentsHelper::DASHBOARD_SETTINGS);
    }
}
