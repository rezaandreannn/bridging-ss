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
                <div class="breadcrumb-item">Resume</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $pasien->NAMA_PASIEN}} - ({{ $pasien->NO_MR}})</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b></b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">No Registrasi :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pasien->No_Reg}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Jenis Kelamin :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pasien->JENIS_KELAMIN}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ date('d-m-Y', strtotime($pasien->TGL_LAHIR)) }}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pasien->ALAMAT}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('rj.cetak', $pasien->NO_MR )}}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-download"></i> Download</a>
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
                                    <th>Hasil ECHO</th>
                                    <th>Rencana</th>
                                    <th>Terapi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td width="15%">{{ date('d-m-Y', strtotime($item->TANGGAL)) }}</td>
                                    <td width="20%">{{ $item->NAMA_DOKTER }}({{ $item->SPESIALIS }})
                                    </td>
                                    <td width="25%">TD: {{ str_replace("-", "", $item->FS_TD) }} mmHg
                                        keluhan: {{ str_replace("-", "", $item->FS_ANAMNESA) }}</td>
                                    <td>{{ $item->FS_DIAGNOSA }}</td>
                                    <td>{{ $item->HASIL_ECHO }}</td>
                                    <td>{{ $item->FS_PLANNING }}</td>
                                    <td width="40%">{{ $item->FS_TERAPI }}</td>
                                </tr>
                                @endforeach
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