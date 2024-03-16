<?php

namespace App\Http\Controllers\Manage;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.manage.role.';
        $this->routeIndex = 'roles.index';
        $this->prefix = 'Role';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        $roles = Role::with('permissions')->get();
        return view($this->view . 'index', compact('title', 'roles'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $roles = Role::select('name', 'guard_name')->get();
        return view($this->view . 'create', compact('title', 'roles'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:' . Role::class],
            'guard_name' => ['required', 'string'],
        ]);

        // Simpan data pengguna
        $role = Role::create([
            'name' => $validatedData['name'],
            'guard_name' => $validatedData['guard_name'],
        ]);

        $message = 'Data has been Add successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }

    public function edit($id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $role = Role::where('id', $id)->first();
        $roles = Role::select('name', 'guard_name')->get();
        return view($this->view . 'edit', compact('title', 'role', 'roles'));
    }

    public function update($id, Request $request)
    {
        $roles = Role::where('id', $id)->first();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'guard_name' => ['required', 'string', 'max:100'],
        ]);
        try {
            $roles = Role::findorfail($id);
            $data = [
                'name' => Request()->name,
                'guard_name' => Request()->guard_name,
            ];
            $roles->update($data);

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroy($id)
    {
        $role = Role::findorfail($id);
        $role->delete();

        $message = 'Data has been deleted successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }
}
