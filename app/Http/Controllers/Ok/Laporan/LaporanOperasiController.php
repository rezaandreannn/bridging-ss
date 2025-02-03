<?php

namespace App\Http\Controllers\Ok\Laporan;

use Exception;
use Carbon\Carbon;
use App\Models\Simrs\Dokter;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Operasi\LaporanOperasi;
use App\Helpers\Ok\LaporanOperasiHelper;
use App\Models\Operasi\OperatorAsistenDetail;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\PraBedah\AssesmenPraBedahService;
use App\Services\Operasi\LaporanOperasi\LaporanOperasiService;
use App\Http\Requests\Operasi\LaporanOperasi\StoreLaporanOperasi;
use App\Http\Requests\Operasi\LaporanOperasi\UpdateLaporanOperasi;
use App\Models\Operasi\MasterData\TemplateOperasi;

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

    public function cetak($kode_register)
    {
        $title = $this->prefix . ' ' . 'Operasi';
        // Ambil data berdasarkan ID

        $cetak = $this->laporanOperasiService->laporanByRegister($kode_register);
        $biodata = $this->bookingOperasiService->biodata($kode_register);
        // dd($biodata);

        // ambil data field assisten code
        $perawatByReg = OperatorAsistenDetail::where('kode_register', $kode_register)->first()->toArray();

        // Dokter Operator
        $operatorCodes = explode(', ', $perawatByReg["nama_operator"]);
        $operators =  $this->laporanOperasiService->getNameAssistenByCodes($operatorCodes);
        // Asisten Bedah
        $asistenCodes = explode(', ', $perawatByReg["nama_asisten"]);
        $assistens =  $this->laporanOperasiService->getNameAssistenByCodes($asistenCodes);
        // Perawat
        $perawatCode = explode(', ', $perawatByReg["nama_perawat"]);
        $perawats =  $this->laporanOperasiService->getNameAssistenByCodes($perawatCode);
        // Dokter Anastesi
        $dokterCodes = explode(', ', $perawatByReg["nama_ahli_anastesi"]);
        $dokters =  $this->laporanOperasiService->getNameAssistenByCodes($dokterCodes);
        // Perawat Anastesi
        $anastesiCodes = explode(', ', $perawatByReg["nama_anastesi"]);
        $anastesis =  $this->laporanOperasiService->getNameAssistenByCodes($anastesiCodes);


        // dd($assistenNames);
        $date = date('dMY');
        $tanggal = Carbon::now();
        $filename = 'LaporanOperasi-' . $date;

        $pdf = PDF::loadview('pages.ok.laporan-operasi.cetak-laporan', [
            'cetak' => $cetak,
            'title' => $title,
            'tanggal' => $tanggal,
            'biodata' => $biodata,
            'operators' => $operators,
            'assistens' => $assistens,
            'perawats' => $perawats,
            'dokters' => $dokters,
            'anastesis' => $anastesis,
        ]);

        // Set paper size to A5
        $pdf->setPaper('A4');
        return $pdf->stream($filename . '.pdf');
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');
        if ($request->input('tanggal') != null) {
            $date = $request->input('tanggal');
        }

        $sessionKodeDokter = auth()->user()->username ?? null;
        // dd($sessionKodeDokter);
        $laporans = $this->bookingOperasiService->byDokterOrAdmin($date, $sessionKodeDokter ?? '');
        $statusLaporanOperasi = LaporanOperasiHelper::getStatusLaporanOperasi($laporans);

        // dd($statusLaporanOperasi);

        return view($this->view . 'index', compact('laporans'))
            ->with([
                'title' => $title,
                'statusLaporanOperasi' => $statusLaporanOperasi
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

        // ambil data template aktif berdasarkan user login name
        $codeDoctor = auth()->user()->username ?? null;

        $templateLaporan = TemplateOperasi::where('kode_dokter', $codeDoctor)->get();


        // dd($this->bookingOperasiService->findByRegister($kode_register));

        return view($this->view . 'create', compact('biodata'))->with([
            'title' => $this->prefix . ' ' . 'Input Data',
            'bookingByRegister' => $this->bookingOperasiService->findByRegister($kode_register),
            'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
            'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
            'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
            'templates' => $templateLaporan
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
            // return redirect('laporan/operasi')->with('success', 'Laporan operasi berhasil ditambahkan.');
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
    public function edit($kode_register)
    {
        //
        // dd($this->laporanOperasiService->getAsistenArray($kode_register));

        $laporanOperasi = $this->laporanOperasiService->laporanByRegister($kode_register);


        // ambil data template aktif berdasarkan user login name
        $codeDoctor = auth()->user()->username ?? null;

        $templateLaporan = TemplateOperasi::where('kode_dokter', $codeDoctor)->get();


        return view($this->view . 'edit', compact('laporanOperasi'))->with([
            'title' => $this->prefix . ' ' . 'Edit Data',
            'bookingByRegister' => $this->bookingOperasiService->findByRegister($kode_register),
            'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
            'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
            'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
            'biodata' => $this->bookingOperasiService->biodata($kode_register),
            'perawatArray' => $this->laporanOperasiService->getPerawatArray($kode_register),
            'ahliAnastesiArray' => $this->laporanOperasiService->getAhliAnastesiArray($kode_register),
            'anastesiArray' => $this->laporanOperasiService->getAnastesiArray($kode_register),
            'asistenArray' => $this->laporanOperasiService->getAsistenArray($kode_register),
            'templates' => $templateLaporan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLaporanOperasi $request, $id)
    {
        //
        try {
            $this->laporanOperasiService->update($id, $request->validated());

            return redirect()->back()->with('success', 'Laporan operasi berhasil diperbarui.');
            // return redirect('laporan/operasi')->with('success', 'Laporan operasi berhasil diperbarui.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal memperbarui laporan operasi: ' . $e->getMessage());
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
        try {
            $this->laporanOperasiService->delete($id);

            return redirect()->back()->with('success', 'Laporan operasi berhasil dihapus.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menghapus laporan operasi: ' . $e->getMessage());
        }
    }
}
