<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SocialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('vkontakte')->user();
        $obj = new SocialService();
        if($user = $obj->saveSocialData($user)){
            auth("web")->login($user);
            return redirect()->route('home');
        }
        return back(404);
    }
}
