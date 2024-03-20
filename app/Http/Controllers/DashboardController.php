<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.';
        $this->routeIndex = 'dashboard.index';
        $this->prefix = 'Dashboard';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'SIMRS-BRIDGE';
        return view($this->view . 'dashboard', compact('title'));
    }
}
