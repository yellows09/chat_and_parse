<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid login credentials']);
        }
        $token = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => Auth::user(),'access_token' => $token]);
    }
}
