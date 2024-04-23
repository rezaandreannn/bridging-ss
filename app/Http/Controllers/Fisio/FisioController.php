<?php

namespace App\Http\Controllers\Fisio;

use App\Models\Pasien;
use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FisioController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;
    protected $fisio;
    protected $pasien;

    public function __construct(Fisioterapi $fisio)
    {

        $this->fisio = $fisio;
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'cppt.fisio';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;
    }

    public function index()
    {
        $listpasien = $this->fisio->pasienCpptdanFisioterapi();

        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'cppt', compact('title', 'listpasien'));
    }

    public function edit(Request $request)
    {
        $fisioModel = new Fisioterapi();
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);
        $transaksis = $this->fisio->transaksiFisioByMr($request->no_mr);
        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'transaksiFisio', compact('title', 'biodatas', 'transaksis', 'fisioModel'));
    }

    public function store(Request $request)
    {
        $title = $this->prefix . ' ' . 'CPPT';
        $kode_transaksi = $this->fisio->generateRandomCode(); // Generate random transaction code
        $jumlah_total_fisio = $request->input('JUMLAH_TOTAL_FISIO');

        $request->validate([
            'JUMLAH_TOTAL_FISIO' => 'required|numeric',
        ]);

        if ($jumlah_total_fisio > 8) {
            Session::flash('warning', 'Pastikan jumlah maksimal fisioterapi adalah 8 kali');
            return redirect()->route($this->routeIndex, $request->input('NO_MR_PASIEN'));
        }

        $transaksi_fisio = new Fisioterapi();
        $transaksi_fisio->kode_transaksi = $kode_transaksi;
        $transaksi_fisio->NO_MR_PASIEN = $request->input('NO_MR_PASIEN');
        $transaksi_fisio->JUMLAH_TOTAL_FISIO = $jumlah_total_fisio;
        $transaksi_fisio->tanggal_transaksi = now();
        $transaksi_fisio->users = auth()->user()->name;

        $transaksi_fisio->save();

        Session::flash('success', 'Data telah berhasil ditambahkan');
        return redirect()->route($this->routeIndex, $request->input('NO_MR_PASIEN'));
    }

    public function edit_cppt()
    {
        $title = $this->prefix . ' ' . 'CPPT';
        return view($this->view . 'edit', compact('title'));
    }

    public function cetak_cppt()
    {
        $date = date('dMY');
        $title = $this->prefix . ' ' . 'Cetak CPPT';

        $filename = 'resep-' . $date;

        $pdf = PDF::loadview($this->view . 'cetak/cppt', ['title' => $title]);
        return $pdf->stream($filename . '.pdf');
    }

    public function bukti_layanan()
    {
        $date = date('dMY');
        $title = $this->prefix . ' ' . 'Bukti Layanan CPPT';

        $filename = 'resep-' . $date;

        $pdf = PDF::loadview($this->view . 'cetak/bukti_pelayanan', ['title' => $title]);
        return $pdf->stream($filename . '.pdf');
    }
}
