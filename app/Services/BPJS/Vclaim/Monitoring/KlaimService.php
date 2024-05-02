<?php

namespace App\Services\BPJS\Vclaim\Monitoring;

use Bpjs\Bridging\Vclaim\BridgeVclaim;

class KlaimService
{
    protected $bridging;

    public function __construct()
    {
        $this->bridging = new BridgeVclaim();
    }

    public function getKlaim($tanggalPulang, $jenisPelayanan, $statusKlaim)
    {
        // Cek apakah kedua parameter telah diisi
        if (empty($tanggalPulang) || empty($jenisPelayanan || $statusKlaim)) {
            return "Mohon isi kedua parameter: tanggal Pulang / jenis pelayanan / status klaim.";
        }

        $endpoint = 'Monitoring/Klaim/Tanggal/' . $tanggalPulang . '/JnsPelayanan/' . $jenisPelayanan . '/Status/' . $statusKlaim;
        $result = $this->bridging->getRequest($endpoint);

        // Cek apakah ada data yang ditemukan
        if ($result) {
            return json_decode($result, true);
        } else {
            return "Data tidak ditemukan.";
        }
    }
}
