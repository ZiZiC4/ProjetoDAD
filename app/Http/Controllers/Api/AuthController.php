<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && Auth::user()->blocked == 0) {
            return Auth::user();
        } else if (Auth::attempt($credentials) && Auth::user()->blocked == 1) {
            return response()->json(['message' => 'You have been blocked by a manager!'], 401);
        }else{
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();  //check if Auth::logout(); works
        return response()->json(['message' => 'User session closed'], 200);
    }
}
