<?php

namespace App\Http\Controllers;

use App\Models\Fisioterapi;
use GuzzleHttp\Client;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TandaTanganController extends Controller
{
    protected $ttd;
    protected $prefix;
    protected $routeIndex;
    protected $viewPath;
    protected $httpClient;
    protected $simrsUrlApi;
    protected $fisio;

    public function __construct(TandaTangan $ttd)
    {
        $this->ttd = $ttd;
        $this->fisio = new Fisioterapi;
        $this->viewPath = 'pages.ttd.';
        $this->prefix = 'ttd';
        $this->routeIndex = 'ttd.index';
        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Index Tanda Tangan Petugas';
        $ttdPasien = $this->ttd->tandaTanganGet();
        return view($this->viewPath . 'index', compact('title', 'ttdPasien'));
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

    public function ttdPasien(Request $request, $id)
    {
        $title = $this->prefix . ' Tambah CPPT';
        $cppt = $this->fisio->getDataTransaksiByID($id);

        return view($this->viewPath . 'ttdPasien', compact('title', 'cppt'));
    }

    public function ttdPasienStore(Request $request)
    {
        $data = DB::connection('pku')->table('TTD_PASIEN_MASTER')->insert([

            'ID_TTD_PASIEN' => $request->input('ID_TTD_PASIEN'),
            'NO_MR_PASIEN' => $request->input('NO_MR_PASIEN'),
            'CREATE_AT' => $request->input('CREATE_AT'),
            'IMAGE' => $request->input('IMAGE'),
        ]);
    }

    public function store(Request $request)
    {
        if (!$request->has('signed') || empty($request->signed)) {
            return redirect()->back()->with('warning', 'Tanda tangan harus diisi');
        } else {
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file_name = auth()->user()->name . '-' . date('Y-m-d') . '.' . $image_type;
            // Simpan gambar ke storage
            Storage::put('public/ttd/' . $file_name, $image_base64);

            $response = $this->httpClient->post($this->simrsUrlApi . 'fisioterapi/ttd/petugas', [
                'json' => [
                    'USERNAME' => auth()->user()->name,
                    'STATUS' => auth()->user()->role_id, // Pastikan Anda mengelola peran pengguna dengan benar di aplikasi Anda
                    'IMAGE' => $file_name,
                    'CREATE_AT' => now()
                ]
            ]);

            return redirect()->back()->with('success', 'Tanda tangan berhasil ditambahkan');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $title = 'Index Tanda Tangan Petugas';
        $ttdPetugasById = $this->ttd->tandaTanganGetById($id);

        return view($this->viewPath . 'edit', compact('title', 'ttdPetugasById'));
    }

    public function update(Request $request)
    {
        if (!$request->has('signed') || empty($request->signed)) {
            return redirect()->back()->with('warning', 'Tanda tangan harus diisi');
        } else {
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file_name = auth()->user()->name . '-' . date('Y-m-d') . '.' . $image_type;
            // Simpan gambar ke storage
            if ($file_name) {
                Storage::delete('public/ttd/' . $file_name);
            }
            Storage::put('public/ttd/' . $file_name, $image_base64);

            $response = $this->httpClient->put($this->simrsUrlApi . 'fisioterapi/ttd/petugas/update/' . $request->ID_TTD, [
                'json' => [
                    'USERNAME' => auth()->user()->name,
                    'STATUS' => auth()->user()->role_id, // Pastikan Anda mengelola peran pengguna dengan benar di aplikasi Anda
                    'IMAGE' => $file_name,
                    'CREATE_AT'  => now()
                ]
            ]);

            return redirect()->route('list-ttd.index')->with('success', 'Tanda tangan berhasil ditambahkan');
        }
    }

    public function delete($id_ttd)
    {

        $ttdPetugasById = $this->ttd->tandaTanganGetById($id_ttd);
        $namaTtd = $ttdPetugasById['IMAGE'];

        if ($namaTtd) {
            Storage::delete('public/images/' . $namaTtd);
        }
        $response = $this->httpClient->delete($this->simrsUrlApi . 'fisioterapi/ttd/petugas/delete/' . $id_ttd);

        return redirect()->back()->with('success', 'Tanda Tangan Berhasil Dihapus!');
    }
}
