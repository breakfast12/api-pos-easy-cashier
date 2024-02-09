<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        //Check if the user is authenticated.
        if (Auth::attempt($credentials)) {
            return new AuthResource(auth()->user());
        }

        return  response()->json([
            'status' => 'failed',
            'message' => 'Invalid Email or Password',
            'code' => 401
        ]);
    }

    public function logout()
    {
        //Check if the user is logged in first and revoke the token
        if (Auth::check()) {
            Auth::user()->tokens()->delete();
        }

        return  response()->json([
            'status' => 'success',
            'message' => 'User Successfully Logout',
            'code' => 200
        ]);
    }
}
