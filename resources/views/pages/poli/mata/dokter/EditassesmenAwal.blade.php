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
<style>
    .eye-image {
         max-width: 100%;
         }
     .custom-judul{
         font-size: 18px;
         padding-left: 20px;
         color: #6777ef;
         margin-bottom: 0;
         width: 100%;
     }
     .no-margin {
         margin: 0;
     }
     .no-padding {
             padding: 0;
     }
     .align-items-center {
             display: flex;
             align-items: center;
             margin: 0;
     }
     @media (max-width: 768px) {
             .text-right-mobile {
                 text-align: right;
                 font-size: 6px;
             }
             .text-left-mobile {
                 text-align: left;
                 font-size: 6px;
             }
             .eye-image {
                 max-width:100px;
             }
             .my-mobile {
                 margin-top: 2rem !important;
                 margin-bottom: 1rem !important;
             }
        }
        .my-0 {
                margin-top: -10px !important;
                margin-bottom: 0 !important;
        }
        .my-1 {
                margin-bottom: -30px !important;
        }
 </style>
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
                <div class="breadcrumb-item">Assesmen Dokter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-bynoreg')
                    <form action="{{ route('poliMata.assesmenAwalUpdate', $asasmen_perawat->FS_KD_REG) }}" method="POST">
                    @csrf
                    @method('put')
                    <!-- components biodata pasien by no reg -->
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Allowanamnesa & Riwayat Alergi</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="NO_REG" value="{{ $noReg }}" />
                                        <input type="hidden" name="KODE_DOKTER" value="{{ $biodata->Kode_Dokter}}" />
                                        <input type="hidden" name="NO_MR" value="{{ $biodata->NO_MR}}" />
                                        <label>Keluhan Utama (Anamnesa) <code>*</code></label>
                                        <textarea name="FS_ANAMNESA" class="form-control  @error('anamnesa') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ...">{{ $asasmen_perawat->FS_ANAMNESA }}</textarea>
                                    </div>
                                    @error('anamnesa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Penyakit Sekarang</label>
                                        <textarea class="form-control  @error('riwayat_sekarang') is-invalid @enderror" rows="3" name="RIWAYAT_SEKARANG" value="" placeholder="Masukan ...">{{ $asasmen_perawat->RIWAYAT_SEKARANG }}</textarea>
                                        @error('riwayat_sekarang')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Riwayat Penyakit Dahulu</label>
                                        <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU" value="{{$biodata->FS_RIW_PENYAKIT_DAHULU!='' ? $biodata->FS_RIW_PENYAKIT_DAHULU : '-' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Riwayat Penyakit keluarga</label>
                                        <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU2" value="{{$biodata->FS_RIW_PENYAKIT_DAHULU2!='' ? $biodata->FS_RIW_PENYAKIT_DAHULU2 : '-' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Riwayat Alergi<code>*</code></label>
                                        <input type="text" class="form-control" name="FS_ALERGI" value="{{$biodata->FS_ALERGI!='' ? $biodata->FS_ALERGI : '-' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reaksi Alergi<code>*</code></label>
                                        <input type="text" class="form-control" name="FS_REAK_ALERGI" value="{{$biodata->FS_REAK_ALERGI!='' ? $biodata->FS_REAK_ALERGI : '-' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Spiritual dan Kultural pasien</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="d-block">Agama</label>
                                        <select name="FS_AGAMA" id="" class="form-control select2">
                                            <option value="">-- Pilih Agama --</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_AGAMA=='1') ? 'selected' : ''}}>Islam</option>
                                            <option value="2" {{ ($asasmen_perawat->FS_AGAMA=='2') ? 'selected' : ''}}>Kristen</option>
                                            <option value="3" {{ ($asasmen_perawat->FS_AGAMA=='3') ? 'selected' : ''}}>Katholik</option>
                                            <option value="4" {{ ($asasmen_perawat->FS_AGAMA=='4') ? 'selected' : ''}}>Hindu</option>
                                            <option value="5" {{ ($asasmen_perawat->FS_AGAMA=='5') ? 'selected' : ''}}>Budha</option>
                                            <option value="6" {{ ($asasmen_perawat->FS_AGAMA=='6') ? 'selected' : ''}}>Konghucu</option>
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
                                        <select name="PERNIKAHAN" id="pernikahan" class="form-control select2 @error('pernikahan')  is-invalid @enderror">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="1" {{ ($asasmen_perawat->PERNIKAHAN=='1') ? 'selected' : ''}}>Single</option>
                                            <option value="2" {{ ($asasmen_perawat->PERNIKAHAN=='2') ? 'selected' : ''}}>Menikah</option>
                                            <option value="3" {{ ($asasmen_perawat->PERNIKAHAN=='3') ? 'selected' : ''}}>Janda/Duda</option>
                                        </select>
                                        @error('pernikahan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="d-block">Pekerjaan</label>
                                        <select name="JOB" id="job" class="form-control select2 @error('job')  is-invalid @enderror">
                                            <option value="">-- Pilih Pekerjaan --</option>
                                            <option value="1" {{ ($asasmen_perawat->JOB=='1') ? 'selected' : ''}}>PNS</option>
                                            <option value="2" {{ ($asasmen_perawat->JOB=='2') ? 'selected' : ''}}>Karyawan Swasta</option>
                                            <option value="3" {{ ($asasmen_perawat->JOB=='3') ? 'selected' : ''}}>Lainnya</option>
                                        </select>
                                        @error('job')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Status & Pemeriksaan Fisik</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Psikologis</label>
                                        <select name="FS_STATUS_PSIK" id="" class="form-control select2">
                                            <option value="">-- pilih --</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_STATUS_PSIK=='1') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true' selected>Tenang</option>
                                            <option value="2" {{ ($asasmen_perawat->FS_STATUS_PSIK=='2') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
                                            <option value="3" {{ ($asasmen_perawat->FS_STATUS_PSIK=='3') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
                                            <option value="4" {{ ($asasmen_perawat->FS_STATUS_PSIK=='4') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
                                            <option value="5" {{ ($asasmen_perawat->FS_STATUS_PSIK=='5') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
                                            <option VALUE="6" {{ ($asasmen_perawat->FS_STATUS_PSIK=='6') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
                                        </select>
                                        <input type="hidden" name="FS_STATUS_PSIK2" value="" id="civstaton3" size="32">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Mental</label>
                                        <select name="STATUS_MENTAL" id="status_mental" class="form-control select2 @error('status_mental')  is-invalid @enderror">
                                            <option value="">-- Pilih Status Mental --</option>
                                            <option value="1" {{ ($asasmen_perawat->STATUS_MENTAL=='1') ? 'selected' : ''}}>Kooperatif</option>
                                            <option value="2" {{ ($asasmen_perawat->STATUS_MENTAL=='2') ? 'selected' : ''}}>Tidak Kooperatif</option>
                                            <option value="3" {{ ($asasmen_perawat->STATUS_MENTAL=='3') ? 'selected' : ''}}>Gelisah/Delirium/Berontak</option>
                                            <option value="4" {{ ($asasmen_perawat->STATUS_MENTAL=='4') ? 'selected' : ''}}>Ketidak Mampuan Dalam Mengikuti Perintah</option>
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
                                        <input type="text" name="KEADAAN_UMUM" class="form-control @error('keadaan_umum') is-invalid  
                                            @enderror" value="{{ $asasmen_perawat->KEADAAN_UMUM }}">
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
                                        <input type="text" name="KESADARAN" class="form-control @error('kesadaran') is-invalid  
                                            @enderror" value="{{ $asasmen_perawat->KESADARAN }}">
                                    </div>
                                    @error('kesadaran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>R</label>
                                        <div class="input-group">
                                            <input type="text" value="{{ $asasmen_perawat->FS_R }}" name="respirasi" id="respirasi" placeholder="masukkan hanya angka" class="form-control @error('respirasi') is-invalid  
                                            @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <b>x/menit</b>
                                                </div>
                                            </div>
                                            @error('respirasi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nadi</label>
                                        <div class="input-group">
                                            <input type="text" value="{{ $asasmen_perawat->FS_NADI }}" name="nadi" id="nadi" placeholder="masukkan hanya angka" class="form-control @error('nadi') is-invalid  
                                            @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <b>x/menit</b>
                                                </div>
                                            </div>
                                            @error('nadi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>TD</label><code> (contoh : 110/90)</code>
                                        <div class="input-group">
                                            <input type="text" name="td" id="td" value="{{ $asasmen_perawat->FS_TD }}" placeholder="masukkan hanya angka" class="form-control @error('td') is-invalid  
                                            @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <b>mmHg</b>
                                                </div>
                                            </div>
                                            @error('td')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Suhu</label><code> (gunakan tanda . contoh : 36.5)</code>
                                        <div class="input-group">
                                            <input type="text" name="suhu" id="suhu" value="{{ $asasmen_perawat->FS_SUHU }}" placeholder="masukkan hanya angka" class="form-control @error('suhu') is-invalid  
                                            @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <b>C</b>
                                                </div>
                                            </div>
                                            @error('suhu')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Badan</label>
                                        <div class="input-group">
                                            <input type="text" name="bb" id="bb" value="{{ $asasmen_perawat->FS_BB }}" placeholder="masukkan hanya angka" class="form-control @error('bb') is-invalid  
                                            @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <b>Kg</b>
                                                </div>
                                            </div>
                                            @error('bb')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tinggi Badan</label>
                                        <div class="input-group">
                                            <input type="text" name="tb" id="tb" value="{{ $asasmen_perawat->FS_TB }}" placeholder="masukkan hanya angka" class="form-control @error('tb') is-invalid  
                                            @enderror">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <b>M/Cm</b>
                                                </div>
                                            </div>
                                            @error('tb')
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
                                            <input type="text" name="LINGKAR_KEPALA" value="{{ $asasmen_perawat->LINGKAR_KEPALA }}" class="form-control @error('lingkar_kepala') is-invalid  
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
                                                    <input class="form-check-input" type="radio" name="STATUS_GIZI" id="status_gizi1" value="1" {{ ($asasmen_perawat->STATUS_GIZI=='1') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_gizi1">
                                                        Baik
                                                    </label>
                                                </div>
                                                <div class="form-check" style="margin-right: 10px;">
                                                    <input class="form-check-input" type="radio" name="STATUS_GIZI" id="status_gizi2" value="2" {{ ($asasmen_perawat->STATUS_GIZI=='2') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_gizi2">
                                                        Cukup
                                                    </label>
                                                </div>
                                                <div class="form-check" style="margin-right: 10px;">
                                                    <input class="form-check-input" type="radio" name="STATUS_GIZI" id="status_gizi3" value="3" {{ ($asasmen_perawat->STATUS_GIZI=='3') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="status_gizi3">
                                                        Kurang
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label>GCS</label>
                                        <div class="col-md-12">
                                            <div class="form-group" style="display: flex; flex-direction: row;">
                                                <div class="input-group" style="margin-right: 10px;">
                                                    <label for="gcs_e" class="mr-2 mt-2">
                                                        E
                                                    </label>
                                                    <input type="text" class="form-control" name="gcs_e" id="gcs_e">
                                                </div>
                                                <div class="input-group" style="margin-right: 10px;">
                                                    <label for="gcs_m" class="mr-2 mt-2">
                                                        M
                                                    </label>
                                                    <input type="text" class="form-control" name="gcs_m" id="gcs_m">
                                                </div>
                                                <div class="input-group" style="margin-right: 10px;">
                                                    <label for="gcs_v" class="mr-2 mt-2">
                                                        V
                                                    </label>
                                                    <input type="text" class="form-control" name="gcs_v" id="gcs_v">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SkorNyeri</label>
                                        <input type="text" name="Skornyeri" class="form-control @error('Skornyeri') is-invalid  
                                            @enderror" value="{{ $asasmen_perawat->KESADARAN }}">
                                    </div>
                                    @error('Skornyeri')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div> --}}
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Kebutuhan Fungsional & Asesmen Jatuh</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Cacat Tubuh</label>
                                        <input type="text" name="CACAT" value="{{ $asasmen_perawat->CACAT }}" class="form-control @error('CACAT') is-invalid @enderror">
                                        @error('CACAT')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ADL</label>
                                        <div class="col-md-6">
                                            <div class="form-group" style="display: flex; flex-direction: row;">
                                                <div class="form-check" style="margin-right: 10px;">
                                                    <input class="form-check-input" type="radio" name="ADL" value="1" id="adl1" {{ ($asasmen_perawat->ADL=='1') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="adl1">
                                                        Mandiri
                                                    </label>
                                                </div>
                                                <div class="form-check" style="margin-right: 10px;">
                                                    <input class="form-check-input" type="radio" name="ADL" value="2" id="adl2" {{ ($asasmen_perawat->ADL=='2') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="adl2">
                                                        Dibantu
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label>Pasien berjalan tidak seimbang / sempoyongan</label>
                                        <select name="FS_CARA_BERJALAN1" class="form-control" onchange="click1(this)">
                                            <option value="">--Pilih Data--</option>
                                            <option value="0" {{ ($asasmen_perawat->FS_CARA_BERJALAN1=='0') ? 'selected' : '' }}>TIDAK</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_CARA_BERJALAN1=='1') ? 'selected' : '' }}>YA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label>
                                            Pasien berjalan menggunakan alat bantu
                                        </label>
                                        <select name="FS_CARA_BERJALAN2" class="form-control" onchange="click2(this)">
                                            <option value="">--Pilih Data--</option>
                                            <option value="0" {{ ($asasmen_perawat->FS_CARA_BERJALAN2=='0') ? 'selected' : '' }}>TIDAK</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_CARA_BERJALAN2=='1') ? 'selected' : '' }}>YA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="check3">
                                            Pada saat akan duduk pasien memegang benda untuk menopang
                                        </label>
                                        <select name="FS_CARA_DUDUK" class="form-control" onchange="click3(this)">
                                            <option value="">--Pilih Data--</option>
                                            <option value="0" {{ ($asasmen_perawat->FS_CARA_DUDUK=='0') ? 'selected' : '' }}>TIDAK</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_CARA_DUDUK=='1') ? 'selected' : '' }}>YA</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="hasil_check1">
                                <input type="hidden" id="hasil_check2">
                                <input type="hidden" id="hasil_check3">
                                <label for="kesimpulan" class="col-sm-2 col-form-label">Kesimpulan : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control-plaintext" id="kesimpulan_asesmen_jatuh" readonly>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Kepala Leher</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Konjungtiva</label>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="KONJUNGTIVA" value="1" id="konjungtiva1" {{ ($asasmen_perawat->KONJUNGTIVA=='1') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="konjungtiva1">
                                                        Pucat
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="KONJUNGTIVA" value="2" id="konjungtiva2" {{ ($asasmen_perawat->KONJUNGTIVA=='2') ? 'checked' : '' }}>
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
                                                    <input class="form-check-input" type="radio" name="SKELERA" value="1" id="skelera1" {{ ($asasmen_perawat->SKELERA=='1') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="skelera1">
                                                        Ikterik
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="SKELERA" value="0" id="skelera2" {{ ($asasmen_perawat->SKELERA=='0') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="skelera2">
                                                        Tidak Ikterik
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
                                                    <input class="form-check-input" type="radio" name="BIBIR_LIDAH" value="1" id="bibir_lidah1" {{ ($asasmen_perawat->BIBIR_LIDAH=='1') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="bibir_lidah1">
                                                        Sianosis
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="BIBIR_LIDAH" value="0" id="bibir_lidah2" {{ ($asasmen_perawat->BIBIR_LIDAH=='0') ? 'checked' : '' }}>
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
                        <!-- include form -->
                    </div>
                    <div class="card">
                        <div class="card-header card-success card-khusus-header">
                            <h6 class="card-khusus-title">Pemeriksaan Fisik Mata</h6>
                        </div>
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                {{-- <div class="row">
                                    <h4 class="custom-judul my-1">Pemeriksaan Fisik Mata</h4>
                                </div> --}}
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-4 text-right text-right-mobile no-padding">
                                                <p class="no-margin">O.D</p>
                                                <p class="no-margin">Status Presen</p>
                                            </div>
                                            <div class="col-md-4 col-4 text-center no-padding my-mobile">
                                                <img src="{{ asset('img/mata.png') }}" alt="Right Eye" class="eye-image">
                                            </div>
                                            <div class="col-md-4 col-4 text-left text-left-mobile no-padding">
                                                <p class="no-margin">OS</p>
                                                <p class="no-margin">Kedudukan / Gerak Bola Mata</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="palpebra_kiri" value="{{$asasmen_perawat->palpebra_kiri}}" class="form-control @error('palpebra_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('palpebra_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">PALPEBRA</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="palpebra_kanan" value="{{$asasmen_perawat->palpebra_kanan}}" class="form-control @error('palpebra_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('palpebra_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="conjuctiva_kiri" value="{{$asasmen_perawat->conjuctiva_kiri}}" class="form-control @error('conjuctiva_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('conjuctiva_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">CONJUCTIVA</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="conjuctiva_kanan" value="{{$asasmen_perawat->conjuctiva_kanan}}" class="form-control @error('conjuctiva_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('conjuctiva_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cornea_kiri" value="{{$asasmen_perawat->cornea_kiri}}" class="form-control @error('cornea_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('cornea_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">CORNEA</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="cornea_kanan" value="{{$asasmen_perawat->cornea_kanan}}" class="form-control @error('cornea_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('cornea_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="coa_kiri" value="{{$asasmen_perawat->coa_kiri}}" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('coa_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">COA</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="coa_kanan" value="{{$asasmen_perawat->coa_kanan}}" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('coa_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="iris_kiri" value="{{$asasmen_perawat->iris_kiri}}" class="form-control @error('iris_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('iris_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">IRIS</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="iris_kanan" value="{{$asasmen_perawat->iris_kanan}}" class="form-control @error('iris_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('iris_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="pupil_kiri" value="{{$asasmen_perawat->pupil_kiri}}" class="form-control @error('pupil_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('pupil_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">PUPIL</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="pupil_kanan" value="{{$asasmen_perawat->pupil_kanan}}" class="form-control @error('pupil_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('pupil_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="lensa_kiri" value="{{$asasmen_perawat->lensa_kiri}}" class="form-control @error('lensa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('lensa_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">LENSA</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="lensa_kanan" value="{{$asasmen_perawat->lensa_kanan}}" class="form-control @error('lensa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('lensa_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="vitreosh_kiri" value="{{$asasmen_perawat->vitreosh_kiri}}" class="form-control @error('vitreosh_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('vitreosh_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">VITREOSH</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="vitreosh_kanan" value="{{$asasmen_perawat->vitreosh_kanan}}" class="form-control @error('vitreosh_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('vitreosh_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="biometri_kiri" value="{{$asasmen_perawat->biometri_kiri}}" class="form-control @error('biometri_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                            </div>
                                            @error('biometri_kiri')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <h4 style="text-align: center">BIOMETRI</h4>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="biometri_kanan"  value="{{$asasmen_perawat->biometri_kanan}}" class="form-control @error('biometri_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                            </div>
                                            @error('biometri_kanan')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Visus</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="VISUS_OD" class="mr-2 mt-2">
                                                                OD
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kanan" value="{{ $asasmen_perawat->VISUS_OD }}" class="form-control" name="VISUS_OD" id="VISUS_OD">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="VISUS_OS" class="mr-2 mt-2">
                                                                OS
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kiri" value="{{ $asasmen_perawat->VISUS_OS }}" class="form-control" name="VISUS_OS" id="VISUS_OS">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>NCT</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="NCT_TOD" class="mr-2 mt-2">
                                                                TOD
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kanan" value="{{ $asasmen_perawat->NCT_TOD }}" class="form-control" name="NCT_TOD" id="NCT_TOD">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="NCT_TOS" class="mr-2 mt-2">
                                                                TOS
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kiri" value="{{ $asasmen_perawat->NCT_TOS }}" class="form-control" name="NCT_TOS" id="NCT_TOS">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Streak</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input" type="radio" name="discharge" value="1" {{ ($asasmen_perawat->discharge=='1') ? 'checked' : '' }} id="discharge1">
                                                            <label class="form-check-label" for="discharge1">
                                                                Retinoskopi
                                                            </label>
                                                        </div>
                                                        <div class="form-check" style="margin-right: 10px;">
                                                            <input class="form-check-input" type="radio" name="discharge" value="2" {{ ($asasmen_perawat->discharge=='2') ? 'checked' : '' }} id="discharge2">
                                                            <label class="form-check-label" for="discharge2">
                                                                Keratomeri
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>TONOMETRI</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="tonometri_od" class="mr-2 mt-2">
                                                                OD
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->tonometri_od}}"  name="tonometri_od" id="tonometri_od">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="tonometri_os" class="mr-2 mt-2">
                                                                OS
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->tonometri_os}}" name="tonometri_os" id="tonometri_os">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>APLANSI</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="aplansi_od" class="mr-2 mt-2">
                                                                OD
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->aplansi_od}}" name="aplansi_od" id="aplansi_od">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="aplansi_os" class="mr-2 mt-2">
                                                                OS
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->aplansi_os}}" name="aplansi_os" id="aplansi_os">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ANEL</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="anel_od" class="mr-2 mt-2">
                                                                OD
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->anel_od}}" name="anel_od" id="anel_od">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="anel_os" class="mr-2 mt-2">
                                                                OS
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->anel_os}}" name="anel_os" id="anel_os">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ekstemitas</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="ekstremitas_od" class="mr-2 mt-2">
                                                                Atas
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->ekstremitas_od}}" name="ekstremitas_od" id="ekstremitas_od">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="ekstremitas_os" class="mr-2 mt-2">
                                                                Bawah
                                                            </label>
                                                            <input type="text" class="form-control" value="{{$asasmen_perawat->ekstremitas_os}}" name="ekstremitas_os" id="ekstremitas_os">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Pemeriksaaan Penunjang</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Order Periksa Laboratorium Control Selanjutnya</label>
                                        <select name="periksa_lab[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Lab" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            <option value="" disabled>-- Pilih Periksa Lab --</option>
                                            @foreach ($masterLab as $lab)
                                            <option value="{{$lab->No_Jenis}}">{{$lab->Jenis}}</option>
                                            @endforeach
                                        </select>
                                        @error('periksa_lab')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label>Order Periksa Radiologi Control Selanjutnya</label>
                                            <select name="periksa_radiologi[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Radiologi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Periksa Radiologi --</option>
                                                @foreach ($masterRadiologi as $radiologi)
                                                <option value="{{$radiologi->No_Rinci}}">{{$radiologi->Ket_Tindakan}}</option>
                                                @endforeach
                                            </select>
                                            @error('periksa_radiologi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Bagian</label>
                                            <select name=" bagian" class="form-control" data-placeholder="Pilih Periksa Radiologi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected>-- Pilih Bagian --</option>
                                                <option value="Sinistra" >Sinistra</option>
                                                <option value="Dextra" >Dextra</option>
                                                <option value="Bilateral" >Bilateral</option>
                                            </select>
                                            @error('bagian')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Analisis & Rencana</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Diagnosa</label>
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
                                        <label>Masalah Kesehatan</label>
                                        <select name="tujuan[]" id="masalah_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Masalah Keperawatan" style="width: 100%;">
    
                                            <option value="">-- pilih --</option>
                                            @forelse ($masalah_perGet as $mp)
                                            @foreach ($masalah_perawatan as $mk)
                                            <option value="{{ $mk->FS_KD_DAFTAR_DIAGNOSA }}" {{ $mk->FS_KD_DAFTAR_DIAGNOSA == $mp->FS_KD_MASALAH_KEP ? "selected" : "" }}>{{ $mk->FS_NM_DIAGNOSA }}</option>
                                            @endforeach
                                            @empty
                                            @foreach ($masalah_perawatan as $mk)
                                            <option value="{{ $mk->FS_KD_DAFTAR_DIAGNOSA }}">{{ $mk->FS_NM_DIAGNOSA }}</option>
                                            @endforeach
                                            @endforelse
    
                                        </select>
                                    </div>
                                    @error('masalah_keperawatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Rencana Tindakan</label>
                                        <select multiple name="tembusan[]" id="rencana_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Rencana Keperawatan" style="width: 100%;">
                                            <option value="">-- pilih --</option>
    
                                            @forelse ($rencana_perGet as $rpp)
                                            @foreach ($rencana_perawatan as $rp)
                                            <option value="{{ $rp->FS_KD_TRS }}" {{ $rp->FS_KD_TRS == $rpp->FS_KD_REN_KEP ? 'selected' : ''}}>{{ $rp->FS_NM_REN_KEP }}</option>
                                            @endforeach
                                            @empty
                                            @foreach ($rencana_perawatan as $rp)
                                            <option value="{{ $rp->FS_KD_TRS }}">{{ $rp->FS_NM_REN_KEP }}</option>
                                            @endforeach
                                            @endforelse
    
                                        </select>
                                    </div>
                                    @error('rencana_perawatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Terapi</label>
                                        <input type="text" name="FS_TERAPI" class="form-control @error('terapi') is-invalid @enderror">
                                        @error('terapi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Edukasi</label>
                                        <input type="text" name="FS_EDUKASI" value="{{$asasmen_perawat->FS_EDUKASI}}" class="form-control @error('edukasi') is-invalid @enderror">
                                    </div>
                                    @error('edukasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Konsul</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="konsul" value="Tidak" id="konsul1" @if(old('konsul', '0' )=='Tidak' ) checked @endif>
                                                        <label class="form-check-label" for="konsul1">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="konsul" value="Iya" id="konsul2" @if(old('konsul', '0' )=='Iya' ) checked @endif>
                                                        <label class="form-check-label" for="konsul2">
                                                            Iya, Kebagian
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="konsul" class="form-control @error('konsul') is-invalid  
                                            @enderror" value="{{old('konsul')}}" placeholder="Kebagian konsul ...">
                                            </div>
                                            @error('konsul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Kondisi Pulang</label>
                                        <select name="FS_CARA_PULANG" id="kondisi" class="form-control select2">
                                            <option value="">-- Pilih Cara Pulang --</option>
                                            <option value="1">Tidak Control</option>
                                            <option value="2">Kontrol</option>
                                            <option value="3">Rawat Inap</option>
                                            <option value="4">Rujuk Luar RS</option>
                                            <option value="6">Rujuk Internal</option>
                                            <option value="7">Kembali Ke Faskes Primer</option>
                                            <option value="8">PRB</option>
                                        </select>
                                        @error('FS_CARA_PULANG')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaobat">Nama Obat</label>
                                        <select name="nama_obat" id="namaobat" class="form-control select2 @error('nama_obat') is-invalid @enderror">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($masterObat as $obat)
                                                <option value="{{ $obat->Nama_Obat }}">{{ $obat->Nama_Obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="numero">Numero</label>
                                            <input type="text" class="form-control numero" onkeypress="handleKeyPress(event)">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="signa">Signa</label>
                                            <input type="text" class="form-control dosis" onkeypress="handleKeyPress(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="terapi">Terapi</label>
                                        <textarea rows="7" cols="50" style="height: 180px;" name="FS_TERAPI" class="form-control resep" id="terapi">{{ $asasmen_perawat->FS_TERAPI }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Expired Rujukan (jika pasien BPJS)</label>
                                        <input type="date" name="FS_SKDP_FASKES" id="" value="{{$asasmen_perawat->FS_SKDP_FASKES}}" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3" id="form2" style="display: none;">
                        <div class="card-header">
                            <h4 class="card-title">Surat Keterangan Dalam Perawatan</h4>
                        </div>
                        <!-- include form -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label>Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan</label>
                                        <select name="FS_SKDP_1" class="form-control select2">
                                            <option value="">--Pilih Alasan--</option>
                                            <option value="1" selected>Untuk Melihat Perkembangan Penyakit</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label>
                                            Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya
                                        </label>
                                        <select name="FS_SKDP_2" class="form-control select2">
                                            <option value="">--Pilih Rencana Tindakan--</option>
                                            <option value="1" selected>Menegakkan Diagnosis dan Memberikan Terapi Definitif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="check3">
                                            Rencana Kontrol Berikutnya
                                        </label>
                                        <select name="FS_RENCANA_KONTROL" class="form-control select2">
                                            <option value="">--Pilih Data--</option>
                                            <option value="1 Minggu Kedepan">1 Minggu Kedepan</option>
                                            <option value="2 Minggu Kedepan">2 Minggu Kedepan</option>
                                            <option value="Sebulan Kedepan" selected>Sebulan Kedepan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="check3">
                                            Tanggal Kontrol Berikutnya
                                        </label>
                                        <input type="date" class="form-control" name="FS_SKDP_KONTROL" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group clearfix">
                                        <label for="check3">
                                            Tanggal Expired Rujukan Faskes
                                        </label>
                                        <input type="date" class="form-control" name="FS_SKDP_FASKES" id="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan/Pesan</label>
                                        <textarea class="form-control" rows="3" name="FS_PESAN" value="" placeholder="Masukan ..."></textarea>
                                        @error('riwayat_sekarang')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="text-left">
                        {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                        {{-- <a href="{{ route('poliMata.assesmenAwal', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>Simpan</a> --}}
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                    </div>
                    </form>
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

<script>
    $(document).ready(function() {
        $("#kondisi").on("change", function () {
            $("#form2").hide();

            if ($(this).val() == "2") {
                $("#form2").show();
            } else {
                $("#form2").hide();
            }
        });
    });
</script>

{{-- Resep --}}
<script>
    function handleKeyPress(e) {
        var key = e.keyCode || e.which;
        if (key == 13) {
            e.preventDefault(); // Prevent form submission

            var namaobat = $("#namaobat").val();
            var numero = $(".numero").val();
            var dosis = $(".dosis").val();
            var resep = $(".resep").val();

            // Append new recipe information to the textarea
            $(".resep").val(
                resep +
                "\n /R   " +
                namaobat +
                "   no. " +
                numero +
                "\n S    " +
                dosis +
                "\n ----------------------------------------------- \n "
            );

            // Clear inputs
            $("#namaobat").val(null).trigger('change'); // Clear and reset select2 dropdown
            $(".numero").val(null);
            $(".dosis").val(null);

            // Optionally reopen the select2 dropdown
            $("#namaobat").select2("open");
        }
    }
</script>

{{-- SCRIPT VITAL SIGN --}}
<script>
    document.getElementById('td').addEventListener('keypress', function(event) {
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
    document.getElementById('bb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('tb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('respirasi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>
{{-- SCRIPT ASSESMEN JATUH --}}
<script type="text/javascript">
     function click1(selected) {
        var checkbox1 = selected.value
        $("#hasil_check1").html(checkbox1);
        score_skrining_asasmen_jatuh();
    }

    function click2(selected) {
        var checkbox2 = selected.value
        $("#hasil_check2").html(checkbox2);
        score_skrining_asasmen_jatuh();
    }

    function click3(selected) {
        var checkbox3 = selected.value
        $("#hasil_check3").html(checkbox3);
        score_skrining_asasmen_jatuh();
    }

     // score skrining asesmen jatuh
     function score_skrining_asasmen_jatuh() {
        var score_jatuh = parseInt($("#hasil_check1").text()) + parseInt($("#hasil_check2").text()) + parseInt($("#hasil_check3").text());
        $("#totalscore_jatuh").html(score_jatuh);

        if (score_jatuh >= 3) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO TINGGI");
        } else if (score_jatuh == 2) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO SEDANG");
        } else if (score_jatuh <= 1) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO RENDAH");
        }
    }
</script>

@endpush