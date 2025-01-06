@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.pre-operasi.index') }}">Operasi</a></div>
                <div class="breadcrumb-item">Pre Operasi</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('operasi.pre-operasi.update',$biodata->kode_register) }}" method="POST">
                @csrf
                @method('put')
                {{-- Data UMUM --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Data Umum</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                                <div class="form-group">
                                    <label>Diagnosa</label>
                                    <input type="text" name="diagnosa" value="{{ $preOperasi['dataUmum']->diagnosa ?? '' }}" class="form-control @error('diagnosa') is-invalid @enderror">
                                    @error('diagnosa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Operasi</label>
                                    <input type="text" name="jenis_operasi" value="{{ $preOperasi['dataUmum']->jenis_operasi ?? '' }}"  class="form-control @error('jenis_operasi') is-invalid @enderror">
                                    @error('jenis_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokter Operator</label>
                                    <input type="text" name="nama_operator" value="{{ $preOperasi['dataUmum']->nama_operator ?? '' }}" class="form-control @error('nama_operator') is-invalid @enderror" readonly>
                                    @error('nama_operator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Makan Minum terakhir / Puasa Jam</label>
                                    <input type="text" name="puasa_jam" value="{{ $preOperasi['dataUmum']->puasa_jam ?? '' }}" class="form-control @error('puasa_jam') is-invalid @enderror">
                                    @error('puasa_jam')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Asma</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="riwayat_asma" id="riwayat_asma1" value="1" {{ ($preOperasi['dataUmum']->riwayat_asma =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riwayat_asma1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="riwayat_asma" id="riwayat_asma2" value="0" {{ ($preOperasi['dataUmum']->riwayat_asma =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riwayat_asma2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alergi</label>
                                    <input type="text" name="alergi" value="{{ $preOperasi['dataUmum']->alergi ?? '' }}" class="form-control @error('alergi') is-invalid @enderror">
                                    @error('alergi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Antibiotik Profilaksis</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{ $preOperasi['dataUmum']->antibiotik_profilaksis ?? '' }}" name="antibiotik_profilaksis" id="antibiotik_profilaksis">
                                            </div>
                                            <div class="input-group" style="margin-right: 10px;">
                                                <label for="antibiotik_profilaksis_jam" class="ml-2 mr-2 mt-2">
                                                    Jam
                                                </label>
                                                <input type="text" class="form-control" value="{{ $preOperasi['dataUmum']->antibiotik_profilaksis_jam ?? '' }}" name="antibiotik_profilaksis_jam" id="antibiotik_profilaksis_jam">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                {{-- Pemeriksaan Fisik --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Pemeriksaan Fisik</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>P</label>
                                    <div class="input-group">
                                        <input type="text" name="pernafasan" value="{{ $preOperasi['ttv']->pernafasan ?? '' }}" id="pernafasan" placeholder="masukkan hanya angka" class="form-control @error('pernafasan') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                    </div>
                                    @error('pernafasan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nadi</label>
                                    <div class="input-group">
                                        <input type="text" name="nadi" value="{{ $preOperasi['ttv']->nadi ?? '' }}" id="nadi" placeholder="masukkan hanya angka" class="form-control @error('nadi') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                    </div>
                                    @error('nadi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tekanan Darah</label><code> (contoh : 110/90)</code>
                                    <div class="input-group">
                                        <input type="text" name="tekanan_darah" id="tekanan_darah" value="{{ $preOperasi['ttv']->tekanan_darah ?? '' }}" placeholder="masukkan hanya angka" class="form-control @error('tekanan_darah') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>mmHg</b>
                                            </div>
                                        </div>
                                    </div>
                                    @error('tekanan_darah')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suhu</label><code> (gunakan tanda . contoh : 36.5)</code>
                                    <div class="input-group">
                                        <input type="text" name="suhu" id="suhu" value="{{ $preOperasi['ttv']->suhu ?? '' }}" placeholder="masukkan hanya angka" class="form-control @error('suhu') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>C</b>
                                            </div>
                                        </div>
                                    </div>
                                    @error('suhu')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat Badan</label><code> (jika kosong beri tanda -)</code>
                                    <div class="input-group">
                                        <input type="text" name="berat_badan" id="berat_badan" value="{{ $preOperasi['ttv']->berat_badan ?? '' }}" placeholder="masukkan hanya angka" class="form-control @error('berat_badan') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Kg</b>
                                            </div>
                                        </div>
                                    </div>
                                    @error('berat_badan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tinggi Badan</label><code> (jika kosong beri tanda -)</code>
                                    <div class="input-group">
                                        <input type="text" name="tinggi_badan" id="tinggi_badan" value="{{ $preOperasi['ttv']->tinggi_badan ?? '' }}" placeholder="masukkan hanya angka" class="form-control @error('tinggi_badan') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>M/Cm</b>
                                            </div>
                                        </div>
                                    </div>
                                    @error('tinggi_badan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                {{-- Persiapan Pre Operasi --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Persiapan Pre Operasi</h6>
                    </div>
                    <div class="card-body card-khusus-body">
                        <div class="table-responsive">
                            <table class="table-striped table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tindakan</th>
                                        <th scope="col">Isi</th>
                                        <th scope="col">Ya</th>
                                        <th scope="col">Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Melapor Ke Dokter Bedah</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lapor_dokter" id="lapor_dokter1" value="1" {{ ($preOperasi['tindakan']->lapor_dokter =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lapor_dokter1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lapor_dokter" id="lapor_dokter2" value="0" {{ ($preOperasi['tindakan']->lapor_dokter =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lapor_dokter2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Melapor Ke Kamar Bedah</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lapor_kamar" id="lapor_kamar1" value="1" {{ ($preOperasi['tindakan']->lapor_kamar =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lapor_kamar1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lapor_kamar" id="lapor_kamar2" value="0" {{ ($preOperasi['tindakan']->lapor_kamar =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lapor_kamar2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Mengisi surat izin pembedahan dan Anestesi</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="surat_izin_pembedahan" id="izin_pembedahan1" value="1" {{ ($preOperasi['tindakan']->surat_izin_pembedahan =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="izin_pembedahan1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="surat_izin_pembedahan" id="izin_pembedahan2" value="0" {{ ($preOperasi['tindakan']->surat_izin_pembedahan =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="izin_pembedahan2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Menandai Daerah Operasi</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tandai_daerah_operasi" id="tandai_operasi1" value="1" {{ ($preOperasi['tindakan']->tandai_daerah_operasi =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tandai_operasi1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="tandai_daerah_operasi" id="tandai_operasi2" value="0" {{ ($preOperasi['tindakan']->tandai_daerah_operasi =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tandai_operasi2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Memakai Gelang Identitas</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memakai_gelang_identitas" id="geland_identitas1" value="1" {{ ($preOperasi['tindakan']->memakai_gelang_identitas =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="geland_identitas1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memakai_gelang_identitas" id="geland_identitas2" value="0" {{ ($preOperasi['tindakan']->memakai_gelang_identitas =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="geland_identitas2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Melepas gigi palsu, Soflens, Aksesoris, Hearin Aids</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="melepas_aksesoris" id="melepas_aksesoris1" value="1" {{ ($preOperasi['tindakan']->melepas_aksesoris =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="melepas_aksesoris1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="melepas_aksesoris" id="melepas_aksesoris2" value="0" {{ ($preOperasi['tindakan']->melepas_aksesoris =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="melepas_aksesoris2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Menghapus lipstick, Cat kuku</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="menghapus_aksesoris" id="menghapus_aksesoris1" value="1" {{ ($preOperasi['tindakan']->menghapus_aksesoris =='1') ? 'checked' : '' }}> 
                                                <label class="form-check-label" for="menghapus_aksesoris1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="menghapus_aksesoris" id="menghapus_aksesoris2" value="0" {{ ($preOperasi['tindakan']->menghapus_aksesoris =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="menghapus_aksesoris2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Melakukan Oral Hygiene Lavenment</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="melakukan_oral_hygiene" id="oral_hygiene1" value="1" {{ ($preOperasi['tindakan']->melakukan_oral_hygiene =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="oral_hygiene1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="melakukan_oral_hygiene" id="oral_hygiene2" value="0" {{ ($preOperasi['tindakan']->melakukan_oral_hygiene =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="oral_hygiene2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Memasang Bidai, Fiksasi leher</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_bidai" id="memasang_bidai_fiksasi1" value="1" {{ ($preOperasi['tindakan']->memasang_bidai =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_bidai_fiksasi1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_bidai" id="memasang_bidai_fiksasi2" value="0" {{ ($preOperasi['tindakan']->memasang_bidai =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_bidai_fiksasi2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Memasang Infuse</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_infuse" id="memasang_infuse1" value="1" {{ ($preOperasi['tindakan']->memasang_infuse =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_infuse1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_infuse" id="memasang_infuse2" value="0" {{ ($preOperasi['tindakan']->memasang_infuse =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_infuse2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Memasang DC</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="deskripsi_dc" class="form-control" placeholder="No :" value="{{ $preOperasi['tindakan']->deskripsi_dc ?? '' }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_dc" id="memasang_dc1" value="1" {{ ($preOperasi['tindakan']->memasang_dc =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_dc1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_dc" id="memasang_dc2" value="0" {{ ($preOperasi['tindakan']->memasang_dc =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_dc2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Memasang NGT</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="deskripsi_ngt" class="form-control" placeholder="No :" value="{{ $preOperasi['tindakan']->deskripsi_ngt ?? '' }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_ngt" id="memasang_ngt1" value="1" {{ ($preOperasi['tindakan']->memasang_ngt =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_ngt1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_ngt" id="memasang_ngt2" value="0" {{ ($preOperasi['tindakan']->memasang_ngt =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_ngt2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Memasang Drainage</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_drainage" id="memasang_drainage1" value="1" {{ ($preOperasi['tindakan']->memasang_drainage =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_drainage1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_drainage" id="memasang_drainage2" value="0" {{ ($preOperasi['tindakan']->memasang_drainage =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_drainage2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Memasang WSD</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_wsd" id="memasang_wsd1" value="1" {{ ($preOperasi['tindakan']->memasang_wsd =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_wsd1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="memasang_wsd" id="memasang_wsd2" value="0" {{ ($preOperasi['tindakan']->memasang_wsd =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="memasang_wsd2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Mencukur Daerah Operasi</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="mencukur_daerah_operasi" id="mencukur_daerah1" value="1" {{ ($preOperasi['tindakan']->mencukur_daerah_operasi =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mencukur_daerah1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="mencukur_daerah_operasi" id="mencukur_daerah2" value="0" {{ ($preOperasi['tindakan']->mencukur_daerah_operasi =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="mencukur_daerah2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>Lain-lain</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="deskripsi_lainnya" class="form-control" value="{{ $preOperasi['tindakan']->deskripsi_lainnya ?? '' }}" placeholder="Lainnya...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lainnya" id="lain_lain1" value="1" {{ ($preOperasi['tindakan']->lainnya =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lain_lain1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lainnya" id="lain_lain2" value="0" {{ ($preOperasi['tindakan']->lainnya =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lain_lain2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table-striped table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Penyakit Kronis</th>
                                        <th scope="col">Ya</th>
                                        <th scope="col">Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>DM</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_dm" id="dm1" value="1" {{ ($preOperasi['tindakan']->penyakit_dm =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="dm1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_dm" id="dm2" value="0" {{ ($preOperasi['tindakan']->penyakit_dm =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="dm2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Hipertensi</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_hipertensi" id="hipertensi1" value="1" {{ ($preOperasi['tindakan']->penyakit_hipertensi =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hipertensi1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_hipertensi" id="hipertensi2" value="0" {{ ($preOperasi['tindakan']->penyakit_hipertensi =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hipertensi2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>TB Paru</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_tb_paru" id="tb_paru1" value="1" {{ ($preOperasi['tindakan']->penyakit_tb_paru =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tb_paru1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_tb_paru" id="tb_paru2" value="0" {{ ($preOperasi['tindakan']->penyakit_tb_paru =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tb_paru2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>HIV / AIDS</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_hiv" id="hiv_aids1" value="1" {{ ($preOperasi['tindakan']->penyakit_hiv =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hiv_aids1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_hiv" id="hiv_aids2" value="0" {{ ($preOperasi['tindakan']->penyakit_hiv =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hiv_aids2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Hepatitis B-C-A</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_hepatitis" id="hepatitis1" value="1" {{ ($preOperasi['tindakan']->penyakit_hepatitis =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hepatitis1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_hepatitis" id="hepatitis2" value="0" {{ ($preOperasi['tindakan']->penyakit_hepatitis =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="hepatitis2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Data Lainnya --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Data Lainnya</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Premedikasi</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="premedikasi" value="{{ $preOperasi['dataUmum']->premedikasi ?? '' }}" id="premedikasi">
                                            </div>
                                            <div class="input-group" style="margin-right: 10px;">
                                                <label for="premedikasi_jam" class="ml-2 mr-2 mt-2">
                                                    Jam
                                                </label>
                                                <input type="text" class="form-control" name="premedikasi_jam" value="{{ $preOperasi['dataUmum']->premedikasi_jam ?? '' }}" id="premedikasi_jam">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IVFD</label>
                                    <div class="input-group">
                                        <input type="text" name="ivfd" value="{{ $preOperasi['dataUmum']->ivfd ?? '' }}" id="ivfd" placeholder="masukkan hanya angka" class="form-control @error('ivfd') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>tts/menit</b>
                                            </div>
                                        </div>
                                        @error('ivfd')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>DC No:</label>
                                    <input type="text" name="dc" value="{{ $preOperasi['dataUmum']->dc ?? '' }}" class="form-control @error('dc') is-invalid @enderror">
                                    @error('dc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Catatan Medis :</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="assesmen_pra_bedah" id="flexCheckDefault" value="1"  {{ $preOperasi['dataUmum'] && $preOperasi['dataUmum']->assesmen_pra_bedah ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Asesmen Pra Bedah
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="informed_consent_bedah" id="flexCheckDefault" value="1"  {{ $preOperasi['dataUmum'] && $preOperasi['dataUmum']->informed_consent_bedah ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Informed Consent Bedah
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="informed_consent_anastesi" id="flexCheckDefault" value="1"  {{ $preOperasi['dataUmum'] && $preOperasi['dataUmum']->informed_consent_anastesi ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Informed Consent Anestesi / Sedasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="edukasi_anastesi" id="flexCheckDefault" value="1" {{ $preOperasi['dataUmum'] && $preOperasi['dataUmum']->edukasi_anastesi ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Edukasi Anestesi
                                                </label>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Obat - obat</label>
                                    <input type="text" name="obat" value="{{ $preOperasi['dataUmum']->obat ?? '' }}" class="form-control @error('obat') is-invalid @enderror">
                                    @error('obat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto Rontgen</label>
                                    <input type="text" name="rontgen" value="{{ $preOperasi['dataUmum']->rontgen ?? '' }}" class="form-control @error('rontgen') is-invalid @enderror">
                                    @error('rontgen')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Darah</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{ $preOperasi['dataUmum']->darah ?? '' }}" name="darah" id="darah">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>cc</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group" style="margin-right: 10px;">
                                                <label for="gol" class="ml-2 mr-2 mt-2">
                                                    Gol :
                                                </label>
                                                <input type="text" class="form-control" value="{{ $preOperasi['dataUmum']->gol ?? '' }}" name="gol" id="gol">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                
                <div class="text-left">
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

{{-- SCRIPT VITAL SIGN --}}
<script>
    document.getElementById('tekanan_darah').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('suhu').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('nadi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('berat_badan').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('tinggi_badan').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('pernafasan').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

@endpush