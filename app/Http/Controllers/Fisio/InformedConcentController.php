<?php

namespace App\Http\Controllers\Fisio;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use App\Models\BerkasFisioterapi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InformedConcentController extends Controller
{
    protected $view;
    protected $prefix;
    protected $fisio;
    protected $berkasFisio;
    protected $pasien;
    protected $rajal;

    public function __construct(Fisioterapi $fisio)
    {
        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.informed_concent.';
        $this->prefix = 'Informed Concent Fisioterapi';
        $this->berkasFisio = new BerkasFisioterapi();
        $this->pasien = new Pasien();
        $this->rajal = new Rajal();
    }

    public function index()
    {
        //
        $listpasien = $this->fisio->pasienCpptdanFisioterapi();
     

        $fisioModel= new Fisioterapi();
       
        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'index', compact('title', 'listpasien','fisioModel'));
    }

    public function create_rujukan()
    {
        //
        $title = 'Surat Rujukan Fisioterapi Index';
        // $biodata = $this->rajal->resumeMedisPasienByMR($noMR);
        return view('pages.fisioterapi.surat_rujukan.add', compact('title'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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

        $informed_concent = DB::connection('pku')->table('INFORMED_CONCENT_FISIOTERAPI')->insert([
            'KODE_REGISTER' => $request->input('KODE_REGISTER'),
            'CREATE_AT' => date('Y-m-d'),
            'CREATE_BY' => auth()->user()->id,
            'IDENTIFIKASI' => $request->input('IDENTIFIKASI'),
            'RUANGAN' => $request->input('RUANGAN'),
            'JAM' => date('G:i:s')
        ]);

        if($informed_concent){
            return redirect()->route('informed_concent.index')->with('success', 'Informed Concent Berhasil Ditambahkan!');
            
        }else {
            return redirect()->route('informed_concent.index')->with('danger', 'Informed Concent Gagal Ditambahkan!');

        }

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
