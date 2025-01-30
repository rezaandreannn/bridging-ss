@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<style>

</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.template.index') }}">Laporan Operasi</a></div>
                <div class="breadcrumb-item">List</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama dokter</th>
                                    <th scope="col">Spesialis</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$doctor->Nama_Dokter}}</td>
                                    <td>{{$doctor->Spesialis}}</td>

                                    @php
                                    $useTemplate = \App\Models\Operasi\UseTemplateLaporanOperasi::where('kode_dokter', $doctor->Kode_Dokter)->first();
                                    @endphp

                                    <td>
                                        <a href="{{ route('operasi.doctor.show', $doctor->Kode_Dokter)}}" class="badge badge-primary border-0 rounded-0">
                                            Set Template Laporan Operasi
                                        </a>
                                        <form method="post" action="{{ route('operasi.doctor.toggle-template', $doctor->Kode_Dokter) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="use_template" value="{{ $useTemplate && $useTemplate->use_template ? 'false' : 'true' }}">
                                            <button type="submit" class="badge {{ $useTemplate && $useTemplate->use_template ? 'badge-success' : 'badge-danger' }} border-0 rounded-0">
                                                {{ $useTemplate && $useTemplate->use_template ? 'Enabled' : 'Disabled' }}
                                            </button>
                                        </form>
                                    </td>
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
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>



@endpush
