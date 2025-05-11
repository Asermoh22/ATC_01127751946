<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Response;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthApicontroller extends Controller
{
     public function register(Request $request)
    {
        $validated = $request->validate([
            'name'=>'required | string',
            'email'=> 'required| email |unique:users',
            'password'=> 'required | string |min:8',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),

        ]);

            $token = $user->createToken('auth_token')->plainTextToken;


        return response()->json([
            'message' => 'User registered successfully!',
             'access_token' => $token,

            'user' => $user
        ], 201);
    }


    public function login(Request $request){

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;
    
        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token
        ]);
    }

    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'User logged out successfully']);
    }
}
