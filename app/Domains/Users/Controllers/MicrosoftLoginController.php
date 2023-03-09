<?php
namespace App\Domains\Users\Controllers;

use App\Domains\Users\Events\UserLoggedInViaSocialiteEvent;
use App\Domains\Users\Exceptions\UnauthorizedException;
use App\Domains\Users\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
        $msUser = Socialite::driver('microsoft')->stateless()->user();

        $this->validateUser($msUser);

        $user = User::where('email', $msUser->email)->first();

        if ($user === null) {
            $user = $this->register($msUser);
        }

        Auth::login($user);
        request()->session()->regenerate();

        event(new UserLoggedInViaSocialiteEvent($user));

        return redirect('/');
    }

    protected function register(MicrosoftUser $msUser)
    {
        return User::factory()->create([
            'name'  => $msUser->name,
            'email' => $msUser->email,
        ]);
    }

    protected function validateUser(MicrosoftUser $msUser): void
    {
        if (!Str::endsWith($msUser->email, config('cbp.domains'))) {
            throw new UnauthorizedException('Login spoza domen ZHP');
        }
    }
}
