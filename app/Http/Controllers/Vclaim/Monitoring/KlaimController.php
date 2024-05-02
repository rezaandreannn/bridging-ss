<?php

namespace App\Http\Controllers\Vclaim\Monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\BPJS\Vclaim\Monitoring\KlaimService;

class KlaimController extends Controller
{
    protected $KlaimService;

    public function __construct()
    {
        $this->KlaimService = new KlaimService();
    }
    public function index()
    {
        dd($this->KlaimService->getKlaim('2024-02-13', '2', '2'));
    }
}
