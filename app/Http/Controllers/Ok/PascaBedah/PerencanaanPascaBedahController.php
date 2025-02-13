<?php

namespace App\Http\Controllers\Ok\PascaBedah;

use Exception;
use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Simrs\Dokter;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\Ok\PascaBedahHelper;
use App\Http\Controllers\Controller;
use App\Services\SimRs\DokterService;
use App\Services\Operasi\BookingOperasiService;
use App\Http\Requests\Operasi\PascaBedah\StorePascaBedahRequest;
use App\Http\Requests\Operasi\PascaBedah\UpdatePascaBedahRequest;
use App\Services\Operasi\PascaBedah\PerencanaanPascaBedahService;

class PerencanaanPascaBedahController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $perencanaanPascaBedah;
    protected $userService;
    protected $dokterService;
    protected $rajal;


    public function __construct()
    {
        $this->view = 'pages.ok.pasca-bedah.';
        $this->prefix = 'Perencanaan Medis Pasca Bedah';
        $this->perencanaanPascaBedah = new PerencanaanPascaBedahService();
        $this->bookingOperasiService = new BookingOperasiService();
        $this->dokterService = new DokterService();
        $this->rajal = new Rajal();
    }

    public function cetak($kode_register)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $cetak = $this->perencanaanPascaBedah->cetak($kode_register);
        $biodataPasien = $this->bookingOperasiService->biodata($kode_register);
        $pasien = $biodataPasien->pendaftaran->registerPasien;
        // dd($cetak);

        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'PerencanaanPascaBedah-' . $date;

        $pdf = PDF::loadview('pages.ok.pasca-bedah.cetak-pascabedah', [
            'cetak' => $cetak,
            'title' => $title,
            'tanggal' => $tanggal,
            'pasien' => $pasien
        ]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        $date = date('Y-m-d'); 
    
        if ($request->input('tanggal') != null) {
            $date = $request->input('tanggal');
        }

        $pascaBedah = collect();

        $user = auth()->user();

        if ($user->hasRole('perawat poli') || $user->hasRole('perawat poli mata')) {
            $kode_dokter = $request->input('kode_dokter');
            if ($kode_dokter) {
                $sessionBangsal = null;
                $pascaBedah = collect($this->bookingOperasiService->byDate($date, $sessionBangsal, $kode_dokter));
                // dd($pascaBedah);
            }
        } elseif ($user->hasRole('perawat bangsal')) {
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            // Ambil pasien dokter
            $pascaBedah = $this->bookingOperasiService->byPasienAktif($date, $sessionBangsal);
            $statusPascaBedah = PascaBedahHelper::getStatusPascaBedah($pascaBedah);
            // dd($pascaBedah);
        } 
        else {
            $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
            // Ambil pasien dokter
            $kodeDokter = $request->input('kode_dokter');
            // dd($kodeDokter);
            $pascaBedah = $this->bookingOperasiService->byPasienAktif($date, $sessionBangsal, $kodeDokter);
            $statusPascaBedah = PascaBedahHelper::getStatusPascaBedah($pascaBedah);
            // dd($pascaBedah);
        }

        return view($this->view . 'index', compact('pascaBedah'))
            ->with([
                'title' => $title,
                'dokters' => $this->dokterService->byBedahOperasi(),
                'statusPascaBedah' => $statusPascaBedah,
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
    public function store(StorePascaBedahRequest $request)
    {
        try {
            $this->perencanaanPascaBedah->insert($request->validated());
            return redirect()->back()->with('success', 'Perencanaan Pasca Bedah berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Perencanaan Pasca Bedah: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_register)
    {
        //
        $title = $this->prefix . ' ' . 'Detail';
        $pascaBedahDetail = $this->perencanaanPascaBedah->detailPascaBedah($kode_register);
        // dd($pascaBedahDetail);

        return view($this->view . 'detail', compact('pascaBedahDetail'))
            ->with([
                'title' => $title,
                'biodata' => $this->rajal->pasien_bynoreg($kode_register)
            ]);
      
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
    public function update(UpdatePascaBedahRequest $request, $kode_register)
    {
        try {
            // Validasi input
            $this->perencanaanPascaBedah->update($kode_register, $request->validated());

            return redirect()->back()->with('success', 'Perencanaan Pasca Bedah berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Perencanaan Pasca Bedah: ' . $e->getMessage());
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
