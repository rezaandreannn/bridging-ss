<?php

namespace App\Http\Controllers\Ok;

use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\DataUmum\PreOperasiService;
use App\Services\Operasi\DataUmum\PostOperasiService;

class BerkasPrePostController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $preOperasiService;
    protected $postOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.operasi.berkas.';
        $this->prefix = 'Pre Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->preOperasiService = new PreOperasiService();
        $this->postOperasiService = new PostOperasiService();
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
