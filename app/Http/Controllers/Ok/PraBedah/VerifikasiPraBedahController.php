<?php

namespace App\Http\Controllers\Ok\PraBedah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PenandaanOperasiService;

class VerifikasiPraBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $penandaanOperasiService;
    protected $bookingOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.pra-bedah.';
        $this->prefix = 'Verifikasi Pra Bedah';
        $this->penandaanOperasiService = new PenandaanOperasiService();
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        $bookings = $this->bookingOperasiService->get();
        // dd($bookings);

        return view($this->view . 'verifikasi-prabedah.index', compact('title', 'bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->prefix . ' ' . 'Input Data';

        return view($this->view . 'verifikasi-prabedah.create', compact('title'));
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
