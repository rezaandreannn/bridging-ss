@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item">Patient</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $profil['NAMA_PASIEN'] ?? ''}} - ({{ $profil['NO_MR'] ?? ''}})</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b></b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">No Registrasi :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $profil['NO_REG'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Jenis Kelamin :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $profil['JENIS_KELAMIN'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $profil['TGL_LAHIR'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $profil['ALAMAT'] ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Dokter</th>
                                    <th>Uraian Klinis</th>
                                    <th>Dianogsa</th>
                                    <th>Hasil EKG</th>
                                    <th>Rencana</th>
                                    <th>Terapi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td width="15%">04-04-2024</td>
                                    <td width="20%">4 dr. Toumi Shiddiqi,
                                        Sp. PD.
                                        ( Spesialis
                                        Penyakit Dalam)
                                    </td>
                                    <td width="25%">TD : 127/89 mmHg
                                        Keluhan : kontrol
                                        dengan HT, OA Genu,
                                        post ranap di RSAY
                                        dengan DHF, keluhan
                                        tidak nafsu makan
                                        :</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td width="40%">/R Lansoprazol 30mg XXX
                                        S 1-0-0
                                        ----------------------------------------
                                        /R Sucralfat syrup No III
                                        S 3ddC1 ac
                                        ----------------------------------------</td>
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush