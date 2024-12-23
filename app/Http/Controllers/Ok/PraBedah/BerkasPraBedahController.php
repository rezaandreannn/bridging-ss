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
        $booking = collect($this->bookingOperasiService->byRegister($kode_register))->first();
        $biodataPasien = $this->bookingOperasiService->biodata($kode_register);
        $pasien = $biodataPasien->pendaftaran->registerPasien;
        // dd($cetak);


        // dd($booking);

        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'AssesmenPraBedah-' . $date;

        $pdf = PDF::loadview('pages.ok.pra-bedah.berkas.cetak-dokumen', [
            'cetak' => $cetak,
            'pasien' => $pasien,
            'booking' => $booking,
            'title' => $title,
            'tanggal' => $tanggal
        ]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function download($kode_register)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $cetak = $this->assesmenOperasiService->cetak($kode_register);
        // dd($cetak);

        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'AssesmenPraBedah-' . $date;

        $pdf = PDF::loadview('pages.ok.pra-bedah.berkas.download', ['cetak' => $cetak, 'title' => $title, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A5');
        return $pdf->stream($filename . '.pdf');
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        $assesmens = [];
        // Cek jika login sebagai userbangsal
        if (auth()->user()->hasRole('perawat bangsal')) {
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            // Ambil pasien bangsal
            $assesmens = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '', '');
        }
        // Cek jika login sebagai dokter
        elseif (auth()->user()->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;
            // Ambil pasien dokter
            $assesmens = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');
        }

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
