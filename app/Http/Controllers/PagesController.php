<?php
namespace App\Http\Controllers;

use Inertia\Inertia;

class PagesController extends Controller
{
    public function about()
    {
        return Inertia::render('About');
    }

    public function czrPage()
    {
        return Inertia::render('CzrPage');
    }

    public function czrPage1()
    {
        return Inertia::render('CzrPage1');
    }
}
