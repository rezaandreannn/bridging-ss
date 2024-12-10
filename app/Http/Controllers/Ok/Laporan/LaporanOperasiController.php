<?php

namespace App\Http\Controllers\Ok\Laporan;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operasi\LaporanOperasi\StoreLaporanOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;
use App\Services\Operasi\LaporanOperasi\LaporanOperasiService;

class LaporanOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $assesmenOperasiService;
    protected $laporanOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.laporan-operasi.';
        $this->prefix = 'Laporan Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->assesmenOperasiService = new AssesmenPraBedahService();
        $this->laporanOperasiService = new LaporanOperasiService();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');
        if ($request->input('tanggal') != null) {
            $date = $request->input('tanggal');
        }

        // get data from service
        $sessionKodeDokter = auth()->user()->username ?? null;
        // dd($sessionKodeDokter);
        $laporans = $this->bookingOperasiService->byDokterOrAdmin($date, $sessionKodeDokter ?? '');
        // dd($laporans);


        return view($this->view . 'index', compact('laporans'))
            ->with([
                'title' => $title,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kode_register)
    {
        $biodata = $this->bookingOperasiService->biodata($kode_register);

        // dd($this->laporanOperasiService->getPenataAsisten());

        return view($this->view . 'create', compact('biodata'))->with([
            'title' => $this->prefix . ' ' . 'Input Data',
            'bookingByRegister' => $this->bookingOperasiService->findByRegister($kode_register),
            'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
            'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
            'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLaporanOperasi $request)
    {
        //
        // dd('ok');
        try {
            $this->laporanOperasiService->insert($request->validated());

            return redirect()->back()->with('success', 'Laporan operasi berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan laporan operasi: ' . $e->getMessage());
        }
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
