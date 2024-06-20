@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Dokter</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dokter.index') }}">Master Dokter</a></div>
                <div class="breadcrumb-item"><a href="{{ route('dokter.index') }}">Dokter</a></div>
                <div class="breadcrumb-item">Detail Dokter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $dokter->nama_dokter}}</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b>{{ $dokter->jenis_profesi}}</b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">Kode Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->kode_dokter}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Spesialis :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->spesialis}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">NIK :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->nik}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Email :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->email}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ date('d-m-Y', strtotime($dokter->tgl_lahir))  }}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title mb-0">Agama :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->agama}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Provinsi :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->provinsi}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Kota :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->kota}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Kode Pos :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->kode_pos}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $dokter->alamat}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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