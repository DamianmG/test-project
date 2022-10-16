<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
    
            // send email verification
            $user->sendEmailVerificationNotification();
            
            // assign role
            $user->assignRole('default');
            
            return response($user, 201);
        } catch (\Throwable $th) {
            return response($th, 500);
        }
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // Check password
        if(!Auth::attempt($request->only(['email', 'password']))) {
            return response(['message' => 'Bad credentials'], 401);
        }

        $token = Auth::user()->createToken('apptoken', ['products'])->plainTextToken;

        $response = [
            'user' => Auth::user(),
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout() {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}