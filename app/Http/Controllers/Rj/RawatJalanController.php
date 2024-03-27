<?php

namespace App\Http\Controllers\Rj;

use App\Http\Controllers\Controller;
use App\Models\Rajal;
use Illuminate\Http\Request;

class RawatJalanController extends Controller
{
    protected $view;
    protected $rajal;
    protected $routeIndex;
    protected $prefix;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.rj.';
        $this->routeIndex = 'rj.index';
        $this->prefix = 'Rawat Jalan';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        $dokters = $this->rajal->byKodeDokter();
        return view($this->view . 'index', compact('title', 'dokters'));
    }

    public function add()
    {
        $title = $this->prefix . ' ' . 'Add Data';
        return view($this->view . 'add', compact('title'));
    }
}
