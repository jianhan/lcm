<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('github')->stateless()->user();
        $proxy = Request::create(
            '/oauth/token',
            'POST',
            [
                'grant_type' => 'social',
                'client_id' => 1,
                'client_secret' => 'xX14HdVtfugAhERXUoYdGyclhMcseUvXqxhg3ct7',
                'network' => 'github',
                'access_token' => $user->token,
            ]
        );
        return app()->handle($proxy);
    }
}