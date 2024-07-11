@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
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
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Poli</a></div>
                <div class="breadcrumb-item">Poli Mata</div>
                <div class="breadcrumb-item">Assesmen Awal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no mr -->
                    {{-- @include('components.biodata-pasien-fisio-bymr') --}}
                    <!-- components biodata pasien by no mr -->
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
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('anamnesa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Riwayat Penyakit Sekarang</label>
                                            <input type="text" name="riwayat_penyakit" class="form-control @error('riwayat_penyakit') is-invalid @enderror">
                                            @error('riwayat_penyakit')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keluhan Utama</label>
                                            <input type="text" name="keluhan_utama" class="form-control @error('keluhan_utama') is-invalid @enderror">
                                            @error('keluhan_utama')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
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
                                        <h4 class="card-title">Pemeriksaan Fisik</h4>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tekanan Darah</label>
                                            <div class="input-group">
                                                <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid  
                                                @enderror">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>mmHG</b>
                                                    </div>
                                                </div>
                                                @error('tekanan_darah')
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
                                            <label>Frekuensi Nafas</label>
                                            <div class="input-group">
                                                <input type="text" name="nafas" class="form-control @error('nafas') is-invalid  
                                                @enderror">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>x/menit</b>
                                                    </div>
                                                </div>
                                                @error('nafas')
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
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="E">E</label>
                                                <input type="text" class="form-control" id="E">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="M">M</label>
                                                <input type="text" class="form-control" id="M">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="V">V</label>
                                                <input type="text" class="form-control" id="V">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>ADL</label>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="adl" value="Mandiri" id="adl1" @if(old('adl', '0' )=='Mandiri' ) checked @endif>
                                                        <label class="form-check-label" for="adl1">
                                                            Mandiri
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="adl" value="Dibantu" id="adl2" @if(old('adl', '0' )=='Dibantu' ) checked @endif>
                                                        <label class="form-check-label" for="adl2">
                                                            Dibantu
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status Gizi</label>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status_gizi" value="Baik" id="status_gizi1" @if(old('status_gizi', '0' )=='Baik' ) checked @endif>
                                                        <label class="form-check-label" for="status_gizi1">
                                                            Baik
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status_gizi" value="Cukup" id="status_gizi2" @if(old('adl', '0' )=='Cukup' ) checked @endif>
                                                        <label class="form-check-label" for="status_gizi2">
                                                            Cukup
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status_gizi" value="Kurang" id="status_gizi3" @if(old('status_gizi', '0' )=='Kurang' ) checked @endif>
                                                        <label class="form-check-label" for="status_gizi3">
                                                            Kurang
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
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
                                        <h4 class="card-title">Kepala Leher</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Konjungtiva</label>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="konjungtiva" value="Pucat" id="konjungtiva1" @if(old('konjungtiva', '0' )=='Pucat' ) checked @endif>
                                                        <label class="form-check-label" for="konjungtiva1">
                                                            Pucat
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="konjungtiva" value="Pink" id="konjungtiva2" @if(old('konjungtiva', '0' )=='Pink' ) checked @endif>
                                                        <label class="form-check-label" for="konjungtiva2">
                                                            Pink
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Skelera</label>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="skelera" value="Ikterik" id="skelera1" @if(old('skelera', '0' )=='Ikterik' ) checked @endif>
                                                        <label class="form-check-label" for="skelera1">
                                                            Ikterik
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="skelera" value="TidakIkterik" id="skelera2" @if(old('skelera', '0' )=='TidakIkterik' ) checked @endif>
                                                        <label class="form-check-label" for="skelera2">
                                                            TidakIkterik
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Bibir/Lidah</label>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bibir_lidah" value="Sianosis" id="bibir_lidah1" @if(old('bibir_lidah', '0' )=='Sianosis' ) checked @endif>
                                                        <label class="form-check-label" for="bibir_lidah1">
                                                            Sianosis
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="bibir_lidah" value="Tidak" id="bibir_lidah2" @if(old('bibir_lidah', '0' )=='Tidak' ) checked @endif>
                                                        <label class="form-check-label" for="bibir_lidah2">
                                                            Tidak
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
                                <a href="{{ route('poliMata.assesmenMata')}}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>     Simpan</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>



@endpush