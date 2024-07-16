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
                <div class="breadcrumb-item active"><a href="">Pemeriksaan Medis</a></div>
                <div class="breadcrumb-item"><a href="">Berkas</a></div>
                <div class="breadcrumb-item">Detail Tindakan</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('components.biodata-pasien-bynoreg')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Program Pemberian Obat</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Obat</th>
                                            <th>Dosis</th>
                                            <th>Rute</th>
                                            <th>Interval</th>
                                            <th>Ket</th>
                                            <th>Status</th>
                                            <th colspan="5" style="text-align: center">Catatan Pemberian</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2023-12-14</td>
                                            <td>Mecobalamin inj</td>
                                            <td>/12 jam</td>
                                            <td>IV</td>
                                            <td>/ 12 jam</td>
                                            <td>10.00/22.00</td>
                                            <td>-</td>
                                            <td>1. Perawat :RAMONA,SATRIA</td>
                                            <td>Farmasi :</td>
                                            <td>Dosis :/12 jam</td>
                                            <td>Rute :4</td>
                                            <td>Waktu :2023-12-16, 22.00</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary">Entry</a>
                                            </td>
                                        </tr>
                                    </tbody>    
                                </table>
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
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush