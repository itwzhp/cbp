<?php
namespace App\Http\Controllers;

class TestController extends Controller
{
    public function __invoke()
    {
        flash(fake()->sentence(), 'success');

        return redirect('/');
    }
}
