<?php

namespace App\Http\Controllers\OK;

use App\Models\RajalDokter;
use App\Models\Simrs\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\RuanganOperasi;
use App\Services\Operasi\BookingOperasiService;

class BookingOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingkamar;
    protected $rajaldokter;

    protected $bookingOperasiService;

    public function __construct(BookingOperasi $bookingkamar)
    {
        $this->rajaldokter = new RajalDokter;
        $this->bookingkamar = $bookingkamar;
        $this->view = 'pages.ok.';
        $this->prefix = 'Booking Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function index()
    {

        // variable declare
        $title = $this->prefix . ' ' . 'List';

        // example test get data by model
        $ruanganOperasi = RuanganOperasi::all();
        $dokters = Dokter::whereIn('Spesialis',[
            'SPESIALIS BEDAH','SPESIALIS KANDUNGAN','SPESIALIS ORTHOPEDI','SPESIALIS BEDAH MULUT','SPESIALIS THT-KL','SPESIALIS UROLOGI','SPESIALIS BEDAH SARAF']
        )->get();

        $bookings =$this->bookingOperasiService->get();
        // dd($bookings);
        return view($this->view . 'bookingOperasi.index', compact('bookings'))->with([
            'title' => $title,
            'ruanganOperasi' => $ruanganOperasi,
            'dokters' => $dokters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
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
