<?php

namespace App\Http\Controllers\MasterData;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\TtdDokter\StoreTtdDokter;
use App\Models\MasterData\TtdDokter;
use App\Services\SimRs\DokterService;
use App\Services\MasterData\TandaTanganDokterService;

class TtdDokterController extends Controller
{
    protected $view;
    protected $prefix;
    protected $ttdTandaOperasi;

    //menggunakan services
    protected $tandaTanganDokterService;
    protected $dokterService;

    public function __construct()
    {
        $this->view='pages.md.';
        $this->prefix='Tandan Tangan Dokter.';
        $this->tandaTanganDokterService= new TandaTanganDokterService;
        $this->dokterService= new DokterService;
    }
    public function index()
    {
        //
        $ttdDokters = $this->tandaTanganDokterService->get();
        // dd($ttdDokters);
        return view($this->view . 'ttd-dokter.index', compact('ttdDokters'))->with([
            'title' => 'Tanda Tangan Dokter',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Form pembuatan tanda tangan dokter';  
        return view($this->view . 'ttd-dokter.create',compact('title'))->with([
            'dokters' => $this->dokterService->allDokter()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTtdDokter $request)
    {
        // dd($request->kode_dokter);
            try {

                $this->tandaTanganDokterService->insert($request->validated());

                return redirect()->route('ttd-dokter.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
            } catch (Exception $e) {
                // Redirect dengan pesan error jika terjadi kegagalan
                return redirect()->back()->with('error', 'Gagal menambahkan tanda tangan: ' . $e->getMessage());
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
        
        $tandatangandokter = $this->tandaTanganDokterService->findById($id);
        // dd($tandatangandokter);
        return view($this->view . 'ttd-dokter.edit',compact('tandatangandokter'))->with([
            'title' => 'Form edit tanda tangan dokter',  
            'dokters' => $this->dokterService->allDokter()
        ]);
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
        try {

            $data = [
                'kode_dokter' => $request->kode_dokter,
                'ttd_dokter' => $request->ttd_dokter,
                'updated_at' => date('Y-m-d H:i:s'),
            
            ];

            $this->tandaTanganDokterService->update($id,$data);

            return redirect()->route('ttd-dokter.index')->with('success', 'Tanda tangan berhasil diperbarui.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan tanda tangan: ' . $e->getMessage());
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
        try{

            $this->tandaTanganDokterService->delete($id);

        return redirect()->route('ttd-dokter.index')->with('success', 'Tanda tangan berhasil dihapus.');

        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menghapus tanda tangan: ' . $e->getMessage());
        }
    }
}
