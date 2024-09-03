<?php

namespace App\Http\Controllers\Farmasi;

use App\Models\Farmasi;
use Illuminate\Http\Request;
use App\Rules\UniqueInConnection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MasterDataAlkesController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $pasien;
    protected $rajal;
    protected $ranap;
    protected $farmasi;

    public function __construct(Farmasi $farmasi)
    {
        $this->farmasi = $farmasi;
        $this->view = 'pages.farmasi.';
        $this->prefix = 'Farmasi';
     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
                //
         $title = $this->prefix . ' ' . 'Master Data Alat Kesehatan';
         $masterAlkes = $this->farmasi->getMasterAlkes();
        //  dd($masterAlkes);
        return view($this->view . 'master_data_alkes.index', compact('title','masterAlkes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('ok');
        //
        $validatedData = $request->validate([
            'nama_alat' => ['required', new UniqueInConnection('fis_master_data_alkes', 'nama_alat', 'pku')],
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            $masterAlkes = DB::connection('pku')->table('fis_master_data_alkes')->insert([
                'nama_alat' => $request->input('nama_alat'),
                'created_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),

            ]);
            DB::connection('pku')->commit();

            return redirect()->back()->with('success', 'Diagnosis Fungsi Berhasil Ditambahkan!');
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
        $data = DB::connection('pku')->table('fis_master_data_alkes')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
