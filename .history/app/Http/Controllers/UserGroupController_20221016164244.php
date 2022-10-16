<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserGroupController extends Controller
{
    public function getUserGroup()
    {
        $roles = Role::all()->pluck('name');
        return response()->json(['user-groups' => $roles], 201);
    }

    public function menageUserGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'action' => ['required', 'string', Rule::in(['save', 'delete'])],
        ]);

        $user = auth()->user();

        if ($request->action == '') {
            # code...
        }
        $user->removeRole($request->name);
    }
}
