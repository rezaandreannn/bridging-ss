<?php

namespace App\Http\Controllers\Ok;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\BookingHelper;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Services\Operasi\DataUmum\PostOperasiService;
use App\Http\Requests\Operasi\PostOperasi\StorePostOperasiRequest;
use App\Http\Requests\Operasi\PostOperasi\UpdatePostOperasiRequest;
use App\Services\Operasi\LaporanOperasi\LaporanOperasiService;

class PostOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $bookingOperasiService;
    protected $postOperasiService;
    protected $laporanOperasiService;

    public function __construct()
    {
        $this->view = 'pages.ok.operasi.post-operasi.';
        $this->prefix = 'Post Operasi';
        $this->bookingOperasiService = new BookingOperasiService();
        $this->postOperasiService = new PostOperasiService();
        $this->laporanOperasiService = new LaporanOperasiService();
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'List';
        // $date = '2024-12-05';
        $date = date('Y-m-d');

        // get data from service
        $sessionBangsal = auth()->user()->userbangsal->kode_bangsal ?? null;
        $postOperasi = $this->bookingOperasiService->byDate($date, $sessionBangsal ?? '');

        $statusPost = BookingHelper::getStatusPostOperasi($postOperasi);

        $verifikasiPost = BookingHelper::getVerifikasiPostOperasi($postOperasi);

        // dd($verifikasiPost);

        return view($this->view . 'index', compact('postOperasi'))
            ->with([
                'title' => $title,
                'statusPost' => $statusPost,
                'verifikasiPost' => $verifikasiPost,
            ]);
    }

    public function create($kode_register)
    {
        // dd('ok');
        $title = $this->prefix . ' ' . 'Input Data';
        $laporanOperasi = $this->laporanOperasiService->laporanByRegister($kode_register);
        // dd($laporanOperasi);

        return view($this->view . 'create', compact('laporanOperasi'))
            ->with([
                'title' => $title,
                'biodata' => $this->bookingOperasiService->biodata($kode_register),
                'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
                'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
                'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
                'ahliAnastesiArray' => $this->laporanOperasiService->getAhliAnastesiArray($kode_register),
                'anastesiArray' => $this->laporanOperasiService->getAnastesiArray($kode_register),
                'asistenArray' => $this->laporanOperasiService->getAsistenArray($kode_register),


            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostOperasiRequest $request)
    {
        try {
            $this->postOperasiService->insert($request->validated());

            return redirect('/pre-post/post-operasi')->with('success', 'Post Operasi berhasil ditambahkan.');
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
        $postOperasi = $this->postOperasiService->findById($kode_register);
        // dd($postOperasi);

        return view($this->view . 'edit', compact('postOperasi'))->with([
            'title' => $this->prefix . ' ' . 'Edit Data',
            'biodata' => $this->bookingOperasiService->biodata($kode_register),
            'asistenOperasi' => $this->laporanOperasiService->getAsistenOperasi(),
            'spesialisAnastesi' => $this->laporanOperasiService->getSpesialisAnastesi(),
            'penataAnastesi' => $this->laporanOperasiService->getPenataAsisten(),
            'ahliAnastesiArray' => $this->laporanOperasiService->getAhliAnastesiPostOpArray($kode_register),
            'anastesiArray' => $this->laporanOperasiService->getAnastesiPostOpArray($kode_register),
            'asistenArray' => $this->laporanOperasiService->getAsistenPostOpArray($kode_register),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostOperasiRequest $request, $kode_register)
    {
        try {
            $this->postOperasiService->update($kode_register, $request->validated());

            return redirect('/pre-post/post-operasi')->with('success', 'Data Post Operasi berhasil di ubah.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal merubah post operasi: ' . $e->getMessage());
        }
    }

    public function VerifikasiPostOp($kode_register)
    {
        // dd($kode_register);
        try {
            $this->postOperasiService->insertVerifPostOp($kode_register);

            return redirect('/pre-post/post-operasi')->with('success', 'Verifikasi Pre Operasi berhasil.');
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
