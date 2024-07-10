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
        
        // FISIOTERAPI DAN SPKFR
        $countPasienFisioterapi = $this->dashboard->countPasienFisioterapi();
        $countPasienSPKFR = $this->dashboard->countPasienSPKFR();
        $totalFisioSkpfr = $countPasienFisioterapi + $countPasienSPKFR;

       
     
        return view($this->view . 'dashboard', compact('title','countPasienRajal','countPasienRanap','totalPasienToday','countPasienFisioterapi','countPasienSPKFR', 'totalFisioSkpfr'));
    }
}
