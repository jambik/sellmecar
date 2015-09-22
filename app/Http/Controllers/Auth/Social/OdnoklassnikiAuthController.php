<?php

namespace App\Http\Controllers\Auth\Social;

use App\User;
use Flash;
use Illuminate\Auth\Guard;
use Socialite;
use Illuminate\Routing\Controller;

class OdnoklassnikiAuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('odnoklassniki')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @param Guard $auth
     * @return Response
     */
    public function handleProviderCallback(Guard $auth)
    {
        $userData = Socialite::driver('odnoklassniki')->user();
        $userData->provider = "odnoklassniki";
        $userData->name = $userData->name ?: $userData->nickname;
        $userData->email = $userData->email ?: '';
        $userData->avatar = $userData->avatar ?: '';

        $user = User::findByUserNameOrCreate($userData);

        $auth->login($user, true);

        Flash::success("Выполнен вход через Одноклассники");

        return redirect('/');
    }
}
