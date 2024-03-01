<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    public function get_select($no_mr, $no_bpjs, $nik, $nama) // Menampilkan Data Select berdasarkan NO MR, BPJS, NIK, NAMA
    {
        $this->db->select("NOID as id, No_MR AS no_mr, Nama_Pasien AS nama_pasien, No_Identitas AS no_bpjs, HP2 AS nik,
        COALESCE(Telp_Rumah, HP1) as no_hp, Tgl_Lahir AS tanggal_lahir, Jenis_Kelamin AS jenis_kelamin");
        $this->db->from('REGISTER_PASIEN rp');
        if ($no_mr) {
            $this->db->where('No_MR', $no_mr);
        }
        if ($no_bpjs) {
            $this->db->where('No_Identitas', $no_bpjs);
        }
        if ($nik) {
            $this->db->where('HP2', $nik);
        }
        if ($nama) {
            $this->db->like('Nama_Pasien', $nama);
        }
        $this->db->order_by('Tgl_Register', 'DESC');
        $this->db->limit('1000');
        $query = $this->db->get();
        return $query->result();
    }
}
