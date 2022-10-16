<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    protected function sendResetResponse(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $response = Password::reset($input, function ($user, $password) {
            $user->update([
                'password' => Hash::make($password)
            ]);

            //$user->setRememberToken(Str::random(60));
            event(new PasswordReset($user));
        });
        
        if($response == Password::PASSWORD_RESET){
            $message = "Password reset successfully";
        }else{
            $message = "Email could not be sent to this email address";
        }
        
        $response = ['data'=>'','message' => $message];
        
        return response()->json($response);
    }
}
