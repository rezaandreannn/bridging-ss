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
                <div class="breadcrumb-item active"><a href="{{ route('cppt.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">FIKI Hidayat - ( 164820 )</a>
                            </div>
                            <div class="author-box-job"><b></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                NIK
                                            </div>
                                            <div class="col-md-8">
                                                : 1872022402020001
                                            </div>
                                            <div class="col-md-4">
                                                Email
                                            </div>
                                            <div class="col-md-8">
                                                : Fiki@gmail.com

                                            </div>
                                            <div class="col-md-4">
                                                Tanggal Lahir
                                            </div>
                                            <div class="col-md-8">
                                                : 24-02-2002
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Jenis Kelamin
                                            </div>
                                            <div class="col-md-8">
                                                : Laki-Laki
                                            </div>
                                            <div class="col-md-4">
                                                No Hp
                                            </div>
                                            <div class="col-md-8">
                                                :
                                            </div>
                                            <div class="col-md-4">
                                                Alamat
                                            </div>
                                            <div class="col-md-8">
                                                : 23A KARANGREJO 25/07 METRO UTARA
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
                            <h4>Pendaftaran</h4>
                        </div>
                        <div class="card-body">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No Reg</th>
                                        <th scope="col">No MR</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Jenis Pasien</th>
                                        <th scope="col">Rekanan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
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
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush