<?php

namespace App\Auth;

use Adaojunior\Passport\SocialGrantException;
use Adaojunior\Passport\SocialUserResolverInterface;
use App\User;
use Socialite;

class SocialUserResolver implements SocialUserResolverInterface
{
    public function resolve($network, $token, $accessTokenSecret = null)
    {
        switch ($network) {
            case 'github':
                return $this->github($token);
                break;
            default:
                throw SocialGrantException::invalidNetwork();
                break;
        }
    }

    public function github(string $token)
    {
        $user = Socialite::driver('github')->userFromToken($token);
        return $this->findOrCreate($user);
    }

    protected function findOrCreate($user): User
    {
        /** @var User $model */
        return User::query()->firstOrCreate(['email' => $user->email], [
            'name' => $user->name,
            'password' => bcrypt(str_random(64)),
        ]);
    }
}