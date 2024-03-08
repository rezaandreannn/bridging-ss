<?php

namespace App\Http\Controllers\Manage;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        $users = User::all();
        return view($this->view . 'index', compact('title', 'users'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $users = User::select('name', 'email','password')->get();
        return view($this->view . 'create', compact('title', 'users'));
    }

    public function store(Request $request)
    {
        $title = 'Index' . ' ' . $this->prefix;
        // Validasi input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        try {
            // Simpan data pengguna
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $message = 'Data has been Add successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan pengguna.');
        }
    }

    public function edit($id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $user = User::where('id', $id)->first();
        $users = User::select('name', 'email', 'password')->get();
        return view($this->view . 'edit', compact('title', 'user', 'users'));
    }

    public function update($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
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

            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }


}
