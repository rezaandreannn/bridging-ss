@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Patient</a></div>
                <div class="breadcrumb-item">History Patient</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <a href="#">Data Pasien</a>
                    </div>
                    <div class="author-box-job"><b></div>
                    <div class="author-box-description">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        No MR
                                    </div>
                                    <div class="col-md-9">
                                        : 123456
                                    </div>
                                    <div class="col-md-3">
                                        Jenis Kelamin
                                    </div>
                                    <div class="col-md-9">
                                        : Laki-Laki
                                    </div>
                                    <div class="col-md-3">
                                        Alamat
                                    </div>
                                    <div class="col-md-9">
                                        : WAY DADI, SUKARAME, BANDAR LAMPUNG

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        Nama
                                    </div>
                                    <div class="col-md-9">
                                        : DIMAS BUDI PRATAMA
                                    </div>
                                    <div class="col-md-3">
                                        Tanggal Lahir
                                    </div>
                                    <div class="col-md-9">
                                        : 2000-02-10 00:00:00.000
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
                    <button class="btn btn-sm btn-primary align-left">Profil Ringkas Medis Rawat Jalan</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">Tanggal Kunjungan</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>26 March 2024</td>
                                    <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                    <td>SPESIALIS PENYAKIT DALAM</td>
                                    <td></td>
                                    <td>Perawat Jalan</td>
                                    <td>
                                        <a href="{{ route('rj.add') }}" class="btn btn-primary"><i class="fas fa-notes-medical"></i> Entry</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush