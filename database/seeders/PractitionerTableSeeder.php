<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PractitionerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // public function run()
    // {
    //     // $items = [
    //     //     ['kode_dokter' => '111', 'jenis_profesi' => 'DOKTER SPESIALIS', 'specialis' => 'SPESIALIS PENYAKIT DALAM', 'nama_dokter' => 'dr. Agung B Prasetiyono, Sp.PD', 'nik' => '1872010806720001', 'tgl_lahir' => '1972-06-08', 'jenis_kelamin' => 'L', 'agama' => 'ISLAM', 'email' => 'agungbprasetiyo91@gmail.com', 'no_hp' => '082328010445', 'alamat' => 'Jl. Kamboja No. 19 RT\/RW. 040\/007 Metro Pusat', 'kota' => 'Metro', 'provinsi' => 'Lampung', 'kode_pos' => '34111'],
    //     //     ['kode_dokter' => '111', 'jenis_profesi' => 'DOKTER SPESIALIS', 'specialis' => 'SPESIALIS PENYAKIT DALAM', 'nama_dokter' => 'dr. Agung B Prasetiyono, Sp.PD', 'nik' => '1872010806720001', 'tgl_lahir' => '1972-06-08', 'jenis_kelamin' => 'L', 'agama' => 'ISLAM', 'email' => 'agungbprasetiyo91@gmail.com', 'no_hp' => '082328010445', 'alamat' => 'Jl. Kamboja No. 19 RT\/RW. 040\/007 Metro Pusat', 'kota' => 'Metro', 'provinsi' => 'Lampung', 'kode_pos' => '34111'],
    //     //     ['kode_dokter' => '111', 'jenis_profesi' => 'DOKTER SPESIALIS', 'specialis' => 'SPESIALIS PENYAKIT DALAM', 'nama_dokter' => 'dr. Agung B Prasetiyono, Sp.PD', 'nik' => '1872010806720001', 'tgl_lahir' => '1972-06-08', 'jenis_kelamin' => 'L', 'agama' => 'ISLAM', 'email' => 'agungbprasetiyo91@gmail.com', 'no_hp' => '082328010445', 'alamat' => 'Jl. Kamboja No. 19 RT\/RW. 040\/007 Metro Pusat', 'kota' => 'Metro', 'provinsi' => 'Lampung', 'kode_pos' => '34111'],
    //     // ];
    //     $items = Faker::create();

    //     foreach (range(1, 20) as $items) {
    //         Dokter::create([
    //             'kode_dokter'   => $items->kode_dokter,
    //             'jenis_profesi'   => $items->jenis_profesi,
    //             'specialis'   => $items->specialis,
    //             'nik'   => $items->nik,
    //             'tgl_lahir'   => $items->tgl_lahir,
    //             'jenis_kelamin'   => $items->jenis_kelamin,
    //             'agama'   => $items->agama,
    //             'email'   => $items->email,
    //             'no_hp'   => $items->no_hp,
    //             'alamat'   => $items->alamat,
    //             'kota'   => $items->kota,
    //             'provinsi'   => $items->provinsi,
    //             'kode_pos'   => $items->kode_pos,
    //         ]);
    //     }
    // }

    public function run()
    {
        // Make a GET request to your API endpoint
        $res = new Dokter();
        $response = $res->getData();


        // Seed the database with retrieved data
        foreach ($response as $dokterData) {
            $data = [
                'kode_dokter' => $dokterData['kode_dokter'] ?? '',
                'jenis_profesi' => $dokterData['jenis_profesi'] ?? '',
                'spesialis' => $dokterData['spesialis'] ?? '',
                'nama_dokter' => $dokterData['nama_dokter'] ?? '',
                'nik' => $dokterData['nik'] ?? '',
                'tgl_lahir' => $dokterData['tgl_lahir'] ?? '',
                'jenis_kelamin' => $dokterData['jenis_kelamin'] ?? '',
                'agama' => $dokterData['agama'] ?? '',
                'email' => $dokterData['email'] ?? '',
                'no_hp' => $dokterData['no_hp'] ?? '',
                'alamat' => $dokterData['alamat'] ?? '',
                'kota' => $dokterData['kota'] ?? '',
                'provinsi' => $dokterData['provinsi'] ?? '',
                'pemeriksaan' => $dokterData['pemeriksaan'] ?? '',
                'visit' => $dokterData['visit'] ?? '',
                'konsul' => $dokterData['konsul'] ?? '',
                'tindakan' => $dokterData['tindakan'] ?? '',
                'lain' => $dokterData['lain'] ?? '',
                // Add more fields as needed
            ];
            Dokter::insert($data);
        }
    }
}
