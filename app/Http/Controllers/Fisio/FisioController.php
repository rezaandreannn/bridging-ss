<?php

namespace App\Http\Controllers\Fisio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FisioController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.fisioterapi.';
        $this->routeIndex = 'fisio.index';
        $this->prefix = 'Fisioterapi';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        return view($this->view . 'cppt', compact('title'));
    }

    public function edit()
    {
        $title = $this->prefix . ' ' . 'Form CPPT';
        return view($this->view . 'fisio', compact('title'));
    }

    public function create()
    {
        $title = $this->prefix . ' ' . 'CPPT';
        return view($this->view . 'create', compact('title'));
    }

    public function edit_cppt()
    {
        $title = $this->prefix . ' ' . 'CPPT';
        return view($this->view . 'edit', compact('title'));
    }
}
