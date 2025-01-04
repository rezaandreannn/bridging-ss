<?php

namespace App\Http\Controllers\Ok\MasterData;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Operasi\BookingOperasiService;
use App\Models\Operasi\MasterData\TemplateOperasi;
use App\Services\Operasi\MasterData\TemplateOperasiService;
use App\Http\Requests\Operasi\MasterData\StoreTemplateOperasi;
use App\Http\Requests\Operasi\MasterData\UpdateTemplateOperasi;
use App\Models\Operasi\UseTemplateLaporanOperasi;
use App\Services\SimRs\DokterService;

class TemplateOperasiController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $templateOperasi;
    protected $templateOperasiService;


    public function __construct(TemplateOperasi $templateOperasi)
    {
        $this->templateOperasi = $templateOperasi;
        $this->templateOperasiService = new TemplateOperasiService;
        $this->view = 'pages.ok.';
        $this->prefix = 'Template';
    }

    public function getTemplateByID(Request $request)
    {
        $id = $request->input('macam_operasi');

        $templateOperasiID = $this->templateOperasiService->TemplateId($id);
        // dd($templateOperasiID);
        return response()->json([
            'data' => $templateOperasiID
        ]);
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Operasi';
        $data = $this->templateOperasi->all();
        // dd($data);
        return view($this->view . 'template-operasi.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = $this->prefix . ' ' . 'Input Data';

        return view($this->view . 'template-operasi.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemplateOperasi $request)
    {
        try {
            $data = [
                'macam_operasi' => $request->macam_operasi,
                'kode_dokter' => $request->kode_dokter,
                'laporan_operasi' => $request->laporan_operasi
            ];
            $this->templateOperasiService->insert($data);
            return redirect('ibs/doctor/' . $request->kode_dokter)->with('success', 'Template Operasi berhasil ditambahkan.');

            // return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan template operasi: ' . $e->getMessage());
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
    public function update(UpdateTemplateOperasi $request, $id)
    {
        try {
            $this->templateOperasiService->update($id, $request->validated());

            return redirect('ibs/doctor/' . $request->kode_dokter)->with('success', 'Template Operasi berhasil ditambahkan.');

            // return redirect()->route('ttd-ok.penandaan.index')->with('success', 'Tanda tangan berhasil ditambahkan.');
        } catch (Exception $e) {
            // Redirect dengan pesan error jika terjadi kegagalan
            return redirect()->back()->with('error', 'Gagal menambahkan template operasi: ' . $e->getMessage());
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
            $this->templateOperasiService->delete($id);

            return redirect()->back()->with('success', 'Template Operasi berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus template operasi: ' . $e->getMessage());
        }
    }


    public function toggle(Request $request, $kodeDokter)
    {
        $useTemplate = UseTemplateLaporanOperasi::updateOrCreate(
            ['kode_dokter' => $kodeDokter],
            ['use_template' => $request->input('use_template') === 'true']
        );

        // find dokter

        $dokter = new DokterService();
        $findDokter = $dokter->byCode($kodeDokter);

        $message = $useTemplate->use_template
            ? 'Template laporan operasi diaktifkan untuk dokter ' . $findDokter->Nama_Dokter
            : 'Template laporan operasi dinonaktifkan untuk dokter ' . $findDokter->Nama_Dokter;

        return redirect()->back()->with('success', $message);
    }
}
