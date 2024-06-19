@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail pasiens</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('patient.index') }}">Pasien</a></div>
                <div class="breadcrumb-item">Detail Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h4>{{ $pasiens->nama_pasien}} - ( {{ $pasiens->no_mr}} )</h4>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h5>NIK : {{ $pasiens->nik}}</h5>
                            </div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                No BPJS
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->no_bpjs}}
                                            </div>
                                            <div class="col-md-4">
                                                No Registrasi
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->no_registrasi}}
                                            </div>
                                            <div class="col-md-4">
                                                Rekanan
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->nama_rekanan}}
                                            </div>
                                            <div class="col-md-4">
                                                Nama Dokter
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->nama_dokter}}
                                            </div>
                                            <div class="col-md-4">
                                                Status Rawat
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->status_rawat}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Alamat
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->alamat}}
                                            </div>
                                            <div class="col-md-4">
                                                Kota
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->kota}}
                                            </div>
                                            <div class="col-md-4">
                                                Provinsi
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->provinsi}}
                                            </div>
                                            <div class="col-md-4">
                                                Daftar By
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->daftar_by}}
                                            </div>
                                            <div class="col-md-4">
                                                Created By
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasiens->created_by}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 d-sm-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->


<!-- Page Specific JS File -->




@endpush