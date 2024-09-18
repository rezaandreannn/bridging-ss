<?php

namespace App\Http\Controllers\profileUser;

use App\Models\User;
use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileUserController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $profileUser;

    public function __construct(ProfileUser $profileUser)
    {
        $this->profileUser = $profileUser;
        $this->view = 'profile.';

    }

    public function index()
    {
        // dd('ok');
        //
        $title = 'Profile User';
        // dd($pasiens);
        $biodata = $this->profileUser->getBiodataUser(auth()->user()->id);
        // return redirect('dashboard');
        // dd($biodata);
        return view($this->view . 'biodata.index', compact('title','biodata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showEditPassword()
    {
        $title = 'Edit Password User';
        // dd($pasiens);
        // $biodata = $this->profileUser->getBiodataUser(auth()->user()->id);
        // return redirect('dashboard');
        // dd($biodata);
        return view($this->view . 'password.index', compact('title'));
        //
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);
        
        $user = Auth::user();


        // Check if the current password is correct
        if (!Hash::check($request->input('password_lama'), $user->password)) {
            throw ValidationException::withMessages([
                'password_lama' => ['Password lama tidak cocok.'],
            ]);
        }

        // alert('ok');

        // Update the password
        $updateUser = User::where('id', $user->id)->first();

        $user_data = [
            // 'name' => $request->name,
            'password' => Hash::make($request->input('password_baru')),
         
        ];
        $updateUser->update($user_data);
        // dd($updateUser);
        // $user->password = Hash::make($request->input('password_baru'));
        // $user->save();

        return redirect()->route('biodata.index')->with('success', 'Password telah dirubah!');
    }


    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
