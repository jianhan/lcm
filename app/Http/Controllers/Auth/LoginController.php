<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\SocialAccounts;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback(SocialAccounts $accountService, $provider)
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
            $internalUser = $accountService->findOrCreate($user, $provider);
            $proxy = Request::create(
                '/oauth/token',
                'POST',
                [
                    'grant_type' => 'social',
                    'client_id' => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRET'),
                    'network' => $provider,
                    'access_token' => $user->token,
                ]
            );
            $queryString = http_build_query(json_decode(app()->handle($proxy)->getContent()));
            return redirect()->away(env('F_CALLBACK_URL') . '?' . $queryString);
        } catch (\Exception $e) {
            //TODO: send error back
            dd($e->getMessage());
        }

    }
}

