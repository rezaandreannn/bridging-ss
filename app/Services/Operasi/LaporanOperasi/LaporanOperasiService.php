<?php

namespace App\Services\Operasi\LaporanOperasi;

use Exception;
use App\Models\Simrs\Dokter;
use App\Models\Operasi\Operasi;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Models\Operasi\BookingOperasi;
use App\Models\Operasi\LaporanOperasi;
use Illuminate\Support\Facades\Storage;
use App\Models\Operasi\PenandaanOperasi;
use App\Models\Operasi\OperatorAsistenDetail;
use App\Models\Operasi\PostOperasi\DataUmumPostOperasi;

class LaporanOperasiService
{
    private function baseQuery()
    {
        return BookingOperasi::with([
            'pendaftaran' => function ($query) {
                $query->select('No_Reg', 'No_MR')
                    ->with(['registerPasien' => function ($query) {
                        $query->select('No_MR', 'Nama_Pasien');
                    }]);
            },
            'ruangan' => function ($query) {
                $query->select('id', 'kode_ruang', 'nama_ruang');
            },
            'dokter' => function ($query) {
                $query->select('Kode_Dokter', 'Nama_Dokter');
            }
        ]);
    }



    public function findById($id)
    {
        return BookingOperasi::find($id);
    }

    public function laporanByRegister($kode_register)
    {


        $laporanOperasi =  LaporanOperasi::where('kode_register', $kode_register)->first();
        // dd($laporanOperasi);
        if ($laporanOperasi) {
            return (object) [
                'id' => $laporanOperasi->id,
                'kode_register' => $laporanOperasi->kode_register,
                'tanggal' => $laporanOperasi->tanggal,
                'diagnosa_pre_op' => $laporanOperasi->diagnosa_pre_op,
                'diagnosa_post_op' => $laporanOperasi->diagnosa_post_op,
                'jaringan_dieksekusi' => $laporanOperasi->jaringan_dieksekusi,
                'mulai_operasi' => $laporanOperasi->mulai_operasi,
                'selesai_operasi' => $laporanOperasi->selesai_operasi,
                'lama_operasi' => $laporanOperasi->lama_operasi,
                'permintaan_pa' => $laporanOperasi->permintaan_pa,
                'laporan_operasi' => $laporanOperasi->laporan_operasi,
                'pendarahan' => $laporanOperasi->pendarahan,
                'macam_operasi' => $laporanOperasi->macam_operasi,
                'created_by' => $laporanOperasi->created_by,
                'updated_by' => $laporanOperasi->updated_by,
                'created_at' => $laporanOperasi->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $laporanOperasi->updated_at->format('Y-m-d H:i:s'),
                'nama_operator' => optional($laporanOperasi->detailAsisten)->nama_operator,
                'nama_asisten' => optional($laporanOperasi->detailAsisten)->nama_asisten,
                'nama_perawat' => optional($laporanOperasi->detailAsisten)->nama_perawat,
                'nama_ahli_anastesi' => optional($laporanOperasi->detailAsisten)->nama_ahli_anastesi,
                'nama_anastesi' => optional($laporanOperasi->detailAsisten)->nama_anastesi,
                'jenis_anastesi' => optional($laporanOperasi->tableOperasi)->jenis_anastesi,
                'jenis_operasi' => optional($laporanOperasi->penandaanOperasi)->jenis_operasi
            ];
        }



        return $laporanOperasi;
    }


    public function getAsistenArray($kode_register)
    {
        $data = LaporanOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->detailAsisten->nama_asisten ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $asisten = array();
        if (!empty($string)) {
            $asisten = explode(', ', $string);
        }

        return $asisten;
    }

    public function getPerawatArray($kode_register)
    {

        $data = LaporanOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->detailAsisten->nama_perawat ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $perawat = array();
        if (!empty($string)) {
            $perawat = explode(', ', $string);
        }

        return $perawat;
    }

    public function getAhliAnastesiArray($kode_register)
    {
        $data = LaporanOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->detailAsisten->nama_ahli_anastesi ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $ahli_anastesi = array();
        if (!empty($string)) {
            $ahli_anastesi = explode(', ', $string);
        }

        return $ahli_anastesi;
    }

    public function getAnastesiArray($kode_register)
    {
        $data = LaporanOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->detailAsisten->nama_anastesi ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $anastesi = array();
        if (!empty($string)) {
            $anastesi = explode(', ', $string);
        }

        return $anastesi;
    }

    public function getAsistenPostOpArray($kode_register)
    {
        $data = DataUmumPostOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->asisten_bedah ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $asisten = array();
        if (!empty($string)) {
            $asisten = explode(', ', $string);
        }

        return $asisten;
    }

    public function getAhliAnastesiPostOpArray($kode_register)
    {
        $data = DataUmumPostOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->dokter_anastesi ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $ahli_anastesi = array();
        if (!empty($string)) {
            $ahli_anastesi = explode(', ', $string);
        }

        return $ahli_anastesi;
    }

    public function getAnastesiPostOpArray($kode_register)
    {
        $data = DataUmumPostOperasi::where('kode_register', $kode_register)->first();
        $string = trim($data->asisten_anastesi ?? '', ','); // Menghapus koma di awal dan akhir string (jika ada)
        $anastesi = array();
        if (!empty($string)) {
            $anastesi = explode(', ', $string);
        }

        return $anastesi;
    }
    public function insert(array $data)
    {
        DB::beginTransaction();
        try {

            // pisahkan array dengan koma menjadi string
            $asisten = $data['nama_asisten'] ?? '';
            $data['nama_asisten'] = $asisten;
            if (!empty($asisten)) {
                $data['nama_asisten'] = implode(', ', $asisten);
            }

            $perawat = $data['nama_perawat'] ?? '';
            $data['nama_perawat'] = $perawat;
            if (!empty($perawat)) {
                $data['nama_perawat'] = implode(', ', $perawat);
            }
            $ahli_anastesi = $data['nama_ahli_anastesi'] ?? '';
            $data['nama_ahli_anastesi'] = $ahli_anastesi;
            if (!empty($ahli_anastesi)) {
                $data['nama_ahli_anastesi'] = implode(', ', $ahli_anastesi);
            }
            $penata_anastesi = $data['nama_anastesi'] ?? '';
            $data['nama_anastesi'] = $penata_anastesi;
            if (!empty($penata_anastesi)) {
                $data['nama_anastesi'] = implode(', ', $penata_anastesi);
            }
            // dd($insertPerawat);
            // Insert Asisten dan Perawat Bersamaan (Nama Asisten dan Nama Perawat)
            $operasiasistendetail = OperatorAsistenDetail::create([
                'kode_register' => $data['kode_register'],
                'nama_operator' => $data['nama_operator'],
                'nama_asisten' => $data['nama_asisten'], // Tentukan apakah ini asisten
                'nama_perawat' => $data['nama_perawat'], // Tentukan apakah ini perawat
                'nama_ahli_anastesi' => $data['nama_ahli_anastesi'],
                'nama_anastesi' => $data['nama_anastesi'],
                'created_by' => auth()->user()->id,
            ]);

            $laporanoperasi = LaporanOperasi::create([
                'kode_register' => $data['kode_register'],
                'tanggal' => $data['tanggal'],
                'diagnosa_pre_op' => $data['diagnosa_pre_op'],
                'diagnosa_post_op' => $data['diagnosa_post_op'],
                'jaringan_dieksekusi' => $data['jaringan_dieksekusi'],
                'mulai_operasi' => $data['mulai_operasi'] ?? '',
                'selesai_operasi' => $data['selesai_operasi'] ?? '',
                'lama_operasi' => $data['lama_operasi'] ?? '',
                'permintaan_pa' => $data['permintaan_pa'],
                'macam_operasi' => $data['macam_operasi'],
                'laporan_operasi' => $data['laporan_operasi'],
                'pendarahan' => $data['pendarahan'],
                'created_by' => auth()->user()->id,
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            $operasi = Operasi::create([
                'kode_register' => $data['kode_register'],
                'jenis_anastesi' => $data['jenis_anastesi'],
                'created_by' => auth()->user()->id,
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            DB::commit();

            return [
                'operasiasistendetail' => $operasiasistendetail,
                'laporanoperasi' => $laporanoperasi,
                'operasi' => $operasi,

            ];
        } catch (\Throwable $th) {
            DB::rollback();
            throw new Exception("Gagal menambahkan laporan operasi: " . $th->getMessage());
        }
    }

    public function update($kode_register, array $data)
    {
        try {



            $id_detail_asisten = OperatorAsistenDetail::where('kode_register', $kode_register)->first();

            $operasiasistendetail = OperatorAsistenDetail::findOrFail($id_detail_asisten->id);
            // pisahkan array dengan koma menjadi string
            $asisten = $data['nama_asisten'] ?? '';
            $data['nama_asisten'] = $asisten;
            if (!empty($asisten)) {
                $data['nama_asisten'] = implode(', ', $asisten);
            }

            $perawat = $data['nama_perawat'] ?? '';
            $data['nama_perawat'] = $perawat;
            if (!empty($perawat)) {
                $data['nama_perawat'] = implode(', ', $perawat);
            }
            $ahli_anastesi = $data['nama_ahli_anastesi'] ?? '';
            $data['nama_ahli_anastesi'] = $ahli_anastesi;
            if (!empty($ahli_anastesi)) {
                $data['nama_ahli_anastesi'] = implode(', ', $ahli_anastesi);
            }
            $penata_anastesi = $data['nama_anastesi'] ?? '';
            $data['nama_anastesi'] = $penata_anastesi;
            if (!empty($penata_anastesi)) {
                $data['nama_anastesi'] = implode(', ', $penata_anastesi);
            }
            // dd($insertPerawat);
            // Insert Asisten dan Perawat Bersamaan (Nama Asisten dan Nama Perawat)
            $operasiasistendetail->update([
                'kode_register' => $data['kode_register'],
                'nama_operator' => $data['nama_operator'],
                'nama_asisten' => $data['nama_asisten'], // Tentukan apakah ini asisten
                'nama_perawat' => $data['nama_perawat'], // Tentukan apakah ini perawat
                'nama_ahli_anastesi' => $data['nama_ahli_anastesi'],
                'nama_anastesi' => $data['nama_anastesi'],
                'updated_by' => auth()->user()->id,
            ]);

            // id laporan operasi
            $id = LaporanOperasi::where('kode_register', $kode_register)->first();

            $laporanoperasi = LaporanOperasi::findOrFail($id->id);

            $laporanoperasi->update([
                'kode_register' => $data['kode_register'],
                'tanggal' => $data['tanggal'],
                'diagnosa_pre_op' => $data['diagnosa_pre_op'],
                'diagnosa_post_op' => $data['diagnosa_post_op'],
                'jaringan_dieksekusi' => $data['jaringan_dieksekusi'],
                'mulai_operasi' => $data['mulai_operasi'] ?? '',
                'selesai_operasi' => $data['selesai_operasi'] ?? '',
                'lama_operasi' => $data['lama_operasi'] ?? '',
                'permintaan_pa' => $data['permintaan_pa'],
                'macam_operasi' => $data['macam_operasi'],
                'laporan_operasi' => $data['laporan_operasi'],
                'pendarahan' => $data['pendarahan'],
                'updated_by' => auth()->user()->id,
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);

            // id laporan operasi
            $idOperasi = Operasi::where('kode_register', $kode_register)->first();
            $operasi = Operasi::findOrFail($idOperasi->id);

            $operasi->update([
                'kode_register' => $data['kode_register'],
                'jenis_anastesi' => $data['jenis_anastesi'],
                'created_by' => auth()->user()->id,
                // 'cara_masuk' => $data['cara_masuk'] ?? ''
            ]);



            return [
                'operasiasistendetail' => $operasiasistendetail,
                'laporanoperasi' => $laporanoperasi,
                'operasi' => $operasi,

            ];
        } catch (\Throwable $th) {
            throw new Exception("Gagal memperbarui laporan operasi: " . $th->getMessage());
        }
    }

    public function delete($kode_register)
    {
        try {
            //code...
            $id_detail_asisten = OperatorAsistenDetail::where('kode_register', $kode_register)->first();
            $detailasisten = OperatorAsistenDetail::findOrFail($id_detail_asisten->id)->delete();

            $id_laporan = LaporanOperasi::where('kode_register', $kode_register)->first();
            $laporanoperasi = LaporanOperasi::findOrFail($id_laporan->id)->delete();

            $id_operasi = Operasi::where('kode_register', $kode_register)->first();
            $idoperasi = Operasi::findOrFail($id_operasi->id)->delete();
            return 'ok';
        } catch (\Throwable $th) {
            //throw $th;
            throw new Exception("Gagal menghapus laporan operasi: " . $th->getMessage());
        }
    }

    private function mapData($databookings)
    {
        return collect($databookings->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'kode_register' => $item->kode_register,
                'tanggal' => $item->tanggal,
                'no_mr' => optional($item->pendaftaran)->No_MR,
                'nama_pasien' => optional($item->pendaftaran->registerPasien)->Nama_Pasien,
                'ruang_operasi' => optional($item->ruangan)->nama_ruang,
                'nama_dokter' => optional($item->dokter)->Nama_Dokter,
                'nama_tindakan' => $item->nama_tindakan,
                'terlaksana' => $item->terlaksana,
                'jam_mulai' => $item->jam_mulai,
                'jam_selesai' => $item->jam_selesai,
                'cara_masuk' => $item->cara_masuk
            ];
        }));
    }


    // get data asisten anastesi

    public function getAsistenOperasi()
    {
        $data = Dokter::where('Jenis_Profesi', 'ASISTEN OPERASI')->get();
        return $this->mapDataAsisten($data);
    }

    public function getSpesialisAnastesi()
    {
        $data = Dokter::where('Spesialis', 'SPESIALIS ANASTESI')->get();
        return $this->mapDataAsisten($data);
    }

    public function getPenataAsisten()
    {
        $data = Dokter::where('Jenis_Profesi', 'PENATA ANESTESI')->get();
        return $this->mapDataAsisten($data);
    }

    private function mapDataAsisten($dataAsistens)
    {
        return collect($dataAsistens->map(function ($item) {
            return (object) [
                'kode_dokter' => $item->Kode_Dokter,
                'jenis_profesi' => $item->Jenis_Profesi,
                'nama_asisten' => $item->Nama_Dokter
            ];
        }));
    }

    public function getDetailAsistenByRegister($kode_register)
    {
        // Ambil data dari tabel ok_operator_asisten_detail berdasarkan kode_register
        $operatorAsistenDetail = DB::connection('pku')->table('ok_operator_asisten_detail')
            ->where('kode_register', $kode_register)
            ->first();

        if ($operatorAsistenDetail && $operatorAsistenDetail->nama_asisten) {
            // Konversi kode asisten menjadi array
            $kodeAsisten = explode(',', $operatorAsistenDetail->nama_asisten);

            // Ambil data nama dokter berdasarkan kode dokter
            $asistenOperasi = Dokter::whereIn('Kode_Dokter', $kodeAsisten)
                ->select('Kode_Dokter', 'Nama_Dokter')
                ->get();

            return [
                'operatorAsistenDetail' => $operatorAsistenDetail,
                'asistenOperasi' => $asistenOperasi
            ];
        }

        // Return kosong jika tidak ada data
        return [
            'operatorAsistenDetail' => null,
            'asistenOperasi' => collect([]) // Koleksi kosong
        ];
    }

    public function getNameAssistenByCodes(array $assistenCode)
    {
        $nurses =  Dokter::whereIn('Kode_Dokter', $assistenCode)
            ->pluck('Nama_Dokter')
            ->toArray();

        return $nurses;
    }

    public function getNamePerawatByCodes(array $perawatCode)
    {
        $nurses =  Dokter::whereIn('Kode_Dokter', $perawatCode)
            ->pluck('Nama_Dokter')
            ->toArray();

        return $nurses;
    }
    public function getNameDoktertByCodes(array $doktertCode)
    {
        $nurses =  Dokter::whereIn('Kode_Dokter', $doktertCode)
            ->pluck('Nama_Dokter')
            ->toArray();

        return $nurses;
    }
    public function getNameAnastesiByCodes(array $anastesiCode)
    {
        $nurses =  Dokter::whereIn('Kode_Dokter', $anastesiCode)
            ->pluck('Nama_Dokter')
            ->toArray();

        return $nurses;
    }
}
