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
use App\Services\SimRs\DokterService;

class BerkasPraBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $assesmenOperasiService;
    protected $dokterService;
    protected $verifikasiPraBedahService;

    public function __construct()
    {
        $this->view = 'pages.ok.pra-bedah.';
        $this->prefix = 'Berkas Pra Bedah';
        $this->assesmenOperasiService = new AssesmenPraBedahService();
        $this->dokterService = new DokterService();
        $this->verifikasiPraBedahService = new VerifikasiPraBedahService();
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function cetak($kode_register)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $cetakBerkas = $this->assesmenOperasiService->cetakBerkas($kode_register);
        $labs = $this->assesmenOperasiService->getLabByKodeReg($kode_register);
        $booking = collect($this->bookingOperasiService->byRegister($kode_register))->first();
        $biodataPasien = $this->bookingOperasiService->biodata($kode_register);
        $pasien = $biodataPasien->pendaftaran->registerPasien;

        // dd($cetakBerkas);

        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'AssesmenPraBedah-' . $date;

        $pdf = PDF::loadview('pages.ok.pra-bedah.berkas.cetak-dokumen', [
            'cetak' => $cetakBerkas,
            'labs' => $labs,
            'pasien' => $pasien,
            'booking' => $booking,
            'title' => $title,
            'tanggal' => $tanggal
        ]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }


    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        $assesmens = [];

        $isPerawatPoli = auth()->user()->hasRole('perawat poli');

        if ($isPerawatPoli) {

            $kode_dokter = $request->input('kode_dokter');

            if ($kode_dokter) {

                $sessionBangsal = null;
                $assesmens = $this->bookingOperasiService->byDate($date, $sessionBangsal, $kode_dokter);
            }
        }
        // Cek jika login sebagai dokter
        elseif (auth()->user()->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;
            // Ambil pasien dokter
            $assesmens = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');
        } elseif (auth()->user()->hasRole('perawat bangsal')) {
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            // Ambil pasien bangsal
            $assesmens = $this->bookingOperasiService->byPasienAktif($date, $sessionBangsal ?? '');
        }

        return view($this->view . 'berkas.index', compact('assesmens', 'isPerawatPoli'))
            ->with([
                'title' => $title,
                'dokters' => $this->dokterService->byBedahOperasi(),
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
