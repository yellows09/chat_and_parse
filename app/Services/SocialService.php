<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SocialService
{
    public function saveSocialData($user)
    {
        $email = $user->getEmail();
        $name = $user->getName();
        $password = Hash::make(123);

        $data = ['email' => $email, 'name' => $name, 'password' => $password];
        $u = User::where('email','=', $email)->first();

        if ($u) {
//            dd(123);
            Auth::login($u);
            return redirect('home');
        }
        return User::create($data);
    }
}
