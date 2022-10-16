<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserGroupController extends Controller
{
    public function getRoles()
    {
        $roles = Role::all();
        return response($roles, 201);

    }

    public function saveUserGroups(Request $request)
    {
        $request->validate([]);
    }
}
