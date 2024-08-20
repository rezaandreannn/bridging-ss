<?php

namespace App\Http\Controllers\Fisio\MasterData;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Rules\UniqueInConnection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MasterDataFisioterapi;
use App\Rules\UniqueUpdateInConnection;

class DiagnosisMedisController extends Controller
{

    protected $view;
    // protected $routeIndex;
    protected $prefix;
    protected $mdFisio;
    protected $pasien;
   

    public function __construct(MasterDataFisioterapi $masterdatafisio)
    {

        $this->mdFisio = $masterdatafisio;
        $this->view = 'pages.fisioterapi.master_data.';
        // $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Master Data';
        $this->pasien = new Pasien;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $diagnosisMedis = $this->mdFisio->getDiagnosisMedis();

        // dd($diagnosisMedis);
        $title = $this->prefix . ' ' . 'Diagnosis Medis';
        return view($this->view . 'diagnosis_medis.index', compact('title', 'diagnosisMedis'));
        
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
        $validatedData = $request->validate([
            'nama_diagnosis_medis' => [
                'required', new UniqueInConnection('fis_master_diagnosis_medis', 'nama_diagnosis_medis', 'pku')
            ],
        ]);

        try {
            DB::connection('pku')->beginTransaction();

        $diagnosisMedis = DB::connection('pku')->table('fis_master_diagnosis_medis')->insert([
            'nama_diagnosis_medis' => $request->input('nama_diagnosis_medis'),
            'created_by' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
     
        ]);
        DB::connection('pku')->commit();

        return redirect()->route('diagnosisMedis.index')->with('success', 'Diagnosis Medis Berhasil Ditambahkan!');
    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        DB::connection('pku')->rollback();

        return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
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
        $validatedData = $request->validate([
            'nama_diagnosis_medis' => ['required', new UniqueUpdateInConnection('fis_master_diagnosis_medis', 'nama_diagnosis_medis', 'pku', $id)],
        ]);

        try {
            DB::connection('pku')->beginTransaction();

        $diagnosisMedis = DB::connection('pku')->table('fis_master_diagnosis_medis')->where('id',$id)->update([
            'nama_diagnosis_medis' => $request->input('nama_diagnosis_medis'),
            'created_by' => auth()->user()->id,
            'updated_at' => now(),
     
        ]);
        DB::connection('pku')->commit();

        return redirect()->route('diagnosisMedis.index')->with('success', 'Diagnosis Medis Berhasil Diedit!');
    } catch (\Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        DB::connection('pku')->rollback();

        return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    }

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
        $data = DB::connection('pku')->table('fis_master_diagnosis_medis')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
