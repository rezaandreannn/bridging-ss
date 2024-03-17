<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.manage.permission.';
        $this->routeIndex = 'permission.index';
        $this->prefix = 'Permission';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        $permission = Permission::all();
        return view($this->view . 'index', compact('title', 'permission'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $permission = Permission::select('name', 'guard_name')->get();
        return view($this->view . 'create', compact('title', 'permission'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => ['required', 'max:250'],
            'guard_name' => ['required', 'string'],
        ]);

        // Simpan data pengguna
        Permission::create([
            'name' => $validatedData['name'],
            'guard_name' => $validatedData['guard_name'],
        ]);

        $message = 'Data has been Add successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }

    public function edit($id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $permission = Permission::where('id', $id)->first();
        $permissions = Permission::select('name', 'guard_name')->get();
        return view($this->view . 'edit', compact('title', 'permission', 'permissions'));
    }

    public function update($id, Request $request)
    {
        $permission = Permission::where('id', $id)->first();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'guard_name' => ['required', 'string', 'max:100'],
        ]);
        try {
            $permission = Permission::findorfail($id);
            $data = [
                'name' => Request()->name,
                'guard_name' => Request()->guard_name,
            ];
            $permission->update($data);

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroy($id)
    {
        $role = Permission::findorfail($id);
        $role->delete();

        $message = 'Data has been deleted successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }
}
