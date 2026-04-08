<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function callback()
    {
        $userFacebook = Socialite::driver('facebook')->user();

        $user = User::updateOrCreate([
            'email' => $userFacebook->getEmail(),
        ], [
            'name' => $userFacebook->getName(),
            'password' => Hash::make(Str::password(12)),
            'provider_id' => $userFacebook->getId(),
            'avatar' => $userFacebook->getAvatar(),
            'nick_name' => $userFacebook->getNickname(),
        ]);

        // dd($user);

        $provedor = $user->providers()->firstOrCreate(
            [
                'email' => $userFacebook->getEmail(),
                'provider' => 'Facebook',
            ],
            [
                'name' => $userFacebook->getName(),
                'provider_id' => $userFacebook->getId(),
                'avatar' => $userFacebook->getAvatar(),
                'nick_name' => $userFacebook->getNickname(),
            ]
        );

        auth()->login($user);

        return redirect()->to('/dashboard');
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $userGoogle = Socialite::driver('google')->stateless()->user();

        $user = User::updateOrCreate([
            'email' => $userGoogle->getEmail(),
        ], [
            'name' => $userGoogle->getName(),
            'password' => Hash::make(Str::password(12)),
            'provider_id' => $userGoogle->getId(),
            'avatar' => $userGoogle->getAvatar(),
            'nick_name' => $userGoogle->getNickname(),
        ]);

        $provedor = $user->providers()->firstOrCreate(
            [
                'email' => $userGoogle->getEmail(),
                'provider' => 'google',
            ],
            [
                'name' => $userGoogle->getName(),
                'provider_id' => $userGoogle->getId(),
                'avatar' => $userGoogle->getAvatar(),
                'nick_name' => $userGoogle->getNickname(),
            ]
        );

        auth()->login($user);

        return redirect()->to('/dashboard');
    }

    public function x_redirect()
    {
        return Socialite::driver('x')->redirect();
    }


    public function x_callback()
    {
        $userX = Socialite::driver('x')->stateless()->user();

        $user = User::updateOrCreate([
            'email' => $userX->getEmail(),
        ], [
            'name' => $userX->getName(),
            'password' => Hash::make(Str::password(12)),
            'provider_id' => $userX->getId(),
            'avatar' => $userX->getAvatar(),
            'nick_name' => $userX->getNickname(),
        ]);

        $provedor = $user->providers()->firstOrCreate(
            [
                'email' => $userX->getEmail(),
                'provider' => 'google',
            ],
            [
                'name' => $userX->getName(),
                'provider_id' => $userX->getId(),
                'avatar' => $userX->getAvatar(),
                'nick_name' => $userX->getNickname(),
            ]
        );

        auth()->login($user);

        return redirect()->to('/dashboard');
    }
}
