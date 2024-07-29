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
                <div class="breadcrumb-item">Assesmen Awal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                     <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-bynoreg')
                    <!-- components biodata pasien by no reg -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <h4 class="custom-judul my-1">Pemeriksaan Fisik Mata</h4>
                                </div>
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
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="palpebra_kiri" class="form-control @error('palpebra_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
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
                                            <input type="text" name="palpebra_kanan" class="form-control @error('palpebra_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('palpebra_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="conjuctiva_kiri" class="form-control @error('conjuctiva_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
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
                                            <input type="text" name="conjuctiva_kanan" class="form-control @error('conjuctiva_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('conjuctiva_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="cornea_kiri" class="form-control @error('cornea_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
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
                                            <input type="text" name="cornea_kanan" class="form-control @error('cornea_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('cornea_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kiri" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('coa_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">C.O.A</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kanan" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('coa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="iris_kiri" class="form-control @error('iris_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
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
                                            <input type="text" name="iris_kanan" class="form-control @error('iris_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('iris_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="pupil_kiri" class="form-control @error('pupil_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
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
                                            <input type="text" name="pupil_kanan" class="form-control @error('pupil_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('pupil_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="lensa_kiri" class="form-control @error('lensa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
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
                                            <input type="text" name="lensa_kanan" class="form-control @error('lensa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('lensa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="vitreosh_kiri" class="form-control @error('vitreosh_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('vitreosh_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">VITREOSH HUMOR</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="vitreosh_kanan" class="form-control @error('vitreosh_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('vitreosh_kanan')
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
                                                        <label for="visus_od" class="mr-2 mt-2">
                                                            OD
                                                        </label>
                                                        <input type="text" class="form-control" name="visus_od" id="visus_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="visus_os" class="mr-2 mt-2">
                                                            OS
                                                        </label>
                                                        <input type="text" class="form-control" name="visus_os" id="visus_os">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Streak</label>
                                            <div class="col-md-12">
                                                <div class="form-group" style="display: flex; flex-direction: row;">
                                                    <div class="form-check" style="margin-right: 10px;">
                                                        <input class="form-check-input" type="radio" name="discharge" value="Ya" id="discharge1" @if(old('discharge', '0' )=='Ya' ) checked @endif>
                                                        <label class="form-check-label" for="discharge1">
                                                            Retinoskopi
                                                        </label>
                                                    </div>
                                                    <div class="form-check" style="margin-right: 10px;">
                                                        <input class="form-check-input" type="radio" name="discharge" value="Tidak" id="discharge2" @if(old('discharge', '0' )=='Tidak' ) checked @endif>
                                                        <label class="form-check-label" for="discharge2">
                                                            Keratomeri
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>TONOMETRI</label>
                                            <div class="col-md-12">
                                                <div class="form-group" style="display: flex; flex-direction: row;">
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="tonometri_od" class="mr-2 mt-2">
                                                            OD
                                                        </label>
                                                        <input type="text" class="form-control" name="tonometri_od" id="tonometri_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="tonometri_os" class="mr-2 mt-2">
                                                            OS
                                                        </label>
                                                        <input type="text" class="form-control" name="tonometri_os" id="tonometri_os">
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
                                                        <input type="text" class="form-control" name="aplansi_od" id="aplansi_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="aplansi_os" class="mr-2 mt-2">
                                                            OS
                                                        </label>
                                                        <input type="text" class="form-control" name="aplansi_os" id="aplansi_os">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>LAB</label>
                                            <div class="col-md-12">
                                                <div class="form-group" style="display: flex; flex-direction: row;">
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="lab_od" class="mr-2 mt-2">
                                                            OD
                                                        </label>
                                                        <input type="text" class="form-control" name="lab_od" id="lab_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="lab_os" class="mr-2 mt-2">
                                                            OS
                                                        </label>
                                                        <input type="text" class="form-control" name="lab_os" id="lab_os">
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
                                                        <input type="text" class="form-control" name="anel_od" id="anel_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="anel_os" class="mr-2 mt-2">
                                                            OS
                                                        </label>
                                                        <input type="text" class="form-control" name="anel_os" id="anel_os">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Thorak</label>
                                            <div class="col-md-12">
                                                <div class="form-group" style="display: flex; flex-direction: row;">
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="ekstremitas_atas" class="mr-2 mt-2">
                                                            Jantung
                                                        </label>
                                                        <input type="text" class="form-control" name="ekstremitas_atas" id="anel_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="ekstremitas_bawah" class="mr-2 mt-2">
                                                            Paru
                                                        </label>
                                                        <input type="text" class="form-control" name="ekstremitas_bawah" id="anel_os">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ekstremitas</label>
                                            <div class="col-md-12">
                                                <div class="form-group" style="display: flex; flex-direction: row;">
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="ekstremitas_atas" class="mr-2 mt-2">
                                                            Atas
                                                        </label>
                                                        <input type="text" class="form-control" name="ekstremitas_atas" id="anel_od">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 10px;">
                                                        <label for="ekstremitas_bawah" class="mr-2 mt-2">
                                                            Bawah
                                                        </label>
                                                        <input type="text" class="form-control" name="ekstremitas_bawah" id="anel_os">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Pemeriksaaan Penunjang</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Laboratorium</label>
                                            <input type="text" name="penunjang_lab" class="form-control @error('penunjang_lab') is-invalid @enderror">
                                            @error('penunjang_lab')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Radiologi</label>
                                            <input type="text" name="penunjang_radiologi" class="form-control @error('penunjang_radiologi') is-invalid @enderror">
                                            @error('penunjang_radiologi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lain-lain</label>
                                            <input type="text" name="penunjang_lainnya" class="form-control @error('penunjang_lainnya') is-invalid @enderror">
                                            @error('penunjang_lainnya')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Analisis & Rencana</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis <code>*</code></label>
                                            <textarea name="diagnosis" class="form-control  @error('diagnosis') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('diagnosis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Masalah Kesehatan</label>
                                            <textarea name="masalah_kesehatan" class="form-control  @error('masalah_kesehatan') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('masalah_kesehatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Terapi</label>
                                            <textarea name="terapi" class="form-control  @error('terapi') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('terapi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rencana Tindakan</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Tidak Ada" id="rencana_tindakan1" @if(old('rencana_tindakan', '0' )=='Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_tindakan1">
                                                                Tidak Ada
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Ada" id="rencana_tindakan2" @if(old('rencana_tindakan', '0' )=='Ada' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_tindakan2">
                                                                Ada, Jenis Tindakan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="rencana_tindakan" class="form-control @error('rencana_tindakan') is-invalid  
                                                    @enderror" value="{{old('rencana_tindakan')}}" placeholder="Jenis Tindakan ...">
                                                    </div>
                                                    @error('rencana_tindakan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diet</label>
                                            <textarea name="diet" class="form-control  @error('diet') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('diet')
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
                                            <label>Edukasi</label>
                                            <select name="edukasi" id="" class="form-control select2 @error('edukasi')  is-invalid @enderror">
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
                        </div>
                        <div class="card-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                                <a href="{{ route('poliMata.assesmenMata', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>     Simpan</a>
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