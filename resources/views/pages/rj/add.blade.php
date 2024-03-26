@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Patient</a></div>
                <div class="breadcrumb-item">Add Data</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <a href="#">Data Pasien</a>
                    </div>
                    <div class="author-box-job"><b></div>
                    <div class="author-box-description">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        No MR
                                    </div>
                                    <div class="col-md-9">
                                        : 123456
                                    </div>
                                    <div class="col-md-3">
                                        Jenis Kelamin
                                    </div>
                                    <div class="col-md-9">
                                        : Laki-Laki
                                    </div>
                                    <div class="col-md-3">
                                        Rekanan
                                    </div>
                                    <div class="col-md-9">
                                        : PT.BPJS
                                    </div>
                                    <div class="col-md-3">
                                        Dokter
                                    </div>
                                    <div class="col-md-9">
                                        : dr. Agung B Prasetiyono, Sp.PD
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Nama
                                    </div>
                                    <div class="col-md-9">
                                        : SUPARNO BIN SUPARJO
                                    </div>
                                    <div class="col-md-3">
                                        Tanggal Lahir
                                    </div>
                                    <div class="col-md-9">
                                        : 1968-10-06 00:00:00.000
                                    </div>
                                    <div class="col-md-3">
                                        Alamat
                                    </div>
                                    <div class="col-md-9">
                                        : DUSUN IV RT/RW 010/006 SIDO MULYO PUNGGUR LAMPUNG TENGAH
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-sm btn-primary mb-2 "><i class="fas fa-download"></i> Profil Ringkas Medis Rawat Jalan</button>
            <div class="card">
                <!-- include form -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="card-title">High Risk : -</h4>
                        </div>

                        <div class="col-md-12">
                            <h4 class="card-title">Alergi : - (-)</h5>
                        </div>
                    </div>
                </div>
                <!-- include form -->
            </div>
            <!-- form -->
            <form action="#" method="post">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Allowanamnesa dan Pemeriksaan Fisik</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                    <textarea class="form-control" rows="3" name="FS_ANAMNESA" value="" placeholder="Masukan ..."></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pemeriksaan Fisik</label>
                                    <textarea class="form-control" rows="3" name="FS_EDUKASI" value="" placeholder="Masukan ..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card">
                    <div class="card-header card-success">
                        <h4 class="card-title">Vital Sign</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suhu</label>
                                    <input type="text" name="FS_SUHU" class="form-control" name="FS_SUHU" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nadi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="FS_NADI" value="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Respirasi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_R" value="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tekanan Darah</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_TD" value="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="FS_TB" value="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat Badan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="FS_BB" value="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Asasmen Nyeri</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ada Nyeri?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NYERI" id="exampleRadios1" value="1">
                                        <label class="form-check-label" for="exampleRadios1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NYERI" id="exampleRadios2" value="0" checked>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quality</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIQ" id="" class="form-control">

                                            <option value="0">Tidak Ada</option>
                                            <option value="1">Seperti Di Tusuk-Tusuk</option>
                                            <option value="2">Seperti Terbakar</option>
                                            <option value="3">Seperti Tertimpa Beban</option>
                                            <option value="4">Ngilu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Provokatif</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIP" id="" class="form-control">

                                            <option value="0">Tidak Ada Nyeri</option>
                                            <option value="2">Biologik</option>
                                            <option value="3">Kimiawi</option>
                                            <option value="4">Mekanik / Rudapaksa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Severity</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIS" id="" class="form-control">

                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Regio</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_NYERIR" value="-">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIT" id="" class="form-control">

                                            <option value="0">Tidak Ada</option>
                                            <option value="1">Kadang-Kadang</option>
                                            <option value="2">Sering</option>
                                            <option value="3">Menetap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Asesmen Jatuh</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Pasien berjalan tidak seimbang / sempoyongan</label>
                                    <select name="FS_CARA_BERJALAN1" class="form-control" onchange="click1(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <label>
                                        Pasien berjalan menggunakan alat bantu
                                    </label>
                                    <select name="FS_CARA_BERJALAN2" class="form-control" onchange="click2(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>

                                </div>
                                <div class="form-group clearfix">
                                    <label for="check3">
                                        Pada saat akan duduk pasien memegang benda untuk menopang
                                    </label>
                                    <select name="FS_CARA_DUDUK" class="form-control" onchange="click3(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="hasil_check1">
                            <input type="hidden" id="hasil_check2">
                            <input type="hidden" id="hasil_check3">

                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary4" name="intervensi1" value="Ya">
                                        <label for="checkboxPrimary4">
                                            Edukasi
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary5" name="intervensi2" value="Ya">
                                        <label for="checkboxPrimary5">
                                            Pasang Stiker Resiko Jatuh (*resiko tinggi)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <label for="kesimpulan" class="col-sm-2 col-form-label">Kesimpulan : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="kesimpulan_asesmen_jatuh" readonly>
                            </div>

                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Riwayat Kesehatan & Alergi</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit Dahulu</label>
                                    <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit keluarga</label>
                                    <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU2" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Alergi<code>*</code></label>
                                    <input type="text" class="form-control" name="FS_ALERGI" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reaksi Alergi<code>*</code></label>
                                    <input type="text" class="form-control" name="FS_REAK_ALERGI" value="">
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-success">
                        <h4 class="card-title">Status Psikologis, Sosial dan Fungsional </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Psikologis</label>
                                    <select name="FS_STATUS_PSIK" id="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1" onclick='document.getElementById("civstaton3").disabled = true' selected>Tenang</option>
                                        <option value="2" onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
                                        <option value="3" onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
                                        <option value="4" onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
                                        <option value="5" onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
                                        <option VALUE="6" onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
                                    </select>
                                    <input type="hidden" name="FS_STATUS_PSIK2" id="civstaton3" size="32">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hubungan Dengan Anggota Keluarga</label>
                                    <select name="FS_HUB_KELUARGA" id="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Baik</option>
                                        <option value="2">Tidak Baik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status fungssional</label>
                                    <select name="FS_ST_FUNGSIONAL" id="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Mandiri</option>
                                        <option value="2">Perlu Bantuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penglihatan</label>
                                    <select name="FS_PENGELIHATAN" id="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Normal</option>
                                        <option value="2">Kabur</option>
                                        <option value="3">Kaca Mata</option>
                                        <option value="4">Lensa Kontak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penciuman</label>
                                    <select name="FS_PENCIUMAN" id="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Normal</option>
                                        <option value="2">Tidak Normal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendengaran</label>
                                    <select name="FS_PENDENGARAN" id="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Normal</option>
                                        <option value="2">Tidak Normal (Kanan)</option>
                                        <option value="3">Tidak Normal (Kiri)</option>
                                        <option value="4">Tidak Normal (Kanan & Kiri)</option>
                                        <option value="5">Alat Bantu Dengar (Kanan)</option>
                                        <option value="6">Alat Bantu Dengar (Kiri)</option>
                                        <option value="7">Alat Bantu Dengar (Kanan & Kiri)</option>
                                    </select>
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-success">
                        <h4 class="card-title">Skrining Nutrisi </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</label>
                                    <select name="FS_NUTRISI1" class="form-control" onchange="sn1(this)">
                                        <option value="">-- pilih --</option>
                                        <option value="0">Tidak</option>
                                        <option value="1">Tidak Yakin</option>
                                        <option value="2">Ya (1-5 Kg)</option>
                                        <option value="3">Ya (6-10 Kg)</option>
                                        <option value="4">Ya (11-15 Kg)</option>
                                        <option value="5">Ya (>15 Kg)</option>
                                    </select>
                                    <input type="hidden" id="hasil_sn1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</label>
                                    <select name="FS_NUTRISI2" class="form-control" onchange="sn2(this)">
                                        <option value="">-- pilih --</option>
                                        <option value="0">Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                    <input type="hidden" id="hasil_sn2">
                                </div>
                            </div>
                            <label for="kesimpulan" class="col-sm-2 col-form-label">Kesimpulan : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="kesimpulan_skrining_nutrisi" readonly>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-success">
                        <h4 class="card-title">Spiritual dan Kultural pasien</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select name="FS_AGAMA" id="" class="form-control">

                                        <option value="1">Islam</option>
                                        <option value="2">Kristen</option>
                                        <option value="3">Katholik</option>
                                        <option value="4">Hindu</option>
                                        <option value="5">Buda</option>
                                        <option value="6">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nilai/Kepercayaan khusus</label>
                                    <!-- <input type="text" class="form-control" name="FS_NILAI_KHUSUS" value=""> -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NILAI_KHUSUS" id="exampleRadios1" value="2" onclick='document.getElementById("civstaton4").disabled = true'>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NILAI_KHUSUS" id="exampleRadios2" value="1" checked onclick='document.getElementById("civstaton4").disabled = true'>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <!-- <input type="text" name="FS_NILAI_KHUSUS2" id="civstaton4" disabled size="32"> -->
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header card-success">
                        <h4 class="card-title">Keperawatan </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Masalah Keperawatan</label>
                                    <select multiple="" name="tujuan[]" id="" class="form-control select2bs4">
                                        <option value="">-- pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rencana Keperawatan</label>
                                    <select multiple name="tembusan[]" id="" class="form-control select2bs4">
                                        <option value="">-- pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pasien terduga TB (Kode ICD 10 bila terdiagnosa TBC)</label>
                                    <select name="kode_icd_x" id="" class="form-control select2bs4">
                                        <option value="">-- pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Expired Rujukan (jika pasien BPJS)</label>
                                    <input type="date" name="FS_SKDP_FASKES" id="" class="form-control" value="">
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
                <!-- button -->
                <!-- form -->
            </form>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush