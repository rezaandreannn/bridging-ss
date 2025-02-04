<?php

namespace App\Http\Controllers\OK;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operasi\PenandaanPasien\StorePenandaanPasienRequest;
use App\Http\Requests\Operasi\PenandaanPasien\UpdatePenandaanPasienRequest;
use App\Models\Operasi\PenandaanOperasi;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PenandaanOperasiService;
use App\Services\SimRs\DokterService;

class PenandaanOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $penandaanOperasiService;
    protected $dokterService;

    public function __construct()
    {

        $this->view = 'pages.ok.';
        $this->prefix = 'Penandaan Lokasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->penandaanOperasiService = new PenandaanOperasiService();
        $this->dokterService = new DokterService();
    }

    public function jadwal(Request $request)
    {
        $title = 'Jadwal Operasi';
        $jadwal = $this->bookingOperasiService->get();

        return view($this->view . 'jadwalOperasi.index', compact('title', 'jadwal'));
    }

    public function cetak($kodeRegister)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $penandaan = $this->penandaanOperasiService->unduhByRegister($kodeRegister);
        // dd($penandaan);

        // dd($penandaan);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'penandaan-operasi-' . $date;

        $pdf = PDF::loadview('pages.ok.penandaan-operasi.cetak-dokumen', ['penandaan' => $penandaan, 'title' => $title, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function index(Request $request)
    {
        $title = 'Penandaan Operasi';

        $date = date('Y-m-d');
        if ($request->input('tanggal') != null) {
            $date = $request->input('tanggal');
        }

        $user = auth()->user();

        $penandaans = [];
        $penandaan = [];
        $statusPenandaan = null;
        $statusGambar = null;

        // Cek jika login sebagai userbangsal
        if ($user->hasRole('dokter umum')) {
            $sessionIbs = auth()->user()->username ?? null;
            $penandaans = $this->bookingOperasiService->byDateFormDokter($date, '',  '');

            $penandaan = $this->penandaanOperasiService->get();

            // cek apakah di data booking ini sudah di beri penandaan lokasi operasi
            $statusPenandaan = BookingHelper::getStatusPenandaan($penandaans);
            $statusGambar = BookingHelper::getStatusGambar($penandaans);
        }
        // Cek jika login sebagai dokter
        elseif ($user->hasRole('dokter bedah')) {
            $sessionKodeDokter = auth()->user()->username ?? null;
            // Ambil pasien dokter
            $penandaans = $this->bookingOperasiService->byDateFormDokter($date, '', $sessionKodeDokter ?? '');

            // dd($penandaans);

            $penandaan = $this->penandaanOperasiService->get();
            // cek apakah di data booking ini sudah di beri penandaan lokasi operasi
            $statusPenandaan = BookingHelper::getStatusPenandaan($penandaans);
            $statusGambar = BookingHelper::getStatusGambar($penandaans);
        } elseif ($user->hasRole('perawat poli mata')) {
            $kode_dokter = $request->input('kode_dokter');

            if ($kode_dokter) {

                $sessionBangsal = null;
                $penandaans = $this->bookingOperasiService->byDate($date, $sessionBangsal, $kode_dokter);
                $penandaan = $this->penandaanOperasiService->get();
                // cek apakah di data booking ini sudah di beri penandaan lokasi operasi
                $statusPenandaan = BookingHelper::getStatusPenandaan($penandaans);
                $statusGambar = BookingHelper::getStatusGambar($penandaans);
            }
        }

        // dd($penandaan);

        return view($this->view . 'penandaan-operasi.index', compact('penandaans'))
            ->with([
                'title' => $title,
                'statusPenandaan' => $statusPenandaan,
                'penandaan' => $penandaan,
                'dokters' => $this->dokterService->byBedahOperasi(),
                'statusGambar' => $statusGambar,
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($noReg)
    {

        $title = $this->prefix . ' ' . 'Operasi';
        $biodata = $this->bookingOperasiService->biodata($noReg);
        $tandaOperasi = PenandaanOperasi::where('kode_register', $noReg)->first();
        // dd($biodata);
        return view($this->view . 'penandaan-operasi.create', compact('title', 'biodata', 'tandaOperasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenandaanPasienRequest $request)
    {
        try {

            $data = [
                'kode_register' => $request->kode_register,
                'hasil_gambar' => $request->signatureData,
                'asal_ruangan' => $request->asal_ruangan,
                'jenis_operasi' => $request->jenis_operasi,
            ];

            $this->penandaanOperasiService->insert($data);

            return redirect()->back()->with('success', 'Penandaan Operasi berhasil ditambahkan.');
            // return redirect('ibs/list-pasien-detail/' . $request->kode_register)->with('success', 'Penandaan Operasi berhasil di ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan Penandaan Operasi: ' . $e->getMessage());
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
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID
        $penandaan = $this->penandaanOperasiService->findById($id);
        // dd($penandaan);

        // dd($penandaan);
        $noReg = $penandaan->kode_register;

        // Ambil biodata berdasarkan nomor registrasi
        $biodata = $this->bookingOperasiService->biodata($noReg);
        // dd($biodata);
        return view($this->view . 'penandaan-operasi.edit', compact('title', 'biodata', 'penandaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenandaanPasienRequest $request, $id)
    {
        try {
            $data = [
                'kode_register' => $request->kode_register,
                'hasil_gambar' => $request->signatureData,
                'asal_ruangan' => $request->asal_ruangan,
                'jenis_operasi' => $request->jenis_operasi,
            ];

            // Panggil service untuk melakukan update
            $this->penandaanOperasiService->update($id, $data);
            return redirect()->back()->with('success', 'Penandaan Operasi berhasil di ubah.');
            // return redirect('penandaan/penandaan-operasi')->with('success', 'Penandaan Operasi berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan penandaan operasi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_register)
    {
        // dd($kode_register);
        try {
            $this->penandaanOperasiService->delete($kode_register);
            $feedback = 'success';
            $message = 'Data Berhasil Dihapus!';
        } catch (\Throwable $e) {
            $feedback = 'error';
            $message = 'Data Gagal dihapus' . $e->getMessage();
        }
        return redirect()->back()->with($feedback, $message);
    }
}
