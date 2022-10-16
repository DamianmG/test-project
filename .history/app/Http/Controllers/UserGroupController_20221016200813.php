<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserGroupController extends Controller
{
    public function getAllUserGroups()
    {
        $roles = Role::all()->pluck('name');
        return response()->json(['user-groups' => $roles], 201);
    }

    public function getUserGroups()
    {
        $user = User::with('roles')->findOrFail(auth()->user()->id);
        
        $userRoles = $user->roles->pluck('name');

        return response()->json(['user-groups' => $userRoles], 201);
    }

    public function menageUserGroup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'action' => ['required', 'string', Rule::in(['save', 'delete'])],
        ]);

        $user = auth()->user();

        // assign or remove users role 
        if ($request->action == 'save') {
            $user->assignRole($request->name);
        } elseif ($request->action == 'delete') {
            $user->removeRole($request->name);
        }

        return response('Ok', 201);
    }
}
