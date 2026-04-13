<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private $availableProviders = [
        'facebook',
        'google',
        'x',
        'linkedin-openid',
        'github'
    ];

    public function redirect($provider)
    {
        if (in_array($provider, $this->availableProviders)) {
            return Socialite::driver($provider)->redirect();
        }
        return redirect()->to('login');
    }


    public function callback($provider)
    {
        if (in_array($provider, $this->availableProviders)) {
            $userProvider = Socialite::driver($provider)->stateless()->user();

            $user = User::updateOrCreate([
                'provider_id' => $userProvider->getId(),
            ], [
                'name' => $userProvider->getName() ? $userProvider->getName() : $userProvider->getNickname(),
                'email' => $userProvider->getEmail() ? $userProvider->getEmail() : '',
                'password' => Hash::make(Str::password(12)),
                'provider' => $provider,
                'provider_id' => $userProvider->getId(),
                'avatar' => $userProvider->getAvatar(),
                'nick_name' => $userProvider->getNickname(),
            ]);


            auth()->login($user);

            return redirect()->to('/dashboard');
        }
        return redirect()->to('login');
    }
}
