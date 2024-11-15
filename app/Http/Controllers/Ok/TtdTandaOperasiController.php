<?php

namespace App\Http\Controllers\OK;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operasi\TtdTandaOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\TtdTandaOperasiService;

class TtdTandaOperasiController extends Controller
{
     protected $view;
     protected $prefix;
     protected $ttdTandaOperasi;
     protected $booking;
     protected $bookingOperasiService;
     protected $ttdTandaOperasiService;

    public function __construct(TtdTandaOperasi $ttdTandaOperasi)
    {
        $this->view = 'pages.ok.';
        $this->prefix = 'Tanda Tangan';
        $this->ttdTandaOperasi = $ttdTandaOperasi;
        $this->bookingOperasiService = new BookingOperasiService();
        $this->ttdTandaOperasiService = new TtdTandaOperasiService();
        
    }

    public function index()
    {
        //
        $title = 'Penandaan Operasi';
        // $ttdpendaanpasien = $this->ttdTandaOperasiService->byDate(date('Y-m-d'));
        $ttdpendaanpasien = $this->ttdTandaOperasiService->get();
        $bookings = $this->bookingOperasiService->get();
        // dd($ttdpendaanpasien);
        return view($this->view . 'tanda-tangan.index',compact('ttdpendaanpasien','bookings'))->with([
            'title'=>$title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // dd($request->input('kode_register'));

        
        $title = 'Add Ttd Penandaan Operasi';
        // dd('ok');
        $bookings = $this->bookingOperasiService->get();
        // dd($bookings);
        return view($this->view . 'tanda-tangan.create',compact('bookings'))->with([
            'title'=>$title,
            'biodata'=> $this->bookingOperasiService->biodata($request->input('kode_register'))
        ]);
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
