<?php

namespace App\Http\Controllers\OK;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\PenandaanOperasi;
use App\Models\Rajal;
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

    public function index(Request $request)
    {
        $title = 'Penandaan Operasi';

        $penandaans = $this->penandaanOperasiService->get();


        return view($this->view . 'penandaan-operasi.index', compact('penandaans'))
            ->with([
                'title' => $title
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

            return redirect()->back()->with('success', 'Penandaan Operasi berhasil ditambahkan.');
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
            'kode_register' => 'required|string|max:255',
            'signatureData' => 'required|string',
            'jenis_operasi' => 'required|string|max:255',
        ]);

        try {
            $data = [
                'kode_register' => $validatedData['kode_register'],
                'hasil_gambar' => $validatedData['signatureData'],
                'jenis_operasi' => $validatedData['jenis_operasi'],
            ];

            $this->penandaanOperasiService->update($id, $data);
            return redirect()->back()->with('success', 'Penandaan Operasi berhasil di ubah.');
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
        //
    }
}
