<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserGroupController extends Controller
{
    public function getUserGroup()
    {
        $roles = Role::all()->pluck('name');
        return response($roles), 201);

    }

    public function saveUserGroups(Request $request)
    {
        $request->validate([]);
    }
}
