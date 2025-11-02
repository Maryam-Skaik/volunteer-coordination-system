<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\HasApiTokens;

class AuthController extends Controller
{
    
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            $json = [
                'status' => [
                    'status' => true,
                    'message' => '',
                    'http-code' => 200
                ],
                'data' => ['token' => $user->createToken('volunteer-platform')->accessToken]
            ];

            return response()->json($json);
        }else{
            $json = [
                'status' => [
                    'status' => false,
                    'message' => 'Username or password is wrong',
                    'http-code' => 401
                ],
                'data' => null
            ];

            return response()->json($json);
        }
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();

        return response()->json([
            'status' => [
                'status' => true,
                'message' => 'Logged out successfully',
                'http_code' => 200
            ],
            'data' => null
        ]);
    }
}
