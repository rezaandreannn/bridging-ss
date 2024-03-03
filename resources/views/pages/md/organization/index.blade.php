@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kunjungan</a></div>
                <div class="breadcrumb-item">Rujukan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="http://" class="btn btn-primary rounded-0">New Data</a>
                </div>
                <div class="card-body">
                    <table class="table-striped table" id="table-1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Reg</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">NIK</th>
                                <th scope="col">No MR</th>
                                <th scope="col">Medis</th>
                                <th scope="col">Jenis Pasien</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>sdfj1</td>
                                <td>dsjkg</td>
                                <td>jkdf</td>
                                <td>dfjhs</td>
                                <td>jdsg</td>
                                <td>vsd</td>
                                <td width="10%">
                                    <a href="http://" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"></i></a>
                                    <a href="http://" class="btn btn-sm btn-outline-primary">sync</a>
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush