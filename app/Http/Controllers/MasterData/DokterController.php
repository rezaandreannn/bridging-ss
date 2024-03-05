<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    protected $dokter;

    public function __construct(Dokter $dokter)
    {
        $this->dokter = $dokter;
    }

    public function index(Request $request)
    {
        try {
            $title = 'Dokter';
            $data = $this->dokter->getData();
            return view('pages.md.dokter.index', ['data' => $data]);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json(['error' => 'Failed to fetch data'], 500);
            // return view('error-view', ['error' => 'Failed to fetch data']);
        }
    }

    public function edit($kodeDokter)
    {
        try {
            $dokterData = $this->dokter->getByKodeDokter($kodeDokter);
            // Assuming you want to return the edit form view with doctor data
            return view('pages.md.dokter.edit', ['dokter' => $dokterData]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the API request
            // For example, you could redirect to an error page
            return redirect()->route('error')->with('error', $e->getMessage());
        }
    }

    public function show()
    {
        try {
            $dokterData = $this->byKodeDokter();
            // Assuming you want to return the doctor data as JSON
            return view('pages.md.dokter.detail', ['data' => $dokterData]);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the API request
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
