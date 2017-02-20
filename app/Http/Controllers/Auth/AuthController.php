<?php
/**
 * Created by PhpStorm.
 * User: tjf
 * Date: 2017/2/6
 * Time: 17:35
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;
use Response;
use Socialite;

class AuthController extends Controller
{

    protected $redirectTo = '/home';

    /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        $username = $user->nickname;
        if (!$username) $username = $user->name;
        if (!$username) $username = '未知用户' + $user->email + $user->id;
        $tryUser = User::where('name', $username)->first();
        if ($tryUser) {
            $tryUser->provider = $provider;
            $tryUser->provider_id = $user->id;
            return $tryUser;
        }
        return User::create([
            'name' => $username,
            'email' => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id,
            'avatar' => $user->avatar
        ]);
    }

    public function duoshuoin()
    {
        $code = Input::get('code');
    }

    public function duoshuout()
    {

    }

}