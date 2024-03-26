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
        $this->view = 'pages.rj.';
        $this->routeIndex = 'rj.index';
        $this->prefix = 'Rawat Jalan';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'index', compact('title'));
    }

    public function history()
    {
        $title = $this->prefix . ' ' . 'History';
        return view($this->view . 'history', compact('title'));
    }

    public function add()
    {
        $title = $this->prefix . ' ' . 'Add Data';
        return view($this->view . 'add', compact('title'));
    }
}
