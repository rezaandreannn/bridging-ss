<?php

namespace App\Services\Operasi;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\PenandaanOperasi;

class PenandaanOperasiService
{
    public function get()
    {
        $databookings = $this->baseQuery()->get();
        return $this->mapData($databookings);
    }
    public function byRegister($kodeRegister) {}
    public function byRegisterWithTtd($kodeRegister) {}
    public function insert(array $data) {}
    public function update($id, array $data) {}
    public function delete($id) {}
}
