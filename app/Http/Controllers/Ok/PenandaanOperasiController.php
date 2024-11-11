<?php

namespace App\Http\Controllers\OK;

use App\Models\RajalDokter;
use App\Models\Rekam_medis;
use App\Models\OperasiKamar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operasi\BookingOperasi;
use App\Services\Operasi\BookingOperasiService;

class PenandaanOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasi;
    protected $bookingOperasiService;

    public function __construct(BookingOperasi $bookingOperasi)
    {
        $this->bookingOperasi = $bookingOperasi;
        $this->view = 'pages.ok.';
        $this->prefix = 'Penandaan Lokasi';
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function jadwal(Request $request)
    {
        $title = 'Jadwal Operasi';
        $jadwal = $this->bookingOperasiService->get();
        // dd($jadwal);
        return view($this->view . 'jadwalOperasi.index', compact('title', 'jadwal'));
    }

    public function index(Request $request)
    {
        $title = 'Jadwal Operasi';
        // $jadwal = $this->booking->getJadwalOperasi(); 
        $jadwal = BookingOperasi::with('ruangan')->get();
        // dd($jadwal);
        return view($this->view . 'penandaanOperasi.index', compact('title', 'jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // $biodata = $this->rekam_medis->getBiodata($noReg);
        $operasiKamar = new OperasiKamar();
        return view($this->view . 'penandaanOperasi.create', compact('title', 'operasiKamar'));
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
