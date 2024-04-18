<?php

namespace App\Http\Controllers\Fisio;

use App\Models\Fisioterapi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien;

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
        $this->routeIndex = 'fisio.index';
        $this->prefix = 'Fisioterapi';
        $this->pasien = new Pasien;
    }

    public function index()
    {
        $listpasien = $this->fisio->pasienCpptdanFisioterapi();
        
        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'cppt', compact('title','listpasien'));
    }

    public function edit(Request $request)
    {
        
        
        $biodatas = $this->pasien->biodataPasienByMr($request->no_mr);

        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'transaksiFisio', compact('title','biodatas'));
    }

    public function create()
    {
        var_dump('ok');
        die;
        $title = $this->prefix . ' ' . 'CPPT';
        return view($this->view . 'create', compact('title'));
    }

    public function edit_cppt()
    {
        $title = $this->prefix . ' ' . 'CPPT';
        return view($this->view . 'edit', compact('title'));
    }
}
