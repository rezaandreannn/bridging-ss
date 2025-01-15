<?php

namespace App\Http\Controllers\Ok\PascaBedah;

use Exception;
use Carbon\Carbon;
use App\Models\Simrs\Dokter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function __construct()
    {
        $this->view = 'pages.ok.pasca-bedah.';
        $this->prefix = 'Perencanaan Medis Pasca Bedah';
        $this->perencanaanPascaBedah = new PerencanaanPascaBedahService();
        $this->bookingOperasiService = new BookingOperasiService();
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

    public function index()
    {
        $title = 'Perencanaan Pasca Bedah';
        $date = date('Y-m-d');

        if (auth()->user()->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;

            $DoctorName = Dokter::where('Kode_Dokter', $sessionKodeDokter)
                ->pluck('Nama_Dokter')
                ->first();

            // Ambil pasien dokter
            $patients = $this->bookingOperasiService->byDate($date, '', $sessionKodeDokter ?? '');
        } else {
            abort(403);
        }

        return view('pages.ok.pasca-bedah.index', compact('title', 'patients', 'date', 'DoctorName'));
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
