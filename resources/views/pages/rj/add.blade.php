@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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
            <!-- Detail Pasien -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $rajal['NAMA_PASIEN'] ?? ''}} - ({{ $rajal['NO_MR'] ?? ''}})</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b></b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">Rekanan :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['NAMAREKANAN'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Nama Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['NAMA_DOKTER'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Jenis Kelamin :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['JENIS_KELAMIN'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1">{{ date('d-m-Y', strtotime($rajal['TGL_LAHIR'] ?? '')) }}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $rajal['ALAMAT'] ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tutup Detail Pasien -->
            <a href="{{ route('rj.resume', $rajal['NO_MR'] )}}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-primary mb-2"><i class="fas fa-download"></i>Profil Ringkas Medis Rawat Jalan</a>
            <button class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#modal-histori"><i class="fas fa-history"></i> History</button>
            <!-- form -->
            <form action="{{ route('rj.store') }}" method="post">
                @csrf
                <div class="card mb-3">
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
                <div class="card mb-3">
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
                <div class="card mb-3">
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
                                        <select name="FS_NYERIQ" id="" class="form-control select2">
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
                                        <select name="FS_NYERIP" id="" class="form-control select2">
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
                                        <select name="FS_NYERIS" id="" class="form-control select2">
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
                                        <select name="FS_NYERIT" id="" class="form-control select2">
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
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Asesmen Jatuh</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Pasien berjalan tidak seimbang / sempoyongan</label>
                                    <select name="FS_CARA_BERJALAN1" class="form-control select2" onchange="click1(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <label>
                                        Pasien berjalan menggunakan alat bantu
                                    </label>
                                    <select name="FS_CARA_BERJALAN2" class="form-control select2" onchange="click2(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>

                                </div>
                                <div class="form-group clearfix">
                                    <label for="check3">
                                        Pada saat akan duduk pasien memegang benda untuk menopang
                                    </label>
                                    <select name="FS_CARA_DUDUK" class="form-control select2" onchange="click3(this)">
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
                <div class="card mb-3">
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
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Status Psikologis, Sosial dan Fungsional </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Psikologis</label>
                                    <select name="FS_STATUS_PSIK" id="" class="form-control select2">
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
                                    <select name="FS_HUB_KELUARGA" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Baik</option>
                                        <option value="2">Tidak Baik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status fungssional</label>
                                    <select name="FS_ST_FUNGSIONAL" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Mandiri</option>
                                        <option value="2">Perlu Bantuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penglihatan</label>
                                    <select name="FS_PENGELIHATAN" id="" class="form-control select2">
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
                                    <select name="FS_PENCIUMAN" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" selected>Normal</option>
                                        <option value="2">Tidak Normal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pendengaran</label>
                                    <select name="FS_PENDENGARAN" id="" class="form-control select2">
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
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Skrining Nutrisi </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</label>
                                    <select name="FS_NUTRISI1" class="form-control select2" onchange="sn1(this)">
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
                                    <select name="FS_NUTRISI2" class="form-control select2" onchange="sn2(this)">
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
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Spiritual dan Kultural pasien</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select name="FS_AGAMA" id="" class="form-control select2">
                                        <option value="">-- Pilih Agama --</option>
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
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Keperawatan </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Masalah Keperawatan</label>
                                    <select name="tujuan[]" id="masalah_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Masalah Keperawatan" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option value="">-- pilih --</option>
                                        @foreach ($masalah_perawatan as $mk)
                                        <option value="{{ $mk['FS_KD_DAFTAR_DIAGNOSA'] }}" {{ request('tujuan') == $mk['FS_KD_DAFTAR_DIAGNOSA'] ? 'selected' : '' }}>{{ $mk['FS_NM_DIAGNOSA'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rencana Keperawatan</label>
                                    <select multiple name="tembusan[]" id="rencana_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Rencana Keperawatan" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option value="">-- pilih --</option>
                                        @foreach ($rencana_perawatan as $rp)
                                        <option value="{{ $rp['FS_KD_TRS'] }}" {{ request('tembusan') == $rp['FS_KD_TRS'] ? 'selected' : '' }}>{{ $rp['FS_NM_REN_KEP'] }}</option>
                                        @endforeach
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
    <!-- modal histori -->
    <div class="modal fade" id="modal-histori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Histori (SUPARNO BIN SUPARJO ) - (124411)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Tgl Kunjungan</th>
                                        <th style="width: 30px">Dokter</th>
                                        <th style="width: 20px">Layanan</th>
                                        <th style="width: 20px">Catatan</th>
                                        <th style="width: 10px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush