<?php

namespace App\Http\Controllers\Ok;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Operasi\OperatorAsistenDetail;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\DataUmum\PreOperasiService;
use App\Services\Operasi\DataUmum\PostOperasiService;
use App\Services\Operasi\LaporanOperasi\LaporanOperasiService;

class BerkasPrePostController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $preOperasiService;
    protected $postOperasiService;
    protected $laporanOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.operasi.berkas.';
        $this->prefix = 'Pre Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->preOperasiService = new PreOperasiService();
        $this->postOperasiService = new PostOperasiService();
        $this->laporanOperasiService = new LaporanOperasiService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        // get data from service
        $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
        $berkas = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');

        $statusPrePost = BookingHelper::getStatusPrePostOperasi($berkas);
        // dd($statusPrePost);

        return view($this->view . 'index', compact('berkas'))
            ->with([
                'title' => $title,
                'statusPrePost' => $statusPrePost,
            ]);
    }

    public function cetak($kode_register)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $cetakBerkas = $this->postOperasiService->cetakBerkas($kode_register);
        // dd($cetakBerkas);
        $booking = collect($this->bookingOperasiService->byRegister($kode_register))->first();
        $biodataPasien = $this->bookingOperasiService->biodata($kode_register);
        $pasien = $biodataPasien->pendaftaran->registerPasien;

        // ambil data field assisten code
        $perawatByReg = DataUmumPostOperasi::where('kode_register', $kode_register)->first()->toArray();
        // dd($perawatByReg);
        // Dokter Operator
        $operatorCodes = explode(', ', $perawatByReg["dokter_operator"]);
        $operators =  $this->laporanOperasiService->getNameAssistenByCodes($operatorCodes);
        // Asisten Bedah
        $asistenCodes = explode(', ', $perawatByReg["asisten_bedah"]);
        $assistens =  $this->laporanOperasiService->getNameAssistenByCodes($asistenCodes);
        // Dokter Anastesi
        $dokterCodes = explode(', ', $perawatByReg["dokter_anastesi"]);
        $dokters =  $this->laporanOperasiService->getNameAssistenByCodes($dokterCodes);
        // Perawat Anastesi
        $anastesiCodes = explode(', ', $perawatByReg["asisten_anastesi"]);
        $anastesis =  $this->laporanOperasiService->getNameAssistenByCodes($anastesiCodes);
        // dd($cetakBerkas);

        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'PrePost-' . $date;

        $pdf = PDF::loadview('pages.ok.operasi.berkas.cetak-dokumen', [
            'cetak' => $cetakBerkas,
            'pasien' => $pasien,
            'booking' => $booking,
            'title' => $title,
            'tanggal' => $tanggal,
            'operators' => $operators,
            'assistens' => $assistens,
            'dokters' => $dokters,
            'anastesis' => $anastesis,
        ]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
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
