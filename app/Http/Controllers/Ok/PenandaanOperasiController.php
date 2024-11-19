<?php

namespace App\Http\Controllers\OK;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PenandaanOperasiService;

class PenandaanOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $penandaanOperasiService;

    public function __construct()
    {

        $this->view = 'pages.ok.';
        $this->prefix = 'Penandaan Lokasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->penandaanOperasiService = new PenandaanOperasiService();
    }

    public function jadwal(Request $request)
    {
        $title = 'Jadwal Operasi';
        $jadwal = $this->bookingOperasiService->get();

        return view($this->view . 'jadwalOperasi.index', compact('title', 'jadwal'));
    }

    public function cetak($id)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID
        $penandaan = $this->penandaanOperasiService->findById($id);

        // dd($penandaan);
        $noReg = $penandaan->kode_register;

        // Ambil biodata berdasarkan nomor registrasi
        $biodata = $this->bookingOperasiService->biodata($noReg);
        // dd($biodata);
        $date = date('dMY');
        $tanggal = Carbon::now();

        $filename = 'PenandaanOperasi-' . $date;

        $pdf = PDF::loadview('pages.ok.penandaan-operasi.cetak-dokumen', ['penandaan' => $penandaan, 'biodata' => $biodata, 'tanggal' => $tanggal]);
        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function index(Request $request)
    {
        $title = 'Penandaan Operasi';

        $penandaans = $this->penandaanOperasiService->get();
        // cek apakah di data booking ini sudah di beri penandaan lokasi operasi
        $statusPenandaan = BookingHelper::getStatusPenandaan($penandaans);


        return view($this->view . 'penandaan-operasi.index', compact('penandaans'))
            ->with([
                'title' => $title,
                'statusPenandaan' => $statusPenandaan
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
        // dd($biodata);
        return view($this->view . 'penandaan-operasi.create', compact('title', 'biodata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'kode_register' => $request->kode_register,
                'hasil_gambar' => $request->signatureData,
                'jenis_operasi' => $request->jenis_operasi
            ];

            $this->penandaanOperasiService->insert($data);

            // return redirect()->back()->with('success', 'Penandaan Operasi berhasil ditambahkan.');
            return redirect('operasi/penandaan-operasi')->with('success', 'Penandaan Operasi berhasil di ditambahkan.');
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
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_register' => 'required',
            'jenis_operasi' => 'required',
        ]);

        try {
            $data = [
                'kode_register' => $validatedData['kode_register'],
                'hasil_gambar' => $validatedData['signatureData'],
                'jenis_operasi' => $validatedData['jenis_operasi'],
            ];

            $this->penandaanOperasiService->update($id, $data);
            return redirect('operasi/penandaan-operasi')->with('success', 'Penandaan Operasi berhasil di ubah.');
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
    public function destroy($id)
    {
        try {
            $this->penandaanOperasiService->delete($id);
            $feedback = 'success';
            $message = 'Data Berhasil Dihapus!';
        } catch (\Throwable $th) {
            $feedback = 'error';
            $message = 'Data Gagal dihapus';
        }
        return redirect()->back()->with($feedback, $message);
    }
}
