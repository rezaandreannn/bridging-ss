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

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Index';
        $Encounters = Encounter::all();
        return view($this->view . 'index', compact('title', 'Encounters'));

        try {
            // Filter
            // Retrieve query parameters
            $kode_dokter = $request->input('kode_dokter');
            $tanggal = $request->input('tanggal');
            $status_rawat = $request->input('status_rawat');

            $title = 'Pendaftaran';
            $data = $this->pendaftaran->getData($kode_dokter, $tanggal, $status_rawat);
            $dokters = $this->pendaftaran->byKodeDokter();
            return view($this->view . 'index', ['data' => $data, 'dokters' => $dokters]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }

    public function edit($id)
    {
        $title = $this->prefix . ' ' . 'Edit';
        $encounter = Encounter::findOrFail($id);
        return view($this->view . 'edit', compact('title'));
    }
}
