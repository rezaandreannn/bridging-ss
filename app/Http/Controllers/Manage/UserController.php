<?php

namespace App\Http\Controllers\Manage;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.manage.user.';
        $this->routeIndex = 'user.index';
        $this->prefix = 'User';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::with('roles')->get();
        return view($this->view . 'index', compact('title', 'users', 'roles', 'permissions'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::select('name', 'email', 'password')->get();
        return view($this->view . 'create', compact('title', 'users', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:' . User::class],
            'image' => ['image', 'file', 'max:2048'],
            'password' => ['required', 'confirmed'],
            'permissions' => ['array'],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/images');

            // Ambil nama file
            $imageName = basename($imagePath);

            // Update field gambar pada user
            $user->image = $imageName;
            $user->save();
        } elseif (!$user->image) {
            // Jika pengguna tidak mengunggah gambar baru dan tidak ada gambar sebelumnya, gunakan gambar default
            $user->image = 'public/img/avatar-1.png';
            $user->save();
        }

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        if ($request->permissions) {
            foreach ($request->permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }
        $message = 'Data has been Add successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }

    public function edit($id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::select('name', 'email', 'password')->get();
        return view($this->view . 'edit', compact('title', 'user', 'users', 'roles', 'permissions'));
    }

    public function update($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'permissions' => ['array'],
        ]);
        try {
            // send API 
            // $data = $this->organization->patchRequest($url, $body);

            // Send DB
            if ($request->input('password')) {
                $user_data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ];
            } else {
                $user_data = [
                    'name' => $request->name,
                    'email' => $request->email,
                ];
            }
            $user->update($user_data);

            if ($request->roles) {
                $user->syncRoles($request->roles);
            }

            if ($request->permissions) {
                // Konversi input izin menjadi array jika diperlukan
                $permissions = (array) $request->permissions;

                // Berikan izin baru kepada pengguna jika belum dimiliki
                foreach ($permissions as $permission) {
                    if (!$user->hasPermissionTo($permission)) {
                        $user->givePermissionTo($permission);
                    }
                }

                // Sinkronisasi izin pengguna dengan izin yang diminta
                $user->syncPermissions($permissions);
            }

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroy($id)
    {
        $user = User::findorfail($id);
        $user->delete();

        $message = 'Data has been deleted successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }
}
