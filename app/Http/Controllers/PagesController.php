<?php
namespace App\Http\Controllers;

use Inertia\Inertia;

class PagesController extends Controller
{
    public function welcome()
    {
        return Inertia::render('Welcome');
    }

    public function about()
    {
        return Inertia::render('About');
    }
}
