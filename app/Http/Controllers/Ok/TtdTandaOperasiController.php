<?php

namespace App\Http\Controllers\OK;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operasi\PenandaanPasien\Ttd\StoreTtdTandaPasien;
use App\Models\Operasi\TtdTandaOperasi;
use Illuminate\Support\Facades\Storage;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\TtdTandaOperasiService;

class TtdTandaOperasiController extends Controller
{
    protected $view;
    protected $prefix;
    protected $ttdTandaOperasi;
    protected $booking;
    protected $bookingOperasiService;
    protected $ttdTandaOperasiService;

    public function __construct(TtdTandaOperasi $ttdTandaOperasi)
    {
        $this->view = 'pages.ok.';
        $this->prefix = 'Tanda Tangan';
        $this->ttdTandaOperasi = $ttdTandaOperasi;
        $this->bookingOperasiService = new BookingOperasiService();
        $this->ttdTandaOperasiService = new TtdTandaOperasiService();
    }

    public function index()
    {
        //
        $title = 'Ttd Penandaan Operasi';
        // $ttdpenandaanpasien = $this->ttdTandaOperasiService->byDate(date('Y-m-d'));
        $ttdpenandaanpasien = $this->ttdTandaOperasiService->get();
        $bookings = $this->bookingOperasiService->get();
        // dd($ttdpenandaanpasien);
        return view($this->view . 'tanda-tangan.index', compact('ttdpenandaanpasien', 'bookings'))->with([
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $title = 'Add Ttd Penandaan Operasi';
        $biodata = $this->bookingOperasiService->biodata($request->input('kode_register'));

        return view($this->view . 'tanda-tangan.create', compact('biodata'))->with([
            'title' => $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTtdTandaPasien $request)
    {


        try {


            $this->ttdTandaOperasiService->insert($request->validated());
            return redirect('operasi/penandaan-operasi')->with('success', 'Tanda tangan berhasil ditambahkan.');

            // return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan tanda tangan: ' . $e->getMessage());
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
        $title = 'Add Ttd Penandaan Operasi';
        $ttdpenandaanpasien = $this->ttdTandaOperasiService->findById($id);

        // dd($ttdpenandaanpasien);

        return view($this->view . 'tanda-tangan.edit', compact('ttdpenandaanpasien'))->with([
            'title' => $title,
            'biodata' => $this->bookingOperasiService->biodata($ttdpenandaanpasien->kode_register)
        ]);
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

        if ($request->pasien == 1) {
            $nama = $request->nama_keluarga;
        }

        try {

            $data = [
                'kode_register' => $request->kode_register,
                'nama_pasien' => $nama ?? $request->nama_pasien,
                'ttd_pasien' => $request->signed,
                'updated_at' => date('Y-m-d H:i:s')

            ];

            $this->ttdTandaOperasiService->update($id, $data);

            return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil diperbarui.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan tanda tangan: ' . $e->getMessage());
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

            $this->ttdTandaOperasiService->delete($id);

            return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil dihapus.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menghapus tanda tangan: ' . $e->getMessage());
        }
    }
}
