<?php

namespace App\Http\Controllers\OK;

use App\Models\RajalDokter;
use Illuminate\Http\Request;
use Apuse App\Models\Operasi\BookingOperasi;
use App\Http\Controllers\Controller;
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

        // get data by date in operasi
        $bookings = $this->bookingOperasiService->byDate('2024-11-11');
        dd($bookings);
        return view($this->view . 'bookingOperasi.index', compact('bookings'))->with([
            'title' => $title
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
