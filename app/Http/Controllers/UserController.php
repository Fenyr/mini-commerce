<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request["name"],
            'email' => $request["email"],
            'password' => bcrypt($request["password"])
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        dispatch(new SendEmailJob($user->email,"Mini Marketplace - Reigistration","You Successfully Registered"));


        return response()->json(['token' => $token], 200);
    }
    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->toArray())) {
            $token = $request->user()->createToken("auth_token");
            dispatch(new SendEmailJob($request->email,"Mini Marketplace - Login","Login Activity Detected"));
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
