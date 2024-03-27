@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pendaftaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('pendaftaran.index') }}">Kunjungan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></div>
                <div class="breadcrumb-item">Detail Pendaftaran</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">{{ $pendaftaran['nama_pasien'] ?? ''}} - ( {{ $pendaftaran['no_mr'] ?? ''}} )</a>
                            </div>
                            <div class="author-box-job"><b>NIK : {{ $pendaftaran['nik'] ?? ''}}</b></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                No Registrasi
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['no_registrasi'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Status Rawat
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['status_rawat'] ?? ''}}

                                            </div>
                                            <div class="col-md-4">
                                                Rekanan
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['nama_rekanan'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Nama Dokter
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['nama_dokter'] ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Kode Dokter
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['kode_dokter'] ?? ''}}

                                            </div>
                                            <div class="col-md-4">

                                            </div>
                                            <div class="col-md-8">

                                            </div>
                                            <div class="col-md-4">
                                                Daftar By
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['daftar_by'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Created By
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pendaftaran['created_by'] ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 d-sm-none"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Encounter</h4>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                <!-- 1.1 -->
                                @if($dataEncounter == 'RAWAT INAP')
                                <p>rawat inap</p>
                                @elseif($dataEncounter == NULL)
                                <p>null</p>
                                @else
                                <div class="accordion">
                                    <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                        <h4>Class</h4>
                                    </div>
                                    <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                                        <div class="table-responsive">
                                            <table class="table-striped table">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center w-25">Code</th>
                                                        <th class="text-center w-25">Display</th>
                                                        <th class="text-center">System</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dataEncounter['class'][0] as $class)
                                                    <tr>
                                                        <td>{{ $class['code'] }}</td>
                                                        <td>{{ $class['display'] }}</td>
                                                        <td>{{ $class['system'] }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @endif
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