<?php
namespace App\Domains\Users\Controllers;

use App\Domains\Users\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Microsoft\MicrosoftUser;

class MicrosoftLoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        /** @var MicrosoftUser $msUser */
        $msUser = Socialite::driver('microsoft')->user();

        $user = User::where('email', $msUser->email)->first();

        if ($user === null) {
            $this->register($msUser);
        }

        Auth::login($user);

        return redirect('/');
    }

    protected function register(MicrosoftUser $msUser)
    {

    }
}
