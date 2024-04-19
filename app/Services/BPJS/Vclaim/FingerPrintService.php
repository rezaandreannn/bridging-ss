<?php

namespace App\Services\BPJS\Vclaim;

use Bpjs\Bridging\Vclaim\BridgeVclaim;

class FingerPrintService
{
    protected $bridging;

    public function __construct()
    {
        $this->bridging = new BridgeVclaim();
    }

    /**
     * Get Finger Print by tanggal pelayanan.
     * @param string $tanggalPelayanan
     * @return mixed The retrieved Finger Print data, or null if not found.
     */
    public function byTanggal($tanggalPelayanan)
    {
        $endpoint = 'SEP/FingerPrint/List/Peserta/TglPelayanan/' . $tanggalPelayanan;
        $result = $this->bridging->getRequest($endpoint);
        return json_decode($result, true);
    }


    /**
     * Get Finger Print by no kartu and tanggal pelayanan.
     * @param int $noKartu
     * @param string $tanggalPelayanan
     * @return mixed The retrieved Finger Print data, or null if not found.
     */
    public function byNoKartuAndTanggal($noKartu, $tanggalPelayanan)
    {
        $endpoint = 'SEP/FingerPrint/Peserta/' . $noKartu . '/TglPelayanan/' . $tanggalPelayanan;
        return $this->bridging->getRequest($endpoint);
    }
}
