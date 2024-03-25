<?php

namespace App\Http\Controllers\Rj;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RawatJalanController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.rawatjalan.';
        $this->routeIndex = 'rawatjalan.index';
        $this->prefix = 'Rawat Jalan';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'index', compact('title'));
    }
}
