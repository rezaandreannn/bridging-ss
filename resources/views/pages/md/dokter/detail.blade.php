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
                                <a href="#">{{ $dokter['data']['nama_dokter'] ?? ''}} - ( {{ $dokter['data']['kode_dokter'] ?? ''}} )</a>
                            </div>
                            <div class="author-box-job"><b>{{ $dokter['data']['jenis_profesi'] ?? ''}}</b> ({{ $dokter['data']['spesialis'] ?? ''}})</div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                NIK
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['nik'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Email
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['email'] ?? ''}}

                                            </div>
                                            <div class="col-md-4">
                                                Tanggal Lahir
                                            </div>
                                            <div class="col-md-8">
                                                : {{ date('d-m-Y', strtotime($dokter['data']['tgl_lahir'] ?? ''))  }}
                                            </div>
                                            <div class="col-md-4">
                                                Agama
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['agama'] ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Provinsi
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['provinsi'] ?? ''}}

                                            </div>
                                            <div class="col-md-4">
                                                Kota
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['kota'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Kode Pos
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['kode_pos'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Alamat
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $dokter['data']['alamat'] ?? ''}}
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