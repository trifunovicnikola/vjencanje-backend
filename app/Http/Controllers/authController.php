<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cookie;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        $user->username =$request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->ime= $request->input('ime');
        $user->prezime = $request->input('prezime');
        $user->role = 2;
        $user->save();
        return $user;

    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('username','password')))
        {

            return response([
                'message'=>'Invalid credentials'
            ],Response::HTTP_UNAUTHORIZED);
        }
        $user= Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*24);
        return response([
            'message'=>$token
        ])->withCookie($cookie);
    }

    public function user()
    {
        return Auth::user();
    }

    public  function logout()
    {
        $cookie = Cookie::forget('jwt');
        return response([
            "message"=> "Succeess"
        ])->withCookie($cookie);
    }
}
