@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Practitioner</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dokter.index') }}">Master dokter</a></div>
                <div class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Practitioner</a></div>
                <div class="breadcrumb-item">Detail Organization</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mb-0">{{ $dokter['data']['nama_dokter'] ?? ''}} - ( {{ $dokter['data']['kode_dokter'] ?? ''}} )</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b>{{ $dokter['data']['jenis_profesi'] ?? ''}}</b> ({{ $dokter['data']['spesialis'] ?? ''}})</h6>
                            </div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">NIK</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['nik'] ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['email'] ?? ''}}

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Tanggal Lahir</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ date('d-m-Y', strtotime($dokter['data']['tgl_lahir'] ?? ''))  }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Agama</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['agama'] ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Provinsi</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['provinsi'] ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Kota</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['kota'] ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Kode Pos</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['kode_pos'] ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Alamat</h6>
                                            </div>
                                            <div class="col-sm-9">
                                                : {{ $dokter['data']['alamat'] ?? ''}}
                                            </div>
                                        </div>
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