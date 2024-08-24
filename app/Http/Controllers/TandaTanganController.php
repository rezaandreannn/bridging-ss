<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\Fisioterapi;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
    protected $pasien;
    protected $fisio;

    public function __construct(TandaTangan $ttd)
    {
        $this->ttd = $ttd;
        $this->fisio = new Fisioterapi;
        $this->pasien = new Pasien;
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


    // ------------------------------- 
    //      Tanda Tangan Pasien
    // -------------------------------

    public function ttdPasienDetail()
    {
        $title = 'Index Tanda Tangan Pasien';
        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $ttdDetail =  DB::connection('pku')->table('TTD_PASIEN_MASTER as tpm')
        ->join($db_rsmm.'.dbo.REGISTER_PASIEN as rp', 'rp.No_MR', '=', 'tpm.NO_MR_PASIEN')
        ->join($db_rsmm.'.dbo.PENDAFTARAN as p', 'tpm.NO_MR_PASIEN', '=', 'p.No_MR')
        ->whereDate('tpm.CREATE_AT',date('Y-m-d'))
        ->where('p.Tanggal',date('Y-m-d'))->get();
        // dd($ttdDetail);
        return view($this->viewPath . 'detailPasien', compact('title', 'ttdDetail'));
    }

    public function ttdPasienBypetugas()
    {
        $title = 'Index Tanda Tangan Pasien';
        $listPasien = $this->ttd->ttdPasienMaster();
        // dd($listPasien);
        return view($this->viewPath . 'ttdPasienByPetugas', compact('title','listPasien'));
    }

    public function ttdPasien(Request $request, $id)
    {
        $title = $this->prefix . ' Tambah CPPT';
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TRANSAKSI_FISIOTERAPI.NO_MR_PASIEN', $id)
            ->first();
        return view($this->viewPath . 'ttdPasien', compact('title', 'biodatas', 'data'));
    }


    public function ttdPasien2(Request $request, $No_Mr, $kode_dokter)
    {
        $title = $this->prefix . ' Tambah CPPT';
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TRANSAKSI_FISIOTERAPI.NO_MR_PASIEN', $No_Mr)
            ->first();

        return view($this->viewPath . 'ttdPasien2', compact('title', 'biodatas', 'data', 'kode_dokter', 'No_Mr'));
    }

    // public function ttdPasienStore(Request $request)
    // {
    //     if (!$request->has('signed') || empty($request->signed)) {
    //         return redirect()->back()->with('warning', 'Tanda tangan harus diisi');
    //     } else {
    //         $image_parts = explode(";base64,", $request->signed);
    //         $image_type_aux = explode("image/", $image_parts[0]);
    //         $image_type = $image_type_aux[1];
    //         $image_base64 = base64_decode($image_parts[1]);

    //         // Use uniqid to generate a unique file name
    //         $file_name = uniqid($request->input('NO_MR_PASIEN') . '-' . date('Y-m-d') . '-') . '.' . $image_type;

    //         // Save the image to storage
    //         Storage::put('public/ttd/' . $file_name, $image_base64);

    //         // Insert data into the database
    //         DB::connection('pku')->table('TTD_PASIEN_MASTER')->insert([
    //             'NO_MR_PASIEN' => $request->input('NO_MR_PASIEN'),
    //             'IMAGE' => $file_name,
    //             'CREATE_AT' => now()
    //         ]);
    //         if ((auth()->user()->roles->pluck('name')[0]) == 'dokter fisioterapi') {
    //             return redirect()->route('add.spkfr', ['NoMr' => $request->input('NO_MR_PASIEN')])->with('success', 'Tanda Tangan Berhasil Ditambahkan!');
    //         } else {
    //             return redirect()->route('cppt.detail', [
    //                 'id' => $request->input('ID_TRANSAKSI'),
    //                 'no_mr' => $request->input('NO_MR_PASIEN'),
    //                 'kode_transaksi' => $request->input('KODE_TRANSAKSI_FISIO')
    //             ])->with('success', 'Tanda Tangan Berhasil Ditambahkan!');
    //         }
    //         // Redirect with success message

    //     }
    // }

    public function ttdPasienStoreByPetugas(Request $request)
    {
        if (!$request->has('signed') || empty($request->signed)) {
            return redirect()->back()->with('warning', 'Tanda tangan harus diisi');
        } else {

            $No_MR = DB::connection('db_rsmm')
            ->table('PENDAFTARAN')
            ->select('No_MR')
            ->where('No_Reg', $request->input('NO_REG'))
            ->first();



            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            // Use uniqid to generate a unique file name
            $file_name = uniqid($request->input('NO_REG') . '-' . date('Y-m-d') . '-') . '.' . $image_type;

            // Save the image to storage
            Storage::put('public/ttd/' . $file_name, $image_base64);

            // Insert data into the database
            DB::connection('pku')->table('TTD_PASIEN_MASTER')->insert([
                'NO_MR_PASIEN' => $No_MR->No_MR,
                'IMAGE' => $file_name,
                'CREATE_AT' => now(),
                'NO_REGISTRASI' => $request->input('NO_REG')
            ]);
    
                return redirect()->route('ttd.pasien.bypetugas')->with('success', 'Tanda Tangan Berhasil Ditambahkan!');
       
            // Redirect with success message

        }
    }

    public function ttdPasienStore2(Request $request)
    {
        if (!$request->has('signed') || empty($request->signed)) {
            return redirect()->back()->with('warning', 'Tanda tangan harus diisi');
        } else {
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            // Use uniqid to generate a unique file name
            $file_name = uniqid($request->input('NO_MR_PASIEN') . '-' . date('Y-m-d') . '-') . '.' . $image_type;
            // Simpan gambar ke storage
            Storage::put('public/ttd/' . $file_name, $image_base64);

            $data = DB::connection('pku')->table('TTD_PASIEN_MASTER')->insert([
                'NO_MR_PASIEN' => $request->input('NO_MR_PASIEN'),
                'IMAGE' => $file_name,
                'CREATE_AT' => now()
            ]);

            // return redirect()->back()->with('success', 'Tanda Tangan Berhasil Ditambahkan!');
            return redirect('rj/rawat_jalan?kode_dokter=' . $request->input('KODE_DOKTER'))->with('success', 'Data Pasien Added successfully!');
            // return redirect()->route('transaksi_fisio.fisio')->with('success', 'Tanda Tangan Berhasil Ditambahkan!');
        }
    }

    public function deletePasien($id_ttd)
    {

        // Retrieve the record before deletion
        $data = DB::connection('pku')->table('TTD_PASIEN_MASTER')->where('ID_TTD_PASIEN', $id_ttd)->first();

        if ($data) {
            $namaTtd = $data->IMAGE;

            // Delete the record
            DB::connection('pku')->table('TTD_PASIEN_MASTER')->where('ID_TTD_PASIEN', $id_ttd)->delete();

            // Delete the image if it exists
            if ($namaTtd) {
                Storage::delete('public/ttd/' . $namaTtd);
            }

            return redirect()->back()->with('success', 'Tanda Tangan Berhasil Dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data not found.');
        }
    }

    // ------------------------------- 
    //      Tanda Tangan Petugas
    // -------------------------------

    public function index()
    {
        $title = 'Index Tanda Tangan Petugas';
        $ttdPetugas = $this->ttd->tandaTanganGet();
        return view($this->viewPath . 'index', compact('title', 'ttdPetugas'));
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

    public function store(Request $request)
    {
        if (!$request->has('signed') || empty($request->signed)) {
            return redirect()->back()->with('warning', 'Tanda tangan harus diisi');
        } else {
            $image_parts = explode(";base64,", $request->signed);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            // Use uniqid to generate a unique file name
            $file_name = uniqid(auth()->user()->username . '-' . date('Y-m-d') . '-') . '.' . $image_type;
            // Simpan gambar ke storage
            Storage::put('public/ttd/' . $file_name, $image_base64);

            $data = DB::connection('pku')->table('TTD_PETUGAS_MASTER')->insert([
                'USERNAME' => auth()->user()->username,
                'STATUS' => auth()->user()->role_id, // Pastikan Anda mengelola peran pengguna dengan benar di aplikasi Anda
                'IMAGE' => $file_name,
                'CREATE_AT' => now()
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
            $file_name = auth()->user()->username . '-' . date('Y-m-d') . '.' . $image_type;
            // Simpan gambar ke storage
            if ($file_name) {
                Storage::delete('public/ttd/' . $file_name);
            }
            Storage::put('public/ttd/' . $file_name, $image_base64);

            $data = DB::connection('pku')->table('TTD_PETUGAS_MASTER')->where('ID_TTD', $request->ID_TTD)->update([
                'USERNAME' => auth()->user()->username,
                'STATUS' => auth()->user()->role_id, // Pastikan Anda mengelola peran pengguna dengan benar di aplikasi Anda
                'IMAGE' => $file_name,
                'CREATE_AT'  => now()
            ]);

            return redirect()->route('list-ttd.index')->with('success', 'Tanda tangan berhasil ditambahkan');
        }
    }

    public function delete($id_ttd)
    {

        // Retrieve the record before deletion
        $data = DB::connection('pku')->table('TTD_PETUGAS_MASTER')->where('ID_TTD', $id_ttd)->first();

        if ($data) {
            $namaTtd = $data->IMAGE;

            // Delete the record
            DB::connection('pku')->table('TTD_PETUGAS_MASTER')->where('ID_TTD', $id_ttd)->delete();

            // Delete the image if it exists
            if ($namaTtd) {
                Storage::delete('public/ttd/' . $namaTtd);
            }

            return redirect()->back()->with('success', 'Tanda Tangan Berhasil Dihapus!');
        } else {
            return redirect()->back()->with('error', 'Data not found.');
        }
    }


    // -------------------------
    // -- TANDA TANGAN DOKTER --
    // -------------------------
    public function ttdDokter(Request $request)
    {
        $title = $this->prefix . ' Tambah CPPT';
        return view($this->viewPath . 'ttdDokter', compact('title'));
    }
}
