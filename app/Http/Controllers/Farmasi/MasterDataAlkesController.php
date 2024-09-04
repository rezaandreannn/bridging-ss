<?php

namespace App\Http\Controllers\Farmasi;

use App\Models\Farmasi;
use Illuminate\Http\Request;
use App\Rules\UniqueInConnection;
use App\Rules\UniqueUpdateInConnection;
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
         $masterHargaAlkes = $this->farmasi->getMasterHargaAlkes();
        //  dd($masterHargaAlkes);
        return view($this->view . 'master_data_alkes.index', compact('title','masterAlkes','masterHargaAlkes'));
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

            return redirect()->back()->with('success', 'Master alat kesehatan Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function store_harga(Request $request)
    {
        // dd('ok');
        //
        $validatedData = $request->validate([
            'id_alkes' => 'required',
            'harga' => 'required',
            'ukuran' => 'required',
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            $masterAlkes = DB::connection('pku')->table('fis_harga_alkes')->insert([
                'id_alkes' => $request->input('id_alkes'),
                'harga' => $request->input('harga'),
                'ukuran' => $request->input('ukuran'),
                'created_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),
                
            ]);
            DB::connection('pku')->commit();
            
            return redirect()->back()->with('success', 'Master Harga alat kesehatan Berhasil Ditambahkan!');
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
            'nama_alat' => ['required', new UniqueUpdateInConnection('fis_master_data_alkes', 'nama_alat', 'pku', $id)],
        ]);
        
        try {
            DB::connection('pku')->beginTransaction();
            
            $diagnosisfungsi = DB::connection('pku')->table('fis_master_data_alkes')->where('id', $id)->update([
                'nama_alat' => $request->input('nama_alat'),
                'created_by' => auth()->user()->id,
                'updated_at' => now(),
                
            ]);
            DB::connection('pku')->commit();
            
            return redirect()->back()->with('success', 'Master alat kesehatan Berhasil Diedit!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();
            
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function update_harga(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
         
            'harga' => 'required',
            'ukuran' => 'required'
        ]);
        
        
        try {
            DB::connection('pku')->beginTransaction();

            $masterAlkes = DB::connection('pku')->table('fis_harga_alkes')->where('id', $id)->update([

                'harga' => $request->input('harga'),
                'ukuran' => $request->input('ukuran'),
                'created_by' => auth()->user()->id,
                'updated_at' => now(),


            ]);
            DB::connection('pku')->commit();

            return redirect()->back()->with('success', 'Master harga alat kesehatan Berhasil Diedit!');
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
        $data = DB::connection('pku')->table('fis_master_data_alkes')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }

    public function destroy_harga($id)
    {
        //
        $data = DB::connection('pku')->table('fis_harga_alkes')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
