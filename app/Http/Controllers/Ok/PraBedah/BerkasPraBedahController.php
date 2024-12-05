<?php

namespace App\Http\Controllers\Ok\PraBedah;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Services\MasterData\UserService;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;
use App\Services\Operasi\PraBedah\VerifikasiPraBedahService;

class BerkasPraBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $assesmenOperasiService;
    protected $verifikasiPraBedahService;

    public function __construct()
    {
        $this->view = 'pages.ok.pra-bedah.';
        $this->prefix = 'Verifikasi Pra Bedah';
        $this->assesmenOperasiService = new AssesmenPraBedahService();
        $this->verifikasiPraBedahService = new VerifikasiPraBedahService();
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function cetak($kode_register)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $cetak = $this->assesmenOperasiService->cetak($kode_register);
        // dd($cetak);

        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'AssesmenPraBedah-' . $date;

        $pdf = PDF::loadview('pages.ok.pra-bedah.berkas.cetak-dokumen', ['cetak' => $cetak, 'title' => $title, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = date('Y-m-d');
        $date = '2024-12-02';

        // get data from service
        $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
        $assesmens = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');

        return view($this->view . 'berkas.index', compact('assesmens'))
            ->with([
                'title' => $title,
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
