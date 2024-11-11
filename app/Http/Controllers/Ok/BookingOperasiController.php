<?php

namespace App\Http\Controllers\OK;

use App\Models\RajalDokter;
use Illuminate\Http\Request;
use Apuse App\Models\Operasi\BookingOperasi;
use App\Http\Controllers\Controller;

class BookingOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingkamar;
    protected $rajaldokter;

    public function __construct(BookingOperasi $bookingkamar)
    {
        $this->rajaldokter = new RajalDokter;
        $this->bookingkamar = $bookingkamar;
        $this->view = 'pages.ok.';
        $this->prefix = 'Booking Operasi';
    }

    public function index()
    {

        // variable declare
        $title = $this->prefix . ' ' . 'List';

        // example test get data by model
        $bookings = BookingOperasi::with('ruangan')->get();
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
