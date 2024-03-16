<?php

namespace App\Http\Controllers\Encounter;

use App\Http\Controllers\Controller;
use App\Models\Encounter;
use Illuminate\Http\Request;

class RecourceController extends Controller
{
    protected $view;
    protected $routeIndex;
    protected $prefix;

    public function __construct()
    {
        $this->view = 'pages.encounter.';
        $this->routeIndex = 'resource.index';
        $this->prefix = 'Encounter';
    }

    public function index()
    {
        $title = $this->prefix . ' ' . 'Index';
        $Encounters = Encounter::all();
        return view($this->view . 'index', compact('title', 'Encounters'));
    }

    public function edit($id)
    {
        $title = $this->prefix . ' ' . 'Edit';
        $encounter = Encounter::findOrFail($id);
        return view($this->view . 'edit', compact('title'));
    }
}
