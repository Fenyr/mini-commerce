<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(UserRequest $request)
    {

        $user = User::create([
            'name' => $request["name"],
            'email' => $request["email"],
            'password' => bcrypt($request["password"])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
    public function login(UserRequest $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken("auth_token");
            return response()->json(['token' => $token->plainTextToken], 200);
        }

        return response()->json("email or password Incorect", 401);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json("Successfully Logout", 200);
    }
}
