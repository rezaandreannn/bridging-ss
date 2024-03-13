<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.manage.role-permission.';
        $this->routeIndex = 'role.index';
        $this->prefix = 'Role Permission';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        $roles = Role::all();
        return view($this->view . 'index', compact('title', 'roles'));
    }

    public function getPermission($id = null)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions;
        $title = 'All Permission By Role ' .  ucwords($role->name);
        return view($this->view . 'get-permission', compact('title', 'role', 'permissions', 'rolePermissions'));
    }

    public function hasPermission(Request $request)
    {
        $roleId = $request->input('roleId');
        $permissionId = $request->input('permissionId');
        $action = $request->input('action');

        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $role->givePermissionTo($permission);

        if ($action == 'insert') {
            $role->givePermissionTo($permission);
            $message = 'Created permission succesfully';
        } else {
            $role->revokePermissionTo($permission);
            $message = 'Remove permission succesfully';
        }
        return response()->json(['toast_success' => $message]);
    }
}
