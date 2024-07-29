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
                <div class="breadcrumb-item active"><a href="{{ route('poliMata.index') }}">Poli</a></div>
                <div class="breadcrumb-item"><a href="{{ route('poliMata.index') }}">Mata</a></div>
                <div class="breadcrumb-item">Assesmen Perawat</div>
            </div>
        </div>

        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-bynoreg')
            <!-- components biodata pasien by no reg -->
            <div class="card card-primary">
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="card-header card-success">
                                <h4 class="card-title">Subjektif</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keluhan Utama <code>*</code></label>
                                    <textarea name="keluhan_utama" class="form-control  @error('keluhan_utama') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                </div>
                                @error('keluhan_utama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keluhan Penyakit Sekarang</label>
                                    <input type="text" name="keluhan_penyakit" class="form-control @error('keluhan_penyakit') is-invalid @enderror">
                                    @error('keluhan_penyakit')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Kehamilan</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status_kehamilan" value="Tidak" id="status_kehamilan1" @if(old('Tidak', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="status_kehamilan1">
                                                    Tidak
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status_kehamilan" value="Ya" id="status_kehamilan2" @if(old('status_kehamilan', '0' )=='Ya' ) checked @endif>
                                                <label class="form-check-label" for="status_kehamilan2">
                                                    Ya
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit Dahulu</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="riwayat_penyakit" value="Tidak Ada" id="riwayat_penyakit1" @if(old('riwayat_penyakit', '0' )=='Tidak Ada' ) checked @endif>
                                                    <label class="form-check-label" for="riwayat_penyakit1">
                                                        Tidak Ada
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="riwayat_penyakit" value="Ada" id="riwayat_penyakit1" @if(old('riwayat_penyakit', '0' )=='Ada' ) checked @endif>
                                                    <label class="form-check-label" for="riwayat_penyakit1">
                                                        Ada
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="riwayat_penyakit" class="form-control @error('riwayat_penyakit') is-invalid  
                                        @enderror" value="{{old('riwayat_penyakit')}}" placeholder="Dengan Penyakit....">
                                        </div>
                                        @error('jenis_tindakan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Alergi</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="riwayat_alergi" value="Tidak Ada" id="riwayat_alergi1" @if(old('riwayat_alergi', '0' )=='Tidak Ada' ) checked @endif>
                                                    <label class="form-check-label" for="riwayat_alergi1">
                                                        Tidak Ada
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="riwayat_alergi" value="Ada" id="riwayat_alergi2" @if(old('riwayat_alergi', '0' )=='Ada' ) checked @endif>
                                                    <label class="form-check-label" for="riwayat_alergi2">
                                                        Ada
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="riwayat_alergi" class="form-control @error('riwayat_alergi') is-invalid  
                                        @enderror" value="{{old('riwayat_alergi')}}" placeholder="Ada...">
                                        </div>
                                        @error('riwayat_alergi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Agama</label>
                                    <select name="agama" id="" class="form-control select2 @error('agama')  is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Agama--</option>
                                        <option value="Islam" @if(old('agama')=='Islam' ) selected @endif>Islam</option>
                                        <option value="Kristen" @if(old('agama')=='Kristen' ) selected @endif>Kristen</option>
                                        <option value="Katolik" @if(old('agama')=='Katolik' ) selected @endif>Katolik</option>
                                        <option value="Hindu" @if(old('agama')=='Hindu' ) selected @endif>Hindu</option>
                                        <option value="Buddha" @if(old('agama')=='Buddha' ) selected @endif>Buddha</option>
                                        <option value="Khonghucu" @if(old('agama')=='Khonghucu' ) selected @endif>Khonghucu</option>
                                    </select>
                                    @error('agama')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Status Pernikahan</label>
                                    <select name="status_nikah" id="" class="form-control select2 @error('status_nikah')  is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Status--</option>
                                        <option value="Single" @if(old('status_nikah')=='Single' ) selected @endif>Single</option>
                                        <option value="Menikah" @if(old('status_nikah')=='Menikah' ) selected @endif>Menikah</option>
                                        <option value="Janda/Duda" @if(old('status_nikah')=='Janda/Duda' ) selected @endif>Janda/Duda</option>
                                    </select>
                                    @error('status_nikah')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Pekerjaan</label>
                                    <select name="pekerjaan" id="" class="form-control select2 @error('pekerjaan')  is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Pekerjaan--</option>
                                        <option value="PNS" @if(old('pekerjaan')=='PNS' ) selected @endif>PNS</option>
                                        <option value="Karyawan Swasta" @if(old('pekerjaan')=='Karyawan Swasta' ) selected @endif>Karyawan Swasta</option>
                                        <option value="Lainnya" @if(old('pekerjaan')=='Lainnya' ) selected @endif>Lainnya</option>
                                    </select>
                                    @error('pekerjaan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Objektif</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Psikologi</label>
                                    <select name="status_psikologi" id="" class="form-control select2 @error('status_psikologi')  is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Status Psikologi--</option>
                                        <option value="Tenang" @if(old('status_psikologi')=='Tenang' ) selected @endif>Tenang</option>
                                        <option value="Cemas" @if(old('status_psikologi')=='Cemas' ) selected @endif>Cemas</option>
                                        <option value="Marah" @if(old('status_psikologi')=='Marah' ) selected @endif>Marah</option>
                                        <option value="Depresi" @if(old('status_psikologi')=='Depresi' ) selected @endif>Depresi</option>
                                    </select>
                                    @error('status_psikologi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Mental</label>
                                    <select name="status_mental" id="" class="form-control select2 @error('status_mental')  is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Status Mental--</option>
                                        <option value="Kooperatif" @if(old('status_mental')=='Kooperatif' ) selected @endif>Kooperatif</option>
                                        <option value="Tidak Kooperatif" @if(old('status_mental')=='Tidak Kooperatif' ) selected @endif>Tidak Kooperatif</option>
                                        <option value="Gelisah/Delirium/Berontak" @if(old('status_mental')=='Gelisah/Delirium/Berontak' ) selected @endif>Gelisah/Delirium/Berontak</option>
                                        <option value="Ketidak Mampuan Dalam Mengikuti Perintah" @if(old('status_mental')=='Ketidak Mampuan Dalam Mengikuti Perintah' ) selected @endif>Ketidak Mampuan Dalam Mengikuti Perintah</option>
                                    </select>
                                    @error('status_mental')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keadaan Umum</label>
                                    <input type="text" name="keadaan_umum" class="form-control @error('keadaan_umum') is-invalid  
                                        @enderror" value="{{ old('keadaan_umum')}}">
                                </div>
                                @error('keadaan_umum')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kesadaran</label>
                                    <input type="text" name="kesadaran" class="form-control @error('kesadaran') is-invalid  
                                        @enderror" value="{{ old('kesadaran')}}">
                                </div>
                                @error('kesadaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Pemeriksaan Fisik</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>R</label>
                                    <div class="input-group">
                                        <input type="text" name="vital_r" class="form-control @error('vital_r') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                        @error('vital_r')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nadi</label>
                                    <div class="input-group">
                                        <input type="text" name="nadi" class="form-control @error('nadi') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                        @error('nadi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TD</label>
                                    <div class="input-group">
                                        <input type="text" name="td" class="form-control @error('td') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>mmHg</b>
                                            </div>
                                        </div>
                                        @error('td')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suhu</label>
                                    <div class="input-group">
                                        <input type="text" name="suhu" class="form-control @error('suhu') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>C</b>
                                            </div>
                                        </div>
                                        @error('suhu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat Badan</label>
                                    <div class="input-group">
                                        <input type="text" name="berat_badan" class="form-control @error('berat_badan') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Kg</b>
                                            </div>
                                        </div>
                                        @error('berat_badan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <div class="input-group">
                                        <input type="text" name="berat_badan" class="form-control @error('berat_badan') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>M/Cm</b>
                                            </div>
                                        </div>
                                        @error('berat_badan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lingkar Kepala</label>
                                    <div class="input-group">
                                        <input type="text" name="lingkar_kepala" class="form-control @error('lingkar_kepala') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>cm</b>
                                            </div>
                                        </div>
                                        @error('lingkar_kepala')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Gizi</label>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="Baik" id="kesadaran_baik" @if(old('kesadaran', '0') == 'Baik') checked @endif>
                                                <label class="form-check-label" for="kesadaran_baik">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="status_gizi" value="Cukup" id="status_gizi1" @if(old('status_gizi', '0') == 'Cukup') checked @endif>
                                                <label class="form-check-label" for="status_gizi1">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="status_gizi" value="Kurang" id="status_gizi2" @if(old('status_gizi', '0') == 'Kurang') checked @endif>
                                                <label class="form-check-label" for="status_gizi2">
                                                    Kurang
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ADL</label>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="adl" value="Mandiri" id="adl1" @if(old('adl', '0') == 'Mandiri') checked @endif>
                                                <label class="form-check-label" for="adl1">
                                                    Mandiri
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="adl" value="Dibantu" id="adl2" @if(old('adl', '0') == 'Dibantu') checked @endif>
                                                <label class="form-check-label" for="adl2">
                                                    Dibantu
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Alat Bantu/Protesa</label>
                                    <input type="text" name="alat_bantu" class="form-control @error('alat_bantu') is-invalid @enderror">
                                    @error('alat_bantu')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Cacat Tubuh</label>
                                    <input type="text" name="cacat_tubuh" class="form-control @error('cacat_tubuh') is-invalid @enderror">
                                    @error('cacat_tubuh')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah Pasien tampak tidak seimbang(Sempoyongan/limbung)?</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="get_up" value="Ya" id="get_up1" @if(old('get_up', '0' )=='Ya' ) checked @endif>
                                                <label class="form-check-label" for="get_up1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="get_up" value="Tidak" id="get_up2" @if(old('get_up', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="get_up2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah Pasien memegang pinggiran kursi/benda lain saat akan duduk?</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="go_test" value="Ya" id="go_test1" @if(old('go_test', '0' )=='Ya' ) checked @endif>
                                                <label class="form-check-label" for="go_test1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="go_test" value="Tidak" id="go_test2" @if(old('go_test', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="go_test2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">B1 (Breathing)</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Irama Nafas</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="irama_nafas" value="Teratur" id="irama_nafas1" @if(old('irama_nafas', '0' )=='Teratur' ) checked @endif>
                                                <label class="form-check-label" for="irama_nafas1">
                                                    Teratur
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="irama_nafas" value="Tidak Teratur" id="irama_nafas2" @if(old('irama_nafas', '0' )=='Tidak Teratur' ) checked @endif>
                                                <label class="form-check-label" for="irama_nafas2">
                                                    Tidak Teratur
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Batuk</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="batuk" value="Ada" id="batuk1" @if(old('batuk', '0' )=='Ada' ) checked @endif>
                                                <label class="form-check-label" for="batuk1">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="batuk" value="Tidak" id="batuk2" @if(old('batuk', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="batuk2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Alat Bantu Nafas</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="alat_bantu" value="Ya" id="alat_bantu1" @if(old('alat_bantu', '0') == 'Ya') checked @endif>
                                                <label class="form-check-label" for="alat_bantu1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="alat_bantu" value="Tidak" id="alat_bantu2" @if(old('alat_bantu', '0') == 'Tidak') checked @endif>
                                                <label class="form-check-label" for="alat_bantu2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pola Pernafasan</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pola_pernafasan" value="Tidak Ada" id="pola_pernafasan1" @if(old('pola_pernafasan', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="pola_pernafasan2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pola_pernafasan" value="Dypsnoe" id="pola_pernafasan2" @if(old('pola_pernafasan', '0') == 'Dypsnoe') checked @endif>
                                                <label class="form-check-label" for="pola_pernafasan2">
                                                    Dypsnoe
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pola_pernafasan" value="Kusmaul" id="pola_pernafasan3" @if(old('pola_pernafasan', '0') == 'Kusmaul') checked @endif>
                                                <label class="form-check-label" for="pola_pernafasan3">
                                                    Kusmaul
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pola_pernafasan" value="Cheyne Stoke" id="pola_pernafasan4" @if(old('pola_pernafasan', '0') == 'Cheyne Stoke') checked @endif>
                                                <label class="form-check-label" for="pola_pernafasan4">
                                                    Cheyne Stoke
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suara Nafas</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="suara_nafas" value="Gargling" id="suara_nafas1" @if(old('suara_nafas', '0') == 'Gargling') checked @endif>
                                                <label class="form-check-label" for="suara_nafas1">
                                                    Gargling
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="suara_nafas" value="Snoring" id="suara_nafas2" @if(old('suara_nafas', '0') == 'Snoring') checked @endif>
                                                <label class="form-check-label" for="suara_nafas2">
                                                    Snoring
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="suara_nafas" value="Stidor" id="suara_nafas3" @if(old('suara_nafas', '0') == 'Stidor') checked @endif>
                                                <label class="form-check-label" for="suara_nafas3">
                                                    Stidor
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="suara_nafas" value="Tidak Ada" id="suara_nafas4" @if(old('suara_nafas', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="suara_nafas4">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">B2 (Blood)</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nyeri Dada</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="nyeri_dada" value="Tidak Ada" id="nyeri_dada1" @if(old('nyeri_dada', '0' )=='Tidak Ada' ) checked @endif>
                                                <label class="form-check-label" for="nyeri_dada1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="nyeri_dada" value="Ada" id="nyeri_dada2" @if(old('nyeri_dada', '0' )=='Ada' ) checked @endif>
                                                <label class="form-check-label" for="nyeri_dada2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Akral</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="akral" value="Hangat" id="akral1" @if(old('akral', '0' )=='Hangat' ) checked @endif>
                                                <label class="form-check-label" for="akral1">
                                                    Hangat
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="akral" value="Kering" id="akral2" @if(old('akral', '0' )=='Kering' ) checked @endif>
                                                <label class="form-check-label" for="akral2">
                                                    Kering
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="akral" value="Dingin" id="akral3" @if(old('akral', '0' )=='Dingin' ) checked @endif>
                                                <label class="form-check-label" for="akral3">
                                                    Dingin
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pendarahan</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pendarahan" value="Ada" id="pendarahan1" @if(old('pendarahan', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="pendarahan1">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pendarahan" value="Tidak Ada" id="pendarahan2" @if(old('pendarahan', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="pendarahan2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cyanosis</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="cyanosis" value="Tidak Ada" id="cyanosis1" @if(old('cyanosis', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="cyanosis1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="cyanosis" value="Ada" id="cyanosis2" @if(old('cyanosis', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="cyanosis2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CRT</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="crt" value="1-2" id="crt1" @if(old('crt', '0') == '1-2') checked @endif>
                                                <label class="form-check-label" for="crt1">
                                                    1-2
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="crt" value="2" id="crt2" @if(old('crt', '0') == '2') checked @endif>
                                                <label class="form-check-label" for="crt2">
                                                    2
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Turgor</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="turgor" value="Elastis" id="turgor1" @if(old('turgor', '0') == 'Elastis') checked @endif>
                                                <label class="form-check-label" for="turgor1">
                                                    Elastis
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="turgor" value="Tidak Elastis" id="turgor2" @if(old('turgor', '0') == 'Tidak Elastis') checked @endif>
                                                <label class="form-check-label" for="turgor2">
                                                    Tidak Elastis
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">B3 (Brain)</h4>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Reflek Cahaya</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="reflek_cahaya" value="Positif" id="reflek_cahaya1" @if(old('reflek_cahaya', '0' )=='Positif' ) checked @endif>
                                                <label class="form-check-label" for="reflek_cahaya1">
                                                    Positif
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="reflek_cahaya" value="Negatif" id="reflek_cahaya2" @if(old('reflek_cahaya', '0' )=='Negatif' ) checked @endif>
                                                <label class="form-check-label" for="reflek_cahaya2">
                                                    Negatif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pupil</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pupil" value="Isokor" id="pupil1" @if(old('pupil', '0' )=='Isokor' ) checked @endif>
                                                <label class="form-check-label" for="pupil1">
                                                    Isokor
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pupil" value="Anisokor" id="pupil2" @if(old('pupil', '0' )=='Anisokor' ) checked @endif>
                                                <label class="form-check-label" for="pupil2">
                                                    Anisokor
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kelumpuhan</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kelumpuhan" value="Ada" id="kelumpuhan1" @if(old('kelumpuhan', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="kelumpuhan1">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="kelumpuhan" value="Tidak Ada" id="kelumpuhan2" @if(old('kelumpuhan', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="kelumpuhan2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pusing</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pusing" value="Tidak Ada" id="pusing1" @if(old('pusing', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="pusing1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pusing" value="Ada" id="pusing2" @if(old('pusing', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="pusing2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">B4 (BAK)</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>BAK</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="bak" value="Spontan" id="bak1" @if(old('bak', '0') == 'Spontan') checked @endif>
                                                <label class="form-check-label" for="bak1">
                                                    Spontan
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="bak" value="Tidak Spontan" id="bak2" @if(old('bak', '0') == 'Tidak Spontan') checked @endif>
                                                <label class="form-check-label" for="bak2">
                                                    Tidak Spontan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nyeri Tekan</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="nyeri_tekan_bak" value="Tidak Ada" id="nyeri_tekan_bak1" @if(old('nyeri_tekan_bak', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="nyeri_tekan_bak1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="nyeri_tekan_bak" value="Ada" id="nyeri_tekan_bak2" @if(old('nyeri_tekan_bak', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="nyeri_tekan_bak2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Produksi Urine</label>
                                    <input type="text" name="produksi_urine" class="form-control @error('produksi_urine') is-invalid @enderror">
                                    @error('produksi_urine')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">B5 (Bowel)</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>BAB</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="bab" value="Normal" id="bab1" @if(old('bab', '0' )=='Normal' ) checked @endif>
                                                <label class="form-check-label" for="bab1">
                                                    Normal
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="bab" value="Cair" id="bab2" @if(old('bab', '0' )=='Cair' ) checked @endif>
                                                <label class="form-check-label" for="bab2">
                                                    Cair
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="bab" value="Konstipasi" id="bab3" @if(old('bab', '0' )=='Konstipasi' ) checked @endif>
                                                <label class="form-check-label" for="bab3">
                                                    Konstipasi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Abdomen</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="abdomen" value="Supel" id="abdomen1" @if(old('abdomen', '0' )=='Supel' ) checked @endif>
                                                <label class="form-check-label" for="abdomen1">
                                                    Supel
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="abdomen" value="Kembang" id="abdomen2" @if(old('abdomen', '0' )=='Kembang' ) checked @endif>
                                                <label class="form-check-label" for="abdomen2">
                                                    Kembang
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="abdomen" value="Ascites" id="abdomen3" @if(old('abdomen', '0' )=='Ascites' ) checked @endif>
                                                <label class="form-check-label" for="abdomen3">
                                                    Ascites
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="abdomen" value="Tegang" id="abdomen4" @if(old('abdomen', '0' )=='Tegang' ) checked @endif>
                                                <label class="form-check-label" for="abdomen4">
                                                    Tegang
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nyeri Tekan</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="nyeri_tekan_bowel" value="Ada" id="nyeri_tekan_bowel1" @if(old('nyeri_tekan_bowel', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="nyeri_tekan_bowel1">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="nyeri_tekan_bowel" value="Tidak Ada" id="nyeri_tekan_bowel2" @if(old('nyeri_tekan_bowel', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="nyeri_tekan_bowel2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jejas Abdomen</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="jejas_abdomen" value="Tidak Ada" id="jejas_abdomen1" @if(old('jejas_abdomen', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="jejas_abdomen1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="jejas_abdomen" value="Ada" id="jejas_abdomen2" @if(old('jejas_abdomen', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="jejas_abdomen2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">B6 (Bone)</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pergerakan Sendi</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pergerakan_sendi" value="Bebas" id="pergerakan_sendi1" @if(old('pergerakan_sendi', '0' )=='Bebas' ) checked @endif>
                                                <label class="form-check-label" for="pergerakan_sendi1">
                                                    Bebas
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="pergerakan_sendi" value="Terbatas" id="pergerakan_sendi2" @if(old('pergerakan_sendi', '0' )=='Terbatas' ) checked @endif>
                                                <label class="form-check-label" for="pergerakan_sendi2">
                                                    Terbatas
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dislokasi</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="dislokasi" value="Ada" id="dislokasi1" @if(old('dislokasi', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="dislokasi1">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="dislokasi" value="Tidak Ada" id="dislokasi2" @if(old('dislokasi', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="dislokasi2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fraktur</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="fraktur" value="Tidak Ada" id="fraktur1" @if(old('fraktur', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="fraktur1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="fraktur" value="Ada" id="fraktur2" @if(old('fraktur', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="fraktur2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Luka</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="luka" value="Tidak Ada" id="luka1" @if(old('luka', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="luka1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="luka" value="Ada" id="luka2" @if(old('luka', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="luka2">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="luka" value="Bersih" id="luka3" @if(old('luka', '0') == 'Bersih') checked @endif>
                                                <label class="form-check-label" for="luka3">
                                                    Bersih
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="luka" value="Kotor" id="luka4" @if(old('luka', '0') == 'Kotor') checked @endif>
                                                <label class="form-check-label" for="luka4">
                                                    Kotor
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Analisis & Rencana</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosa Keperawatan Kebidanan</label>
                                    <textarea name="diagnosa_keperawatan" class="form-control  @error('diagnosa_keperawatan') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                </div>
                                @error('diagnosa_keperawatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Masalah Keperawatan Kebidanan</label>
                                    <textarea name="masalah_keperawatan" class="form-control  @error('masalah_keperawatan') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                </div>
                                @error('masalah_keperawatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tindakan Keperawatan/Kebidanan</label>
                                    <textarea name="tindakan_keperawatan" class="form-control  @error('tindakan_keperawatan') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                </div>
                                @error('tindakan_keperawatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Edukasi</label>
                                    <select name="edukasi" id="" class="form-control select2 @error('edukasi')  is-invalid @enderror">
                                        <option value="" selected disabled>--- Pilih Data ---</option>
                                        <option value="Perjalanan Penyakit" @if(old('edukasi')=='Perjalanan Penyakit' ) selected @endif>Perjalanan Penyakit</option>
                                        <option value="Diagnosa" @if(old('edukasi')=='Diagnosa' ) selected @endif>Diagnosa</option>
                                        <option value="Pengobatan" @if(old('edukasi')=='Pengobatan' ) selected @endif>Pengobatan</option>
                                    </select>
                                    @error('edukasi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discharge Planning</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="discharge" value="Ya" id="discharge1" @if(old('discharge', '0' )=='Ya' ) checked @endif>
                                                <label class="form-check-label" for="discharge1">
                                                    Pulang
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="discharge" value="Tidak" id="discharge2" @if(old('discharge', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="discharge2">
                                                    Kontrol Poli
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="discharge" value="Tidak" id="discharge3" @if(old('discharge', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="discharge3">
                                                    Rawat Inap
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="discharge" value="Tidak" id="discharge4" @if(old('discharge', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="discharge4">
                                                    Rujuk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="card-body">
                    <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                    <div class="text-left">
                        {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                        <a href="{{ route('poliMata.assesmenAwal', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>     Simpan</a>
                    </div>
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

@endpush