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
                <div class="breadcrumb-item active"><a href="{{ route('rj.dokter') }}">Pemeriksaan Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.dokter') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item">Dokter</div>
            </div>
        </div>

        <div class="section-body">
            {{-- @include('components.biodata-pasien-fisio-bymr') --}}
            <div class="card">
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
                               <td>28 June 2024</td>
                               <td>dr. Toumi Shiddiqi, Sp. PD.</td>
                               <td>SPESIALIS PENYAKIT DALAM</td>
                               <td><a href="#"></a>Hasil Laboratorium</td>
                               <td><div class="badge badge-danger">Rawat Inap</div></td>
                               <td>
                                    <a href="#" class="btn btn-sm btn-success"><i class="fas fa-download"></i> RM</a>
                                    <a href="{{ route('rj.dokterAdd') }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Copy</a>
                               </td>
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
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush