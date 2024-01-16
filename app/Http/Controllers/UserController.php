<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->request->validate([
            'name' => "required",
            'email' => "required",
            'password' => "required",
        ]);

        User::create($request);

        $token = $request->user()->createToken($request->token_name);

        return response()->json(['token' => $token->plainTextToken], 200);
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken($request->token_name);
            return response()->json(['token' => $token->plainTextToken], 200);
        }

        return response()->json("email or password Incorect", 400);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json("Successfully Logout", 200);
    }
}
