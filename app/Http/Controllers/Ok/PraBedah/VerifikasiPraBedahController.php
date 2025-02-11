<?php

namespace App\Http\Controllers\Ok\PraBedah;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Http\Controllers\Controller;
use App\Models\MasterData\TtdPerawat;
use App\Services\SimRs\DokterService;
use App\Models\Operasi\PenandaanOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Models\Operasi\PraBedah\AssesmenPraBedah;
use App\Services\Operasi\PraBedah\VerifikasiPraBedahService;
use App\Http\Requests\Operasi\Prabedah\StoreVerifikasiPraBedahRequest;
use App\Http\Requests\Operasi\Prabedah\UpdateVerifikasiPraBedahRequest;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;

class VerifikasiPraBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $assesmenOperasiService;
    protected $verifikasiPraBedahService;
    protected $dokterService;

    public function __construct()
    {
        $this->view = 'pages.ok.pra-bedah.';
        $this->prefix = 'Verifikasi Pra Bedah';
        $this->assesmenOperasiService = new AssesmenPraBedahService();
        $this->verifikasiPraBedahService = new VerifikasiPraBedahService();
        $this->dokterService = new DokterService();
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        $date = date('Y-m-d');

        $verifikasis = [];
        $statusBerkas = null;
        $statusVerifikasi = null;

        $user = auth()->user();

        if ($user->hasRole('perawat poli') || $user->hasRole('perawat poli mata') || $user->hasRole('perawat igd')) {

            $kode_dokter = $request->input('kode_dokter');

            if ($kode_dokter) {

                $sessionBangsal = null;
                $verifikasis = $this->bookingOperasiService->byDate($date, $sessionBangsal, $kode_dokter);

                $statusBerkas = BookingHelper::getStatusBerkasVerifikasi($verifikasis);

                $statusVerifikasi = BookingHelper::getStatusVerifikasi($verifikasis);
            }
        } elseif ($user->hasRole('perawat bangsal')) {
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            $verifikasis = $this->bookingOperasiService->byPasienAktif($date, $sessionBangsal);

            $statusBerkas = BookingHelper::getStatusBerkasVerifikasi($verifikasis);

            $statusVerifikasi = BookingHelper::getStatusVerifikasi($verifikasis);
            // dd($verifikasis);
        }

        return view($this->view . 'verifikasi-prabedah.index', compact('verifikasis'))
            ->with([
                'title' => $title,
                'dokters' => $this->dokterService->byBedahOperasi(),
                'statusVerifikasi' => $statusVerifikasi,
                'statusBerkas' => $statusBerkas,
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
        $labs = $this->assesmenOperasiService->getLabByKodeReg($kode_register);

        // check penandaan lokasi and assesmen pra bedah
        $penandaanLokasi = PenandaanOperasi::where('kode_register', $kode_register)->first();
        $assesmenPraBedah = AssesmenPraBedah::where('kode_register', $kode_register)->first();

        $checklistPenandaan = $penandaanLokasi ? true : false;
        $checklistAssesmenPraBedah = $assesmenPraBedah ? true : false;
        // dd($assesmenPraBedah);

        return view($this->view . 'verifikasi-prabedah.create', compact('title', 'biodata', 'checklistPenandaan', 'checklistAssesmenPraBedah', 'labs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVerifikasiPraBedahRequest $request)
    {
        try {
            $this->verifikasiPraBedahService->insert($request->validated());

            return redirect('/prabedah/verifikasi-prabedah')->with('success', 'Verifikasi berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Verifikasi: ' . $e->getMessage());
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
        $verifikasi = $this->verifikasiPraBedahService->findById($kode_register);
        // dd($verifikasi);
        $biodata = $this->bookingOperasiService->biodata($kode_register);
        $labs = $this->assesmenOperasiService->getLabByKodeReg($kode_register);


        // check penandaan lokasi and assesmen pra bedah
        $penandaanLokasi = PenandaanOperasi::where('kode_register', $kode_register)->first();
        $assesmenPraBedah = AssesmenPraBedah::where('kode_register', $kode_register)->first();

        $checklistPenandaan = $penandaanLokasi ? true : false;
        $checklistAssesmenPraBedah = $assesmenPraBedah ? true : false;

        return view($this->view . 'verifikasi-prabedah.edit', compact('title', 'biodata', 'verifikasi', 'checklistPenandaan', 'checklistAssesmenPraBedah', 'labs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVerifikasiPraBedahRequest $request, $kode_register)
    {
        try {
            $this->verifikasiPraBedahService->update($kode_register, $request->validated());

            return redirect('/prabedah/verifikasi-prabedah')->with('success', 'Verifikasi Pra Bedah berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal merubah verifikasi pra bedah: ' . $e->getMessage());
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
