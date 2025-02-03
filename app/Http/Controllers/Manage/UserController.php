<?php

namespace App\Http\Controllers\Manage;

use Exception;
use Rules\Password;
use App\Models\User;
use App\Models\UserBangsal;
use Illuminate\Http\Request;
use App\Models\MasterData\Bangsal;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

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
        $users = User::with(['roles','userbangsal'])->get();
        // dd($users);
        return view($this->view . 'index', compact('title', 'users', 'roles', 'permissions'));
    }

    public function create()
    {
        $title = 'Create' . ' ' . $this->prefix;
        $roles = Role::all();
        $permissions = Permission::all();
        $bangsals = Bangsal::all();
        // dd($bangsals);
        $users = User::select('name', 'email', 'password')->get();
        return view($this->view . 'create', compact('title', 'users', 'roles', 'permissions','bangsals'));
    }

    public function store(Request $request)
    {

        try{

            DB::beginTransaction();
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:' . User::class],
            'image' => ['image', 'file', 'max:2048'],
            'password' => ['required', 'confirmed'],
            'permissions' => ['array'],
            'username' => ['required', 'unique:' . User::class],
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
         
        ]);

        if($request->username){
            $user->username=$request->username;
            $user->save();
        }

        if($request->bangsals){
            $bangsal = UserBangsal::create([
                'user_id' => $user->id,
                'kode_bangsal' => $request->bangsals,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),

            ]);
        }


        if ($request->file('image')) {
            $imagePath = $request->file('image')->store('public/images');

            // Ambil nama file
            $imageName = basename($imagePath);

            // Update field gambar pada user
            $user->image = $imageName;
            $user->save();
        } elseif ($user->image) {
            // Jika pengguna tidak mengunggah gambar baru dan tidak ada gambar sebelumnya, gunakan gambar default
            $user->image = asset('img/avatar/avatar-1.png');
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
        DB::commit();
        
        $message = 'Data user berhasil ditambahkan.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
        
    } catch (Exception $e) {
        // Redirect dengan pesan error jika terjadi kegagalan
        DB::rollBack();
        $message = 'Data user gagal ditambahkan.';
        return redirect()->route($this->routeIndex)->with('toast_error', $message . $e->getMessage());
    }
    }

    public function edit($id)
    {
        $title = 'Edit' . ' ' . $this->prefix;
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        $permissions = Permission::all();
        $bangsalById = UserBangsal::where('user_id', $user->id)->first();
        // dd($bangsalById);
        $bangsals = Bangsal::all();
        $users = User::select('name', 'email', 'password')->get();
        return view($this->view . 'edit', compact('title', 'user', 'users', 'roles', 'permissions','bangsals','bangsalById'));
    }

    public function update($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100'],
            'image' => ['image', 'file', 'max:2048'],
            'permissions' => ['array'],
            'username' => ['required'],
        ]);
        try {
          
            DB::beginTransaction();

            // Send DB
            if ($request->input('password')) {
                $user_data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
               
                ];
            } else {
                $user_data = [
                    'name' => $request->name,
                    'email' => $request->email,
                 
                ];
            }
            //Update Data
            $user->update($user_data);

            if($request->username){
                $user->username=$request->username;
                $user->save();
            }

            // update kode_bangsal
            $bangsalById = UserBangsal::where('user_id', $user->id)->first();
            // dd($request->roles);
           
            if ($request->roles == 'perawat bangsal'){
             
                if($bangsalById){
                
                    $bangsal = [
                        'user_id' => $user->id,
                        'kode_bangsal' => $request->bangsals,
                        'updated_at' => date('Y-m-d H:i:s'),
        
                    ];
                    $bangsalById->update($bangsal);

                    // jika tidak ada tambah
                }else {
                   
                    $bangsal = UserBangsal::create([
                        'user_id' => $user->id,
                        'kode_bangsal' => $request->bangsals,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
        
                    ]);
                }
               
            }
            else{
               
                if($bangsalById){
                    $bangsalById->delete();
                }
           
            }

            //Upload Image
            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete('public/images/' . $request->oldImage);
                }
                $imagePath = $request->file('image')->store('public/images');

                // Ambil nama file
                $imageName = basename($imagePath);

                // Update field gambar pada user
                $user->image = $imageName;
                $user->save();
            }

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

            DB::commit();
            $message = 'Data has been updated successfully.';
            return redirect()->route($this->routeIndex)->with('toast_success', $message);
        } catch (\Throwable $e) {
            DB::rollBack();
            $message = 'Data user gagal ditambahkan.';
            return redirect()->route($this->routeIndex)->with('toast_error', $message . $e->getMessage());
        }
    }

    public function destroy(User $user, $id)
    {
        $user = User::findorfail($id);
        if ($user->image) {
            Storage::delete('public/images/' . $user->image);
        }
        $user->delete();
        $message = 'Data has been deleted successfully.';
        return redirect()->route($this->routeIndex)->with('toast_success', $message);
    }
}
