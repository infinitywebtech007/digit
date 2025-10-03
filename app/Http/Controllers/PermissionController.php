<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $permissions = Permission::all();

        return view('permissions.manage', compact('users', 'roles', 'permissions'));
    }

    public function assignToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permissions' => 'array',
        ]);

        $user = User::find($request->user_id);
        $user->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Permissions updated for user.');
    }

    public function assignToRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permissions' => 'array',
        ]);

        $role = Role::find($request->role_id);
        $role->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Permissions updated for role.');
    }

    public function getUserPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = Permission::all();
        $userPermissions = $user->getPermissionNames()->toArray();

        return response()->json([
            'permissions' => $permissions,
            'userPermissions' => $userPermissions,
        ]);
    }

    public function getUserRoles($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all();
        $userRoles = $user->getRoleNames()->toArray();

        return response()->json([
            'roles' => $roles,
            'userRoles' => $userRoles,
        ]);
    }

    public function assignRoleToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string',
            'assign' => 'required|boolean',
        ]);

        $user = User::find($request->user_id);
        if ($request->assign) {
            $user->assignRole($request->role);
            return response()->json(['message' => 'Role assigned successfully']);
        } else {
            $user->removeRole($request->role);
            return response()->json(['message' => 'Role removed successfully']);
        }
    }

    public function getRolePermissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        $rolePermissions = $role->getPermissionNames()->toArray();

        return response()->json([
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    public function assignPermissionToRole(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission' => 'required|string',
            'assign' => 'required|boolean',
        ]);

        $role = Role::find($request->role_id);
        if ($request->assign) {
            $role->givePermissionTo($request->permission);
            return response()->json(['message' => 'Permission assigned successfully']);
        } else {
            $role->revokePermissionTo($request->permission);
            return response()->json(['message' => 'Permission removed successfully']);
        }
    }

    public function assignPermissionToUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'permission' => 'required|string',
            'assign' => 'required|boolean',
        ]);

        $user = User::find($request->user_id);
        if ($request->assign) {
            $user->givePermissionTo($request->permission);
            return response()->json(['message' => 'Permission assigned successfully']);
        } else {
            $user->revokePermissionTo($request->permission);
            return response()->json(['message' => 'Permission removed successfully']);
        }
    }
}
