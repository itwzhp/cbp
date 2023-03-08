<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{
    public function __invoke()
    {
        flash(fake()->sentence(), 'success');

        return redirect('/');
    }

    public function clearCache()
    {
        Cache::clear();

        return back();
    }
}
