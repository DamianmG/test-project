<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserGroupController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $user = Auth::user()->with('roles');
        dd($user);
    }

    public function saveUserGroups(Request $request)
    {
        $request->validate([]);
    }
}
