<?php

namespace App\Http\Controllers\profileUser;

use App\Models\ProfileUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $this->view = 'profile.biodata.';

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
        return view($this->view . 'index', compact('title','biodata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
