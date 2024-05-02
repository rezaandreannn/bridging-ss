<?php

namespace App\Services\BPJS\Vclaim\Monitoring;

use Bpjs\Bridging\Vclaim\BridgeVclaim;

class KunjunganService
{
    protected $bridging;

    public function __construct()
    {
        $this->bridging = new BridgeVclaim();
    }

    public function getKunjungan($tanggalSEP, $jenisPelayanan)
    {
        // Cek apakah kedua parameter telah diisi
        if (empty($tanggalSEP) || empty($jenisPelayanan)) {
            return "Mohon isi kedua parameter: tanggal SEP dan jenis pelayanan.";
        }

        $endpoint = 'Monitoring/Kunjungan/Tanggal/' . $tanggalSEP . '/JnsPelayanan/' . $jenisPelayanan;
        $result = $this->bridging->getRequest($endpoint);

        // Cek apakah ada data yang ditemukan
        if ($result) {
            return json_decode($result, true);
        } else {
            return "Data tidak ditemukan.";
        }
    }
}
