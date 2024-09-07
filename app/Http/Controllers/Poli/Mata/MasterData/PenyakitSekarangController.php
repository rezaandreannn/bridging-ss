<?php

namespace App\Http\Controllers\Poli\Mata\MasterData;

use App\Models\Pasien;
use App\Models\PoliMata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Rules\UniqueInConnection;
use App\Rules\UniqueUpdateInConnection;


class PenyakitSekarangController extends Controller
{
    protected $view;
    // protected $routeIndex;
    protected $prefix;
    protected $poliMata;
    protected $pasien;


    public function __construct(PoliMata $poliMata)
    {

        $this->poliMata = $poliMata;
        $this->view = 'pages.poli.mata.master_data.';
        // $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Master Data';
        $this->pasien = new Pasien;
    }

    public function index()
    {
        $penyakitSekarang = $this->poliMata->getPenyakitSekarang();

        // dd($diagnosisMedis);
        $title = $this->prefix . ' ' . 'Riwayat Penyakit';
        return view($this->view . 'penyakit_sekarang.index', compact('title', 'penyakitSekarang'));
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
            'nama_penyakit_sekarang' => ['required', new UniqueInConnection('poli_mata_master_data_penyakitsekarang', 'nama_penyakit_sekarang', 'pku')],
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('poli_mata_master_data_penyakitsekarang')->insert([
                'nama_penyakit_sekarang' => $request->input('nama_penyakit_sekarang'),
                'created_by' => auth()->user()->id,
                'created_at' => now(),
                'updated_at' => now(),

            ]);
            DB::connection('pku')->commit();

            return redirect()->route('penyakitSekarang.index')->with('success', 'Riwayat Penyakit Berhasil Ditambahkan!');
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
            'nama_penyakit_sekarang' => ['required', new UniqueUpdateInConnection('poli_mata_master_data_penyakitsekarang', 'nama_penyakit_sekarang', 'pku', $id)],
        ]);

        try {
            DB::connection('pku')->beginTransaction();

            DB::connection('pku')->table('poli_mata_master_data_penyakitsekarang')->where('id', $id)->update([
                'nama_penyakit_sekarang' => $request->input('nama_penyakit_sekarang'),
                'created_by' => auth()->user()->id,
                'updated_at' => now(),

            ]);
            DB::connection('pku')->commit();

            return redirect()->route('penyakitSekarang.index')->with('success', 'Riwayat Penyakit Berhasil Diedit!');
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
        $data = DB::connection('pku')->table('poli_mata_master_data_penyakitsekarang')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
