<?php
namespace App\Domains\Users\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftLoginController extends Controller
{
    public function __invoke()
    {
        return Socialite::driver('microsoft')->redirect();
    }
}
