<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Exception;
use GuzzleHttp\Client;
use Laravel\Passport\Client as OClient; 

class APIUserController extends Controller
{
    public function login(Request $request) { 
        $loginData = $request->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);
        if(!auth()->attempt($loginData)) {
            return response(['message' => 'THẤT BẠI']);
        }

        $accessToken = Auth::user()->createToken('login')->accessToken;

        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }

    public function register(Request $request) { 
        $registerData = $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|confirmed'
        ]);

        // $user = User::create($registerData);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Register success!',
            'user' => $user,
            'access_token' => $accessToken
        ]);
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
    
        $response = 'You have been succesfully logged out!';
        return response($response, 200);
    }
    
    public function currentUser() {
        return Auth::user();


        // auth('api')->logout();

        // return response()->json(['message' => 'Successfully logged out']);
    }

}
