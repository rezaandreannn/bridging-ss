<?php

namespace App\Http\Controllers\Ok;

use App\Models\Rekam_medis;
use App\Models\OperasiKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Rajal;
use App\Rules\UniqueInConnection;
use App\Rules\UniqueUpdateInConnection;

class RuangOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $operasiKamar;
    protected $rekam_medis;
    protected $rajal;

    public function __construct(OperasiKamar $operasiKamar)
    {
        $this->rekam_medis = new Rekam_medis;
        $this->rajal = new Rajal;
        $this->operasiKamar = $operasiKamar;
        $this->view = 'pages.ok.';
        $this->prefix = 'Ruang';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Operasi';
        $data = $this->operasiKamar->getRuang();
        // dd($data);
        return view($this->view . 'ruangan.index', compact('title', 'data'));
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
        $validatedData = $request->validate([
            'kode_ruang' => ['required', new UniqueInConnection('ok_ruangan', 'kode_ruang', 'pku')],
        ]);

        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);

        DB::connection('pku')->table('ok_ruangan')->insert([
            'kode_ruang' => $request->input('kode_ruang'),
            'nama_ruang' => $request->input('nama_ruang'),
            'created_by' => auth()->user()->id ?? '',
            'created_at' => now()
        ]);
        return redirect()->route('operasi.ruang.index')->with('success', 'Nama Ruang Berhasil Ditambahkan!');
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
        // $userEmr = $this->rajal->getUserEmr(auth()->user()->username);

        DB::connection('pku')->table('ok_ruangan')->where('id', $id)->update([
            'kode_ruang' => $request->input('kode_ruang'),
            'nama_ruang' => $request->input('nama_ruang'),
            'updated_by' => auth()->user()->id ?? '',
            'updated_at' => now(),

        ]);

        return redirect()->route('operasi.ruang.index')->with('success', 'Nama Ruang Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete the record
        DB::connection('pku')->table('ok_ruangan')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Data Berhasil Dihapus!');
    }
}
