<?php

namespace App\Http\Controllers\RawatInap\Cppt;

use App\Models\Cppt;
use App\Models\Rajal;
use Illuminate\Http\Request;
use App\Models\Ranap\CpptModel;
use App\Http\Controllers\Controller;

class CpptController extends Controller
{

    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $rajal;
    protected $cppt;

    protected $cpptmodel;

    public function __construct(CpptModel $cpptmodel)
    {
        $this->cpptmodel = $cpptmodel;
        $this->view = 'pages.ranap.cppt.';
        $this->prefix = 'Rawat Inap';
        $this->rajal = new Rajal();
        $this->cppt = new Cppt();
      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = $this->prefix . ' ' . 'Cppt';
        $pasienCppt = $this->cpptmodel->pasienCppt();

        

        return view($this->view . 'index', compact('title','pasienCppt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cari_process(Request $request)
    {
 
        return redirect()->route('cppt.addCppt', ['noReg' => $request->input('noReg')]);

    }

    public function create($noReg)
    {
        // dd('ok');
     
        $biodata = $this->rajal->pasien_bynoreg($noReg);
        $asesmenMedisRanapByNoreg = $this->cppt->getAsesmenMedisRanapByNoreg($noReg);
        $getCpptByNoreg = $this->cppt->getCpptByNoreg($noReg);
        // dd($getCpptByNoreg);
        $title = $this->prefix . ' ' . 'Cppt tambah data';

        return view($this->view . 'createCppt', compact('title','biodata','asesmenMedisRanapByNoreg','getCpptByNoreg'));

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
