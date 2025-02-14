<?php

namespace App\Http\Controllers\Ok;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\DataUmum\PreOperasiService;
use App\Models\Operasi\PostOperasi\VerifikasiPostOperasi;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;
use App\Http\Requests\Operasi\PreOperasi\StorePreOperasiRequest;
use App\Http\Requests\Operasi\PreOperasi\UpdatePreOperasiRequest;
use App\Models\Operasi\PreOperasi\VerifikasiPreOperasi;

class PreOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $preOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.operasi.pre-operasi.';
        $this->prefix = 'Pre Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->preOperasiService = new PreOperasiService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        // get data from service
        $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
        
        $preOperasi = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');

        $statusPre = BookingHelper::getStatusPreOperasi($preOperasi);

        $verifikasiPre = BookingHelper::getVerifikasiPreOperasi($preOperasi);

        return view($this->view . 'index', compact('preOperasi'))
            ->with([
                'title' => $title,
                'statusPre' => $statusPre,
                'verifikasiPre' => $verifikasiPre,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kode_register)
    {
        $title = $this->prefix . ' ' . 'Input Data';
        $biodata = $this->bookingOperasiService->biodata($kode_register);
        // dd($biodata);

        return view($this->view . 'create', compact('biodata'))
            ->with([
                'title' => $title,
                'bookingByRegister' => $this->bookingOperasiService->findByRegister($kode_register),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreOperasiRequest $request)
    {
        try {
            $this->preOperasiService->insert($request->validated());

            return redirect('/pre-post/pre-operasi')->with('success', 'Pre Operasi berhasil ditambahkan.');
            // return redirect()->back()->with('success', 'Pre Operasi berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan post operasi: ' . $e->getMessage());
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
    public function edit($kode_register)
    {
        $title = $this->prefix . ' ' . 'Edit Data';
        $preOperasi = $this->preOperasiService->findById($kode_register);
        // dd($preOperasi);
        $biodata = $this->bookingOperasiService->biodata($kode_register);

        return view($this->view . 'edit', compact('title', 'biodata', 'preOperasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreOperasiRequest $request, $kode_register)
    {
        try {
            $this->preOperasiService->update($kode_register, $request->validated());

            return redirect('/pre-post/pre-operasi')->with('success', 'Data Pre Operasi berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal merubah post operasi: ' . $e->getMessage());
        }
    }

    public function VerifikasiPreOp($kode_register)
    {
        // dd($kode_register);
        try {
            $this->preOperasiService->insertVerifPreOp($kode_register);

            return redirect('/pre-post/pre-operasi')->with('success', 'Verifikasi Pre Operasi berhasil.');
            // return redirect()->back()->with('success', 'Pre Operasi berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan post operasi: ' . $e->getMessage());
        }
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
