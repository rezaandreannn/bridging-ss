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
    protected $encounter;

    public function __construct(Encounter $encounter)
    {
        $this->view = 'pages.encounter.';
        $this->routeIndex = 'resource.index';
        $this->prefix = 'Encounter';
        $this->encounter = $encounter;
    }

    public function index(Request $request)
    {
        // Filter

        $title = $this->prefix . ' ' . 'Index';

        // Ambil kode dokter dan tanggal dari request
        $kode_dokter = $request->input('kode_dokter');
        $created_at = $request->input('tanggal');

        // Panggil metode model untuk filter data
        $dokters = $this->encounter->byKodeDokter();
        $encounters = Encounter::getData($kode_dokter, $created_at);

        return view($this->view . 'index', compact('encounters', 'dokters', 'title'));
    }

    public function edit($id)
    {
        $title = $this->prefix . ' ' . 'Edit';
        $encounter = Encounter::findOrFail($id);
        return view($this->view . 'edit', compact('title'));
    }
}
