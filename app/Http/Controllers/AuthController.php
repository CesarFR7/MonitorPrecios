<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function callback()
    {
        $userFacebook = Socialite::driver('facebook')->user();
        // $user = Socialite::driver('facebook')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $userFacebook->getEmail(),
            'provider' => 'Facebook',
        ], [
            'name' => $userFacebook->getName(),
            'password' => '',
            'provider_id' => $userFacebook->getId(),
            'avatar' => $userFacebook->getAvatar(),
            'nick_name' => $userFacebook->getNickname(),
        ]);

        auth()->login($user);

        return redirect()->to('/dashboard');
    }
}
