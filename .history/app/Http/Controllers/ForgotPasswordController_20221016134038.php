<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        Password::sendResetLink(['email' => $request->email]);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }
}
