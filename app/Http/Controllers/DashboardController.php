<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $dashboard;
    protected $prefix;

    public function __construct(Dashboard $dashboard)
    {
        $this->dashboard = $dashboard;
        $this->view = 'pages.';
        $this->routeIndex = 'dashboard.index';
        $this->prefix = 'Dashboard';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'SIMRS-BRIDGE';

        // RAJAL DAN RANAP
        $countPasienRajal = $this->dashboard->countPasienRajal();
        $countPasienRanap = $this->dashboard->countPasienRanap();
        $totalPasienToday = $countPasienRajal + $countPasienRanap;

        // jalur masuk igd
        $countPasienIgdRajal = $this->dashboard->countPasienIgdRajal();
        $countPasienIgdRanap = $this->dashboard->countPasienIgdRanap();
        $totalPasienIgdToday = $countPasienIgdRajal + $countPasienIgdRanap;
        
        // FISIOTERAPI DAN SPKFR
        $countPasienFisioterapi = $this->dashboard->countPasienFisioterapi();
        $countPasienSPKFR = $this->dashboard->countPasienSPKFR();
        $totalFisioSkpfr = $countPasienFisioterapi + $countPasienSPKFR;

        // pasien by dokter
        $countPasienByDokter = $this->dashboard->countPasienByDokter();
        
        $countRanapKls1 = $this->dashboard->countRanapKls1();
        $countRanapKls2 = $this->dashboard->countRanapKls2();
        $countRanapKls3 = $this->dashboard->countRanapKls3();
        $countRanapKlsvip = $this->dashboard->countRanapKlsvip();
        $countRanapKlsvvip = $this->dashboard->countRanapKlsvvip();
      
        return view($this->view . 'dashboard', compact('title','countPasienRajal','countPasienRanap','totalPasienToday','countPasienFisioterapi','countPasienSPKFR', 'totalFisioSkpfr','countPasienByDokter','countPasienIgdRajal','countPasienIgdRanap','totalPasienIgdToday','countRanapKls1','countRanapKls2','countRanapKls3','countRanapKlsvip','countRanapKlsvvip'));
    }
}
