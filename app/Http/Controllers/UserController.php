<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index()
{
    try {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Users retrieved successfully.',
            'data' => $users
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'There was an error retrieving the users.'
        ], 500);
    }
}


public function show($user)
{
    try {
        $user = User::find($user);
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'User retrieved successfully.',
                'data' => $user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not found.'
            ], 404);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'There was an error retrieving the user.'
        ], 500);
    }
}


    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed'
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'User register successfully.',
                'data' => $user
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        // Comprueba si el usuario está activado
        if (!$request->user()->actived) {
            return response()->json([
                'success' => false,
                'message' => 'User account is not activated'
            ], 403);
        }
    
        // Comprueba si el correo electrónico del usuario está confirmado
        if ($request->user()->email_confirmed == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Email not confirmed'
            ], 403);
        }
    
        $token = $request->user()->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'success' => true,
            'message' => 'User login successfully.',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $request->user()
            ]
        ]);
    }
    
}
