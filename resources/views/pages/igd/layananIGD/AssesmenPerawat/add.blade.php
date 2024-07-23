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
                <div class="breadcrumb-item active"><a href="{{ route('layanan.assesmenPerawat') }}">Layanan IGD</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.assesmenPerawat') }}">Assesmen</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.assesmenPerawatAdd') }}">Perawat</a></div>
                <div class="breadcrumb-item">Add</div>
            </div>
        </div>

        <div class="section-body">
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
                            <div class="card-header card-success">
                                <h4 class="card-title">Assesmen Nyeri</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ada Nyeri ?</label>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ada_nyeri" value="Ya" id="ada_nyeri1" @if(old('ada_nyeri', '0' )=='Ya' ) checked @endif>
                                                <label class="form-check-label" for="ada_nyeri1">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="ada_nyeri" value="Tidak" id="ada_nyeri2" @if(old('ada_nyeri', '0' )=='Tidak' ) checked @endif>
                                                <label class="form-check-label" for="ada_nyeri2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Provakatif</label>
                                    <select name="provakatif" id="" class="form-control select2 @error('provakatif')  is-invalid @enderror">
                                        <option value="Tidak Ada" @if(old('provakatif')=='Tidak Ada' ) selected @endif>Tidak Ada</option>
                                        <option value="Aktivitas" @if(old('provakatif')=='Aktivitas' ) selected @endif>Aktivitas</option>
                                        <option value="Spontan" @if(old('provakatif')=='Spontan' ) selected @endif>Spontan</option>
                                        <option value="Stres" @if(old('provakatif')=='Stres' ) selected @endif>Stres</option>
                                    </select>
                                    @error('provakatif')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <select name="time" id="" class="form-control select2 @error('time')  is-invalid @enderror">
                                        <option value="Tidak Ada" @if(old('time')=='Tidak Ada' ) selected @endif>Tidak Ada</option>
                                        <option value="Kadang-kadang" @if(old('time')=='Kadang-kadang' ) selected @endif>Kadang-kadang</option>
                                        <option value="Sering" @if(old('time')=='Sering' ) selected @endif>Sering</option>
                                        <option value="Menetap" @if(old('time')=='Menetap' ) selected @endif>Menetap</option>
                                    </select>
                                    @error('time')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quality</label>
                                    <select name="quality" id="" class="form-control select2 @error('quality')  is-invalid @enderror">
                                        <option value="Tidak Ada" @if(old('quality')=='Tidak Ada' ) selected @endif>Tidak Ada</option>
                                        <option value="Seperti Di Tusuk-Tusuk" @if(old('quality')=='Seperti Di Tusuk-Tusuk' ) selected @endif>Seperti Di Tusuk-Tusuk</option>
                                        <option value="Seperti Terbakar" @if(old('quality')=='Seperti Terbakar' ) selected @endif>Seperti Terbakar</option>
                                        <option value="Seperti Tertimpa Beb" @if(old('quality')=='Seperti Tertimpa Beb' ) selected @endif>Seperti Tertimpa Beb</option>
                                        <option value="Ngilu" @if(old('quality')=='Ngilu' ) selected @endif>Ngilu</option>
                                    </select>
                                    @error('quality')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Severity</label>
                                    <select name="severity" id="" class="form-control select2 @error('severity')  is-invalid @enderror">
                                        <option value="0" @if(old('severity')=='0' ) selected @endif>0</option>
                                        <option value="1" @if(old('severity')=='1' ) selected @endif>1</option>
                                        <option value="2" @if(old('severity')=='2' ) selected @endif>2</option>
                                        <option value="3" @if(old('severity')=='3' ) selected @endif>3</option>
                                        <option value="4" @if(old('severity')=='4' ) selected @endif>4</option>
                                        <option value="5" @if(old('severity')=='5' ) selected @endif>5</option>
                                        <option value="6" @if(old('severity')=='6' ) selected @endif>6</option>
                                        <option value="7" @if(old('severity')=='7' ) selected @endif>7</option>
                                        <option value="8" @if(old('severity')=='8' ) selected @endif>8</option>
                                        <option value="9" @if(old('severity')=='9' ) selected @endif>9</option>
                                        <option value="10" @if(old('severity')=='10' ) selected @endif>10</option>
                                    </select>
                                    @error('severity')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Regio</label>
                                    <input type="text" name="regio" class="form-control @error('regio') is-invalid @enderror">
                                    @error('regio')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
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
                                <h4 class="card-title">Assesmen Jatuh Dewasa Morse Fall Scale (>18-65 Tahun)</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Jatuh</label>
                                    <select name="riwayat_jatuh" id="" class="form-control select2 @error('riwayat_jatuh')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Data --</option>
                                        <option value="< 3 Bulan" @if(old('riwayat_jatuh')=='< 3 Bulan' ) selected @endif>< 3 Bulan</option>
                                        <option value="Tidak ada atau > 3 bulan" @if(old('riwayat_jatuh')=='Tidak ada atau > 3 bulan' ) selected @endif>Tidak ada atau > 3 bulan</option>
                                    </select>
                                    @error('riwayat_jatuh')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Diagnosa Medis Sekunder</label>
                                    <select name="diagnosa_medis" id="" class="form-control select2 @error('diagnosa_medis')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Data --</option>
                                        <option value="> 1 Diagnosa Penyakit" @if(old('diagnosa_medis')=='> 1 Diagnosa Penyakit' ) selected @endif>> 1 Diagnosa Penyakit</option>
                                        <option value="<= 1 Diagnosa Penyakit" @if(old('diagnosa_medis')=='<= 1 Diagnosa Penyakit' ) selected @endif><= 1 Diagnosa Penyakit</option>
                                    </select>
                                    @error('diagnosa_medis')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alat Bantu Jalan</label>
                                    <select name="alat_bantu_jalan" id="" class="form-control select2 @error('alat_bantu_jalan')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Data --</option>
                                        <option value="Perabot" @if(old('alat_bantu_jalan')=='Perabot' ) selected @endif>Perabot</option>
                                        <option value="Tongkat/Penopang" @if(old('alat_bantu_jalan')=='Tongkat/Penopang' ) selected @endif>Tongkat/Penopang</option>
                                        <option value="Tidak ada/Tirah baring" @if(old('alat_bantu_jalan')=='Tidak ada/Tirah baring' ) selected @endif>Tidak ada/Tirah baring</option>
                                    </select>
                                    @error('alat_bantu_jalan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Terapi IV / anti koagulan</label>
                                    <select name="terapi_iv" id="" class="form-control select2 @error('terapi_iv')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Data --</option>
                                        <option value="Terapi IV terus menerus" @if(old('terapi_iv')=='Terapi IV terus menerus' ) selected @endif>Terapi IV terus menerus</option>
                                        <option value="Tidak" @if(old('terapi_iv')=='Tidak' ) selected @endif>Tidak</option>
                                    </select>
                                    @error('terapi_iv')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gaya Berjalan</label>
                                    <select name="gaya_berjalan" id="" class="form-control select2 @error('gaya_berjalan')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Data --</option>
                                        <option value="Kerusakan" @if(old('gaya_berjalan')=='Kerusakan' ) selected @endif>Kerusakan</option>
                                        <option value="Lemah" @if(old('gaya_berjalan')=='Lemah' ) selected @endif>Lemah</option>
                                        <option value="Normal" @if(old('gaya_berjalan')=='Normal' ) selected @endif>Normal</option>
                                    </select>
                                    @error('gaya_berjalan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status Mental</label>
                                    <select name="status_mental" id="" class="form-control select2 @error('status_mental')  is-invalid @enderror">
                                        <option value="" selected disabled>-- Pilih Data --</option>
                                        <option value="Lupa keterbatasan" @if(old('status_mental')=='Lupa keterbatasan' ) selected @endif>Lupa keterbatasan</option>
                                        <option value="Sadar kemampuan diri" @if(old('status_mental')=='Sadar kemampuan diri' ) selected @endif>Sadar kemampuan diri</option>
                                    </select>
                                    @error('status_mental')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kesimpulan</label>
                                    <input type="text" name="kesimpulan" class="form-control @error('kesimpulan') is-invalid  
                                        @enderror" value="{{ old('kesimpulan')}}">
                                </div>
                                @error('kesimpulan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Assesmen Resiko Dekubitus</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Apakah Pasien menggunakan kursi roda/mmembutuhkan bantuan ?</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="bantuan" id="" class="form-control select2 @error('bantuan')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Ya" @if(old('bantuan')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('bantuan')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                        </div>
                                        @error('bantuan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Apakah ada inkontinensiauri / alvi?</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="alvi" id="" class="form-control select2 @error('alvi')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Ya" @if(old('alvi')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('alvi')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                        </div>
                                        @error('alvi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Apakah ada riwayat dekubitus atau luka dekubitus?</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="dekubitus" id="" class="form-control select2 @error('dekubitus')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Ya" @if(old('dekubitus')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('dekubitus')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                        </div>
                                        @error('dekubitus')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Apakah Usia diatas 65 tahun?</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="usia_65" id="" class="form-control select2 @error('usia_65')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Ya" @if(old('usia_65')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('usia_65')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                        </div>
                                        @error('usia_65')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Apakah Ekstremitas dan badan tidak sesuai dengan usia perkembangan?</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="ekstremitas" id="" class="form-control select2 @error('ekstremitas')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Ya" @if(old('ekstremitas')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('ekstremitas')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                        </div>
                                        @error('ekstremitas')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Skrining Nutrisi</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="berat_badan" id="" class="form-control select2 @error('berat_badan')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Tidak" @if(old('berat_badan')=='Tidak' ) selected @endif>Tidak</option>
                                                <option value="Tidak Yakin" @if(old('berat_badan')=='Tidak Yakin' ) selected @endif>Tidak Yakin</option>
                                                <option value="Ya (1-5Kg)" @if(old('berat_badan')=='Ya (1-5Kg)' ) selected @endif>Ya (1-5Kg)</option>
                                                <option value="Ya (6-10Kg)" @if(old('berat_badan')=='Ya (6-10Kg)' ) selected @endif>Ya (6-10Kg)</option>
                                                <option value="Ya (11-15Kg)" @if(old('berat_badan')=='Ya (11-15Kg)' ) selected @endif>Ya (11-15Kg)</option>
                                                <option value="Ya (>15Kg)" @if(old('berat_badan')=='Ya (>15Kg)' ) selected @endif>Ya (>15Kg)</option>
                                            </select>
                                        </div>
                                        @error('berat_badan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="asupan_makan" id="" class="form-control select2 @error('asupan_makan')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih Data --</option>
                                                <option value="Ya" @if(old('asupan_makan')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('asupan_makan')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                        </div>
                                        @error('asupan_makan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Keperawatan</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Masalah Keperawatan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="masalah_keperawatan[]" class="form-control select2" multiple="multiple" data-placeholder=" --- Pilih Data --- " data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled></option>
                                                <option value="Resiko Jatuh">Resiko Jatuh</option>
                                                <option value="Nyeri Akut">Nyeri Akut</option>
                                            </select>
                                        </div>
                                        @error('masalah_keperawatan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Rencana Keperawatan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="rencana_keperawatan[]" class="form-control select2" data-placeholder=" --- Pilih Data --- " multiple="multiple" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled></option>
                                                <option value="Pengobatan Luka">Pengobatan Luka</option>
                                                <option value="Edukasi Pencegahan Jatuh">Edukasi Pencegahan Jatuh</option>
                                            </select>
                                        </div>
                                        @error('rencana_keperawatan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Kebutuhan Edukasi</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Butuh Penerjemah?</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="penerjemah" id="" class="form-control select2 @error('penerjemah')  is-invalid @enderror">
                                                <option value="Tidak" @if(old('penerjemah')=='Tidak' ) selected @endif>Tidak</option>
                                                <option value="Ya" @if(old('penerjemah')=='Ya' ) selected @endif>Ya</option>
                                            </select>
                                        </div>
                                        @error('penerjemah')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Penciuman</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="penciuman" id="" class="form-control select2 @error('penciuman')  is-invalid @enderror">
                                                <option value="Normal" @if(old('penciuman')=='Normal' ) selected @endif>Normal</option>
                                                <option value="Tidak Normal" @if(old('penciuman')=='Tidak Normal' ) selected @endif>Tidak Normal</option>
                                            </select>
                                        </div>
                                        @error('penciuman')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Penglihatan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="penglihatan" id="" class="form-control select2 @error('penglihatan')  is-invalid @enderror">
                                                <option value="Normal" @if(old('penglihatan')=='Normal' ) selected @endif>Normal</option>
                                                <option value="Kabur" @if(old('penglihatan')=='Kabur' ) selected @endif>Kabur</option>
                                                <option value="Kaca Mata" @if(old('penglihatan')=='Kaca Mata' ) selected @endif>Kaca Mata</option>
                                                <option value="Lensa Kontak" @if(old('penglihatan')=='Lensa Kontak' ) selected @endif>Lensa Kontak</option>
                                            </select>
                                        </div>
                                        @error('penglihatan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Pendengaran</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="penciuman" id="" class="form-control select2 @error('penciuman')  is-invalid @enderror">
                                                <option value="Normal" @if(old('penciuman')=='Normal' ) selected @endif>Normal</option>
                                                <option value="Tidak Normal (Kanan & Kiri)" @if(old('penciuman')=='Tidak Normal (Kanan & Kiri)' ) selected @endif>Tidak Normal (Kanan & Kiri)</option>
                                                <option value="Tidak Normal (Kanan)" @if(old('penciuman')=='Tidak Normal (Kanan)' ) selected @endif>Tidak Normal (Kanan)</option>
                                                <option value="Tidak Normal (Kiri)" @if(old('penciuman')=='Tidak Normal (Kiri)' ) selected @endif>Tidak Normal (Kiri)</option>
                                                <option value="Alat Bantu Dengar (Kiri)" @if(old('penciuman')=='Alat Bantu Dengar (Kiri)' ) selected @endif>Alat Bantu Dengar (Kiri)</option>
                                                <option value="Alat Bantu Dengar (Kanan)" @if(old('penciuman')=='Alat Bantu Dengar (Kanan)' ) selected @endif>Alat Bantu Dengar (Kanan)</option>
                                                <option value="Alat Bantu Dengar (Kanan & Kiri)" @if(old('penciuman')=='Alat Bantu Dengar (Kanan & Kiri)' ) selected @endif>Alat Bantu Dengar (Kanan & Kiri)</option>
                                            </select>
                                        </div>
                                        @error('penciuman')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Edukasi</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="edukasi[]" class="form-control select2" multiple="multiple" data-placeholder=" --- Pilih Data --- " data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled></option>
                                                <option value="Penggunaan Peralatan Medis">Penggunaan Peralatan Medis</option>
                                                <option value="Intraksi Obat">Intraksi Obat</option>
                                            </select>
                                        </div>
                                        @error('edukasi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Scrinning Discharge Planning</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Kriteria Discharge Planning</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="kriteria_discharge[]" class="form-control select2" multiple="multiple" data-placeholder=" --- Pilih Data --- " data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled></option>
                                                <option value="Umur>65">Umur>65</option>
                                                <option value="Terbatas Mobilitas">Terbatas Mobilitas</option>
                                                <option value="Perawatan Lanjutan">Perawatan Lanjutan</option>
                                                <option value="Bantuan Aktifitas Sehari hari">Bantuan Aktifitas Sehari hari</option>
                                            </select>
                                        </div>
                                        @error('kriteria_discharge')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Discharge Planning</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select name="discharge_planning[]" class="form-control select2" multiple="multiple" data-placeholder=" --- Pilih Data --- " data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled></option>
                                                <option value="Riwayat Jatuh">Riwayat Jatuh</option>
                                                <option value="Riwayat Ketergantungan Obat">Riwayat Ketergantungan Obat</option>
                                            </select>
                                        </div>
                                        @error('discharge_planning')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
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
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Respirasi</th>
                                    <th scope="col">O2</th>
                                    <th scope="col">Inpirasi O2</th>
                                    <th scope="col">Suhu</th>
                                    <th scope="col">Jantung</th>
                                    <th scope="col">TD Sistolik</th>
                                    <th scope="col">TD Diastol</th>
                                    <th scope="col">Waktu</th>
                                    <th scope="col">Frekuensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>19</td>
                                    <td>0</td>
                                    <td>95</td>
                                    <td>1</td>
                                    <td>Ya</td>
                                    <td>2</td>
                                    <td>36,8</td>
                                    <td>2024-07-15 01:00</td>
                                    <td>110</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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