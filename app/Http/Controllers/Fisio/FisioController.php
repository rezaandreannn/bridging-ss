<?php

namespace App\Http\Controllers\Fisio;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use GuzzleHttp\Client;
use App\Models\JenisFisio;
use App\Models\Fisioterapi;
use App\Models\TandaTangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BerkasFisioterapi;
use App\Rules\UniqueInConnection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FisioController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $fisio;
    protected $pasien;
    protected $jenisFisio;
    protected $ttd;
    protected $rajal;
    protected $httpClient;
    protected $berkasFisio;
    protected $simrsUrlApi;

    public function __construct(Fisioterapi $fisio)
    {

        $this->rajal = new Rajal();
        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;
        $this->jenisFisio = new JenisFisio;
        $this->berkasFisio = new BerkasFisioterapi();
        $this->ttd = new TandaTangan;


        $this->httpClient = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $this->simrsUrlApi = env('SIMRS_BASE_URL');
    }

    // LIST DAFTAR PASIEN FISIOTERAPI
    public function index(Request $request)
    {

        $fisioterapi = new Fisioterapi();
        $rajalModel = new Rajal();
        $kode_dokter = $request->input('kode_dokter');
        $dokters = $this->fisio->getDokterFisio();
        $listpasien = $this->fisio->pasienCpptdanFisioterapi($kode_dokter);
        // dd($listpasien);
        $title = $this->prefix . ' ' . 'CPPT Index';
        return view($this->view . 'listPasienCpptFisio', compact('title', 'listpasien', 'dokters','fisioterapi','rajalModel'));
    }

    // Detail Pasien Transaksi Fisioterapi
    public function transaksi(Request $request)
    {

        $fisioModel = new Fisioterapi();
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        // dd($biodatas);
        // die;
        $transaksis = $this->fisio->transaksiFisioByMr($request->no_mr);
        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'transaksiFisio', compact('title', 'biodatas', 'transaksis', 'fisioModel'));
    }

    // Proses Tambah Data Transaksi Fisioterapi
    public function store(Request $request)
    {



        $lastKodeTransaksi = DB::connection('pku')
            ->table('TRANSAKSI_FISIOTERAPI')
            ->orderBy('ID_TRANSAKSI', 'DESC')
            ->limit('1')
            ->first();

        $kode = 'F';
        if (!$lastKodeTransaksi) {
            $nomorUrut = "000001";
        } else {
            $noTerakhir = (int)substr($lastKodeTransaksi->KODE_TRANSAKSI_FISIO, 2);
            $noTerakhir += 1;
            $nomorUrut = sprintf('%06s', $noTerakhir);
        }

        $kode_transaksi = $kode . '-' . $nomorUrut;

        $validatedData = $request->validate([
            'NO_MR_PASIEN' => 'required',
            'JUMLAH_TOTAL_FISIO' => 'required|numeric',
        ]);

        $no_mr_pasien = $request->input('NO_MR_PASIEN');
        $jumlah_total_fisio = $request->input('JUMLAH_TOTAL_FISIO');

        if ($jumlah_total_fisio < 0) {
            return redirect()->back()->with('warning', 'Inputan tidak Kosong !!');
        }

        if ($jumlah_total_fisio > 8) {
            return redirect()->back()->with('warning', 'Pastikan jumlah maksimal fisioterapi adalah 8 kali !!');
        }

        $data = DB::connection('pku')->table('TRANSAKSI_FISIOTERAPI')->insert([
            'KODE_TRANSAKSI_FISIO' => $kode_transaksi,
            'NO_MR_PASIEN' => $no_mr_pasien,
            'JUMLAH_TOTAL_FISIO' => $jumlah_total_fisio,
            'CREATE_AT' => now(),
            'CREATE_BY' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Transaksi Berhasil Ditambahkan!');
    }
    // Proses Tambah Data Transaksi Fisioterapi
    public function storeTindakan(Request $request)
    {


        $data = DB::connection('pku')->table('fis_status_terapi')->insert([
            'no_registrasi' => $request->no_reg,
            'created_by' => auth()->user()->id,
            'created_at' => now(),
            'updated_at' => now(),
          
        ]);

        return redirect()->back()->with('success', 'Terapi Telah Dilakukan!');
    }

    // Update Data Transaksi Fisioterapi
    public function update(Request $request, $id_transaksi)
    {
        $validatedData = $request->validate([
            'NO_MR_PASIEN' => 'required',
            'JUMLAH_TOTAL_FISIO' => 'required|numeric',
        ]);

        if ($request->input('JUMLAH_TOTAL_FISIO') < 0) {
            return redirect()->back()->with('warning', 'Inputan tidak boleh Minus !!');
        }
        if ($request->input('JUMLAH_TOTAL_FISIO') > 8) {
            return redirect()->back()->with('warning', 'Pastikan jumlah maksimal fisioterapi adalah 8 kali');
        }

        $data = DB::connection('pku')->table('TRANSAKSI_FISIOTERAPI')->where('ID_TRANSAKSI', $id_transaksi)->update([
            'KODE_TRANSAKSI_FISIO' => $request->input('KODE_TRANSAKSI_FISIO'),
            'NO_MR_PASIEN' => $request->input('NO_MR_PASIEN'),
            'JUMLAH_TOTAL_FISIO' => $request->input('JUMLAH_TOTAL_FISIO'),
        ]);

        return redirect()->back()->with('success', 'Transaksi Berhasil Diperbarui!');
    }



    // Delete Data Transaksi Fisioterapi
    public function delete($id_transaksi)
    {
        $data = DB::connection('pku')->table('TRANSAKSI_FISIOTERAPI')->where('ID_TRANSAKSI', $id_transaksi)->delete();
        return redirect()->back()->with('success', 'Transaksi Berhasil Dihapus!');
    }



    // ------------------------------------------//
    // ----- Data Pasien CPPT Fisioterapi ----- //

    // Tambah Data CPPT Pasien Fisioterapi
    public function detail_cppt(Request $request, $id)
    {

        //    dd($request->kode_transaksi);
        $title = $this->prefix . ' Tambah CPPT';

        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        // dd($biodatas);
        $terapiFisioGet = DB::connection('pku')->table('fis_tr_jenis')->where('kode_tr_fisio', $request->kode_transaksi)->get();
        $asesmen_perawat = DB::connection('pku')->table('TAC_ASES_PER2')->where('FS_KD_REG', $biodatas->No_Reg)->first();
        $asesmenDokterFisio = $this->fisio->getAsesmenDokterByNoreg($biodatas->No_Reg);
        $terapiDokterLastFisio =  $this->fisio->terapiDokterLastFisio($biodatas->NO_MR);
        // dd($terapiDokterLastFisio);
        $transaksiFisio = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_TRANSAKSI_FISIO', $id)->orderBy('ID_CPPT_FISIO', 'ASC')->first();
        $ttv = DB::connection('pku')->table('TAC_RJ_VITAL_SIGN')->where('FS_KD_REG', $biodatas->No_Reg)->first();

        $cektransaksicppt = false;
        if ($transaksiFisio) {
            $cektransaksicppt = true;
        }

        $cekasesmenperawat = false;
        if ($asesmen_perawat) {
            $cekasesmenperawat = true;
        }


        $cekasesmenDokter = false;
        if ($asesmenDokterFisio) {
            $cekasesmenDokter = true;
        }


        $cekttv = false;
        if ($ttv != null) {
            $cekttv = true;
        }

        // dd($cekasesmenperawat);

        $data = $this->fisio->cpptGet($id);

        $cppt =  DB::connection('pku')->table('TRANSAKSI_FISIOTERAPI')->where('ID_TRANSAKSI', $id)->first();
        $jenisfisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
        return view($this->view . 'cppt.detail', compact('title', 'biodatas', 'data', 'cppt', 'jenisfisio', 'terapiFisioGet', 'ttv', 'cekttv', 'asesmen_perawat', 'cekasesmenperawat', 'asesmenDokterFisio', 'cekasesmenDokter', 'transaksiFisio', 'cektransaksicppt', 'terapiDokterLastFisio'));
    }

    // public function tambah_cppt(Request $request, $id)
    // {
    //     $title = $this->prefix . ' Tambah CPPT';
    //     $jenisfisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
    //     $data = $this->fisio->getDataTransaksiByID($id);
    //     return view($this->view . 'cppt.tambah', compact('title', 'data', 'jenisfisio'));
    // }

    //Proses Tambah Data CPPT Fisioterapi
    public function tambahDataCPPT(Request $request)
    {
        $cekJumlahFisio = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_TRANSAKSI_FISIO', $request->input('ID_TRANSAKSI'))->count();

        $transaksisById = DB::connection('pku')->table('TRANSAKSI_FISIOTERAPI')->where('ID_TRANSAKSI', $request->input('ID_TRANSAKSI'))->get()->first();
        $jumlahMaxFisio = $transaksisById->JUMLAH_TOTAL_FISIO;

        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
            'no_registrasi' => ['required', new UniqueInConnection('TR_CPPT_FISIOTERAPI', 'no_registrasi', 'pku')],
            'LAINNYA' => 'max:255',
        ]);

        if ($cekJumlahFisio >= $jumlahMaxFisio) {

            return redirect()->back()->with('error', 'Data CPPT Tidak Melebihi batas yang telah ditentukan!');
        } else {
            $jenis_terapi = $request->input('JENIS_FISIO');
            $terapi = '';
            if (!empty($jenis_terapi)) {
                foreach ($jenis_terapi as  $value) {
                    $terapi = $value . ', ' . $terapi;
                }
            }

            $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->insert([

                'ID_TRANSAKSI_FISIO' => $request->input('ID_TRANSAKSI'),
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'JENIS_FISIO' => $terapi,
                'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                'JAM_FISIO' => $request->input('JAM_FISIO'),
                'KODE_DOKTER' => $request->input('KODE_DOKTER') ?? '028',
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'LAINNYA' => $request->input('LAINNYA'),
                'no_registrasi' => $request->input('no_registrasi'),
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->id,
            ]);

            $cek_ttd_pasien =  DB::connection('pku')->table('TTD_PASIEN_MASTER')->where('NO_MR_PASIEN', $request->input('NO_MR_PASIEN'))->count();

            // if ($cek_ttd_pasien < '1') {
            //     return redirect()->route('ttd.pasien', ['no_mr' => $request->input('NO_MR_PASIEN')]);
            // } else {

            if ((auth()->user()->roles->pluck('name')[0]) == 'dokter fisioterapi') {
                return redirect()->route('list_pasiens.dokter')->with('success', 'CPPT Berhasil Ditambahkan!');
            } else {
                return redirect()->route('cppt.detail', ['id' => $request->input('ID_TRANSAKSI'), 'kode_transaksi' => $request->input('KODE_TRANSAKSI_FISIO'), 'no_mr' => $request->input('NO_MR_PASIEN')])->with('success', 'CPPT Berhasil Ditambahkan!');
            }

            // return redirect()->route('cppt.detail', ['no_mr' => $request->input('NO_MR'), 'kode_transaksi' => $request->input('KD_TRANSAKSI_FISIO')])->with('success', 'CPPT Berhasil Diperbarui!');
            // }
        }
    }

    // Edit Data CPPT Fisioterapi
    public function edit_cppt($id)
    {
        // Memecah string menjadi array
        $getTransaksiCppt =  DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id)->first();
        // dd($getTransaksiCppt);

        $biodata = $this->rajal->pasien_bynoreg($getTransaksiCppt->no_registrasi);
        // dd($biodata);

        $data = array();
        $string = $getTransaksiCppt->JENIS_FISIO;
        $string = trim($string, ','); // Menghapus koma di awal dan akhir string (jika ada)
        $jenis_fisio = array();
        if (!empty($string)) {
            $jenis_fisio = explode(', ', $string);
        }
        $title = $this->prefix . ' ' . 'CPPT';

        $jenisfisio = $this->jenisFisio->getDataJenisFisio();
        $data = $this->fisio->dataEditPasienCPPT($id);
        $terapiDokterLastFisio =  $this->fisio->terapiDokterLastFisio($biodata->NO_MR);
        // dd($terapiDokterLastFisio);

        return view($this->view . 'cppt.edit', compact('title', 'data', 'jenisfisio', 'jenis_fisio','biodata','terapiDokterLastFisio'));
    }

    // Edit Data Riwaya CPPT  Fisioterapi
    public function edit_cppt_riwayat($id)
    {
        // Memecah string menjadi array
        $getTransaksiCppt =  DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id)->first();
        // dd($getTransaksiCppt);

        $biodata = $this->rajal->pasien_bynoreg($getTransaksiCppt->no_registrasi);
        // dd($biodata);

        $data = array();
        $string = $getTransaksiCppt->JENIS_FISIO;
        $string = trim($string, ','); // Menghapus koma di awal dan akhir string (jika ada)
        $jenis_fisio = array();
        if (!empty($string)) {
            $jenis_fisio = explode(', ', $string);
        }
        $title = $this->prefix . ' ' . 'CPPT';


        $jenisfisio = $this->jenisFisio->getDataJenisFisio();
        $data = $this->fisio->dataEditPasienCPPT($id);
        $terapiDokterLastFisio =  $this->fisio->terapiDokterLastFisio($biodata->NO_MR);
        // dd($terapiDokterLastFisio);

        return view($this->view . 'cppt.editRiwayat', compact('title', 'data', 'jenisfisio', 'jenis_fisio','biodata','terapiDokterLastFisio'));
    }

    // Proses Edit Data CPPT Fisioterapi
    public function editDataCPPT(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
            'LAINNYA' => 'max:255',
        ]);


        $jenis_terapi = $request->input('JENIS_FISIO');
        $terapi = '';
        if (!empty($jenis_terapi)) {
            foreach ($jenis_terapi as  $value) {
                $terapi = $value . ', ' . $terapi;
            }
        }

        if($request->input('Kode_Dokter')=='028'){
            $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id)->update([
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'JENIS_FISIO' => $terapi,
                'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                'JAM_FISIO' => $request->input('JAM_FISIO'),
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'LAINNYA' => $request->input('LAINNYA'),
                'CREATE_AT' => now(),
                'CREATE_BY' => auth()->user()->id
    
            ]);
        }
        else {

            $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id)->update([
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'JENIS_FISIO' => $terapi,
                'TANGGAL_FISIO' => $request->input('TANGGAL_FISIO'),
                'JAM_FISIO' => $request->input('JAM_FISIO'),
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'LAINNYA' => $request->input('LAINNYA'),
                'CREATE_AT' => now(),
    
            ]);
        }

       

        if ((auth()->user()->roles->pluck('name')[0]) == 'dokter fisioterapi') {
            return redirect()->route('list_pasiens.dokter')->with('success', 'Lembar Cppt Berhasil Diperbarui!');
        } else {
            return redirect()->route('cppt.detail', ['id' => $request->input('ID_TRANSAKSI'), 'kode_transaksi' => $request->input('KODE_TRANSAKSI_FISIO'), 'no_mr' => $request->input('NO_MR_PASIEN')])->with('success', 'CPPT Berhasil Diperbarui!');
        }
    }
    // Proses Edit Data Riwayat CPPT Fisioterapi
    public function editDataRiwayatCPPT(Request $request, $id)
    {
        $validatedData = $request->validate([
            'ANAMNESA' => 'required',
            'LAINNYA' => 'max:255',
        ]);


        $jenis_terapi = $request->input('JENIS_FISIO');
        $terapi = '';
        if (!empty($jenis_terapi)) {
            foreach ($jenis_terapi as  $value) {
                $terapi = $value . ', ' . $terapi;
            }
        }

            $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id)->update([
                'DIAGNOSA' => $request->input('DIAGNOSA'),
                'TEKANAN_DARAH' => $request->input('TEKANAN_DARAH'),
                'NADI' => $request->input('NADI'),
                'SUHU' => $request->input('SUHU'),
                'JENIS_FISIO' => $terapi,
                'CARA_PULANG' => $request->input('CARA_PULANG'),
                'ANAMNESA' => $request->input('ANAMNESA'),
                'LAINNYA' => $request->input('LAINNYA'),
    
            ]);

        if ((auth()->user()->roles->pluck('name')[0]) == 'dokter fisioterapi') {
            return redirect()->route('list_pasiens.dokter')->with('success', 'Lembar Cppt Berhasil Diperbarui!');
        } else {
            return redirect()->route('cppt.detail', ['id' => $request->input('ID_TRANSAKSI'), 'kode_transaksi' => $request->input('KODE_TRANSAKSI_FISIO'), 'no_mr' => $request->input('NO_MR_PASIEN')])->with('success', 'CPPT Berhasil Diperbarui!');
        }
    }

    // Delete Data CPPT Fisioterapi
    public function deleteDataCPPT($id_cppt)
    {
        $data = DB::connection('pku')->table('TR_CPPT_FISIOTERAPI')->where('ID_CPPT_FISIO', $id_cppt)->delete();
        return redirect()->back()->with('success', 'CPPT Berhasil Dihapus!');
    }


    // Cetak CPPT Perawat
    public function cetak_cppt(Request $request, $kode_transaksi_fisio)
    {

        $title = $this->prefix . ' ' . 'Cetak CPPT';

        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TRANSAKSI_FISIOTERAPI.KODE_TRANSAKSI_FISIO', '=', $kode_transaksi_fisio)
            ->orderBy('TR_CPPT_FISIOTERAPI.ID_CPPT_FISIO', 'ASC')
            ->get();




        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $date = date('dMY');
        $filename = $request->no_mr . '-CPPT-' . $date;

        $pdf = PDF::loadview($this->view . 'cetak/cppt', ['title' => $title, 'data' => $data, 'biodatas' => $biodatas]);
        return $pdf->stream($filename . '.pdf');
    }

    // Cetak CPPT Perawat
    public function cetak_cppt_riwayat(Request $request, $no_reg)
    {
        $title = $this->prefix . ' ' . 'Cetak CPPT';

        $kode_transaksi_fisio = $this->fisio->cek_kode_transaksi_fisio($no_reg);
        if($kode_transaksi_fisio == null){
            return redirect()->back()->with('warning', 'data rekam medis belum di inputkan di EMR!');
        }
        // dd($kode_transaksi_fisio);
        $kode_transaksi = $kode_transaksi_fisio->KODE_TRANSAKSI_FISIO;

        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->join('TRANSAKSI_FISIOTERAPI', 'TR_CPPT_FISIOTERAPI.ID_TRANSAKSI_FISIO', '=', 'TRANSAKSI_FISIOTERAPI.ID_TRANSAKSI')
            ->where('TRANSAKSI_FISIOTERAPI.KODE_TRANSAKSI_FISIO', '=', $kode_transaksi)
            ->orderBy('TR_CPPT_FISIOTERAPI.ID_CPPT_FISIO', 'ASC')
            ->get();




        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $date = date('dMY');
        $filename = $request->no_mr . '-CPPT-' . $date;

        $pdf = PDF::loadview($this->view . 'cetak/cppt', ['title' => $title, 'data' => $data, 'biodatas' => $biodatas]);
        return $pdf->stream($filename . '.pdf');
    }

    // Cetak Bukti Layanan Perawat
    public function bukti_layanan(Request $request, $id)
    {

        $title = $this->prefix . ' ' . 'Bukti Layanan CPPT';
        $db_emr_new = DB::connection('sqlsrv')->getDatabaseName();
        $data = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI as a')
            ->join('TRANSAKSI_FISIOTERAPI as tf', 'a.ID_TRANSAKSI_FISIO', '=', 'tf.ID_TRANSAKSI')
            ->leftJoin('TTD_PASIEN_MASTER as b', 'a.no_registrasi', '=', 'b.NO_REGISTRASI')
            ->leftJoin($db_emr_new . '.dbo.users as u', 'a.create_by', '=', 'u.id')
            ->leftJoin('TTD_PETUGAS_MASTER as tpm', 'u.username', '=', 'tpm.USERNAME')
            ->select(
                'a.*',
                'b.IMAGE as ttd_pasien',
                'tpm.IMAGE AS ttd_petugas',
                'u.name'
            )
            ->where('tf.KODE_TRANSAKSI_FISIO', '=', $id)
            ->orderBy('a.ID_CPPT_FISIO', 'ASC')
            ->get();

            $row = 8;
            $row = $row - $data->count();

            // dd($data);

        $lastCppt = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI')
            ->orderBy('ID_CPPT_FISIO', 'DESC')
            ->limit('1')
            ->first();

        $db_rsmm = DB::connection('db_rsmm')->getDatabaseName();
        $emr_rsumm = DB::connection('sqlsrv')->getDatabaseName();
        $firstCppt = DB::connection('pku')
            ->table('TR_CPPT_FISIOTERAPI as TC')
            ->join('TRANSAKSI_FISIOTERAPI as tf', 'TC.ID_TRANSAKSI_FISIO', '=', 'tf.ID_TRANSAKSI')
            ->leftJoin($db_rsmm . '.dbo.DOKTER as D', 'TC.KODE_DOKTER', '=', 'D.Kode_Dokter')
            ->leftJoin('TTD_PETUGAS_MASTER as tpm', 'D.Kode_Dokter', '=', 'tpm.USERNAME')
            ->leftJoin($emr_rsumm . '.dbo.users as U', 'TC.CREATE_BY', '=', 'U.id')
            ->select('D.Nama_Dokter', 'tpm.IMAGE as ttd_dokter', 'TC.DIAGNOSA', 'TC.JENIS_FISIO', 'U.name')
            ->orderBy('TC.ID_CPPT_FISIO', 'ASC')
            ->where('tf.KODE_TRANSAKSI_FISIO', '=', $id)
            ->limit('1')
            ->first();

        $cekFirstCppt = false;
        if ($firstCppt != null) {
            $cekFirstCppt = true;
        }

        // dd($data);

        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $ttdPasien = $this->berkasFisio->getTtdPasienByMr($biodatas->NO_MR);
        // dd($ttdPasien);

        $date = date('dMY');
        $filename = 'BuktiLayanan-' . $date;
        $pdf = PDF::loadview($this->view . 'cetak/bukti_pelayanan', ['title' => $title, 'data' => $data, 'biodatas' => $biodatas, 'lastCppt' => $lastCppt, 'firstCppt' => $firstCppt, 'cekFirstCppt' => $cekFirstCppt, 'ttdPasien' => $ttdPasien, 'row'=>$row]);
        return $pdf->stream($filename . '.pdf');
    }
        // ------------------------
        // alat kesehatan fisioterapi
        // ------------------------

        public function update_alkes(Request $request)
        {
            $validatedData = $request->validate([
                'no_registrasi' => 'required',
            ]);
    
    
            $data = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->update([

                'lingkar_pinggang' => $request->input('lingkar_pinggang')
            ]);

           if($data>0){
               return redirect()->back()->with('success', 'Lingkar Pinggang Berhasil Diperbarui!');
            }
            else {
               return redirect()->back()->with('warning', 'Lingkar Pinggang gagal Diperbarui!');

           }
    
        }

        public function update_alkes_bpjs(Request $request)
        {
            $validatedData = $request->validate([
                'no_registrasi' => 'required',
            ]);

            try {
                DB::connection('pku')->beginTransaction();
    
                $data = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->update([

                    'lingkar_pinggang' => $request->input('lingkar_pinggang'),
                    'no_sep' => $request->input('no_sep'),
                    'biaya' => $request->input('biaya')
                ]); 

            if($data>0){

                $cekVerifikasi = DB::connection('pku')->table('fis_verifikasi_alkes_by_bpjs')->where('no_registrasi', $request->input('no_registrasi'))->first();

                if($cekVerifikasi == null){
                    $verifikasi = DB::connection('pku')->table('fis_verifikasi_alkes_by_bpjs')->insert([
    
                        'no_registrasi' => $request->input('no_registrasi'),
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                }else{
                    $data = DB::connection('pku')->table('fis_verifikasi_alkes_by_bpjs')->where('no_registrasi', $request->input('no_registrasi'))->update([

                        'no_registrasi' => $request->input('no_registrasi'),
                        'updated_by' => auth()->user()->id,
                        'updated_at' => now()
                    ]); 
                }

                DB::connection('pku')->commit();

                return redirect()->back()->with('success', 'Alat Kesehatan berhasil di verifikasi!');
             }
             else {
                DB::connection('pku')->rollback();
                return redirect()->back()->with('warning', 'Alat Kesehatan gagal di verifikasi!');
 
            }
            // return redirect()->route('add.ujifungsi', ['NoMr' => $request->input('NO_MR')])->with('success', 'Asesmen Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    
        }

        public function update_alkes_farmasi(Request $request)
        {
            $validatedData = $request->validate([
                'no_registrasi' => 'required',
            ]);

            try {
                DB::connection('pku')->beginTransaction();
    
                $data = DB::connection('pku')->table('fis_order_alkes')->where('no_registrasi', $request->input('no_registrasi'))->update([
                    'biaya' => $request->input('biaya')
                ]); 

            if($data>0){

                $cekVerifikasi = DB::connection('pku')->table('fis_verifikasi_alkes_by_farmasi')->where('no_registrasi', $request->input('no_registrasi'))->first();

                if($cekVerifikasi == null){
                    $verifikasi = DB::connection('pku')->table('fis_verifikasi_alkes_by_farmasi')->insert([
    
                        'no_registrasi' => $request->input('no_registrasi'),
                        'created_by' => auth()->user()->id,
                        'updated_by' => auth()->user()->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                }else{
                    $data = DB::connection('pku')->table('fis_verifikasi_alkes_by_farmasi')->where('no_registrasi', $request->input('no_registrasi'))->update([

                        'no_registrasi' => $request->input('no_registrasi'),
                        'updated_by' => auth()->user()->id,
                        'updated_at' => now()
                    ]); 
                }

                DB::connection('pku')->commit();

                return redirect()->back()->with('success', 'Alat Kesehatan berhasil di verifikasi!');
             }
             else {
                DB::connection('pku')->rollback();
                return redirect()->back()->with('warning', 'Alat Kesehatan gagal di verifikasi!');
 
            }
            // return redirect()->route('add.ujifungsi', ['NoMr' => $request->input('NO_MR')])->with('success', 'Asesmen Berhasil Ditambahkan!');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::connection('pku')->rollback();

            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    
        }

    // ---------------------
    // Fisioterapi Dokter
    // ---------------------
    public function fisioDokter()
    {
        $listpasien = $this->fisio->pasienCpptdanFisioterapi();

        $title = $this->prefix . ' ' . 'Dokter';
        return view($this->view . 'dokter.cppt', compact('title', 'listpasien'));
    }
    public function formDokter(Request $request)
    {
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $title = $this->prefix . ' ' . 'Dokter';
        return view($this->view . 'dokter.form', compact('title', 'biodatas', 'request'));
    }

    public function tindakanDokter(Request $request)
    {
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);

        $title = $this->prefix . ' ' . 'Tindakan';
        return view($this->view . 'dokter.tindakan', compact('title', 'biodatas', 'request'));
    }

    public function diagnosaDokter(Request $request)
    {
        $title = $this->prefix . ' ' . 'Tindakan';
        $jenisfisio = DB::connection('pku')->table('TAC_COM_FISIOTERAPI_MASTER')->get();
        return view($this->view . 'dokter.diagnosa', compact('title', 'jenisfisio'));
    }

    public function cetakFormulir(Request $request)
    {
        $title = $this->prefix . ' ' . 'Bukti Layanan CPPT';

        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $date = date('dMY');
        $filename = 'Formulir-' . $date;
        $pdf = PDF::loadview($this->view . 'cetak/formulir', ['title' => $title, 'biodatas' => $biodatas]);
        return $pdf->stream($filename . '.pdf');
    }
}
