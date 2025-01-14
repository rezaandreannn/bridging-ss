<?php

namespace App\Http\Controllers\Ok\PraBedah;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operasi\AssesmenPraBedah\StoreAssesmenPraBedahRequest;
use App\Http\Requests\Operasi\AssesmenPraBedah\UpdateAssesmenPraBedahRequest;
use App\Models\MasterData\TtdPerawat;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;

class AssesmenPraBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $assesmenOperasiService;
    protected $userService;

    public function __construct()
    {
        $this->view = 'pages.ok.pra-bedah.';
        $this->prefix = 'Assesmen Pra Bedah';
        $this->assesmenOperasiService = new AssesmenPraBedahService();
        $this->bookingOperasiService = new BookingOperasiService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        // Status Tanda Tangan
        $userId = auth()->id();
        $statusTtd = TtdPerawat::where('user_id', $userId)->exists();


        $verifikasis = [];
        $statusAssesmen = null;
        // Cek jika login sebagai userbangsal
        if (auth()->user()->hasRole('perawat bangsal')) {
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            // Ambil pasien bangsal
            $verifikasis = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '', '');

            $statusAssesmen = BookingHelper::getStatusAssesmen($verifikasis);
        }
        // Cek jika login sebagai dokter
        elseif (auth()->user()->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;
            // Ambil pasien dokter
            $verifikasis = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');

            $statusAssesmen = BookingHelper::getStatusAssesmen($verifikasis);
        }

        return view($this->view . 'assesmen-prabedah.index', compact('verifikasis'))
            ->with([
                'title' => $title,
                'statusAssesmen' => $statusAssesmen,
                'statusTtd' => $statusTtd
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

        return view($this->view . 'assesmen-prabedah.create', compact('title', 'biodata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssesmenPraBedahRequest $request)
    {
        try {
            $this->assesmenOperasiService->insert($request->validated());
            // $this->assesmenOperasiService->insert($validatedData);
            return redirect()->back()->with('success', 'Assesmen Pra Bedah berhasil ditambahkan.');
            // return redirect('prabedah/assesmen-prabedah')->with('success', 'Assesmen Pra Bedah berhasil ditambahkan.');

            // return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan assesmen pra bedah: ' . $e->getMessage());
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
    public function edit($kodeRegister)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID
        $assesmen = $this->assesmenOperasiService->findById($kodeRegister);
        // dd($assesmen);

        // Ambil biodata berdasarkan nomor registrasi
        $biodata = $this->bookingOperasiService->biodata($kodeRegister);
        return view($this->view . 'assesmen-prabedah.edit', compact('title', 'biodata', 'assesmen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAssesmenPraBedahRequest $request, $kode_register)
    {
        try {
            // Validasi input
            $this->assesmenOperasiService->update($kode_register, $request->validated());

            return redirect()->back()->with('success', 'Assesmen Pra Bedah berhasil di ubah.');
            // return redirect('prabedah/assesmen-prabedah')->with('success', 'Assesmen Pra Bedah berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Assesmen Pra Bedah: ' . $e->getMessage());
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
