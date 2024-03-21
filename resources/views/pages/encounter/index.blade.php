@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('resource.index') }}">Encounter</a></div>
                <div class="breadcrumb-item">Resource</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" action="" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="kode_dokter">Pilih Dokter</label>
                                    <select class="form-control select2" id="kode_dokter" name="dokter_code">
                                        <option value="" selected disabled>-- Silahkan pilih --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter['kode_dokter'] }}" {{ request('dokter_code') == $dokter['kode_dokter'] ? 'selected' : '' }}>{{ $dokter['nama_dokter'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal <small>(kosongkan tanggal saat ini)</small></label>
                                    <input type="date" class="form-control" id="tanggal" name="created_at" value="{{ request('created_at') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status_rawat">Type Class</label>
                                    <select class="form-control selectric" id="class_code" name="class_code">
                                        <option value="" selected disabled>-- Silahkan pilih --</option>
                                        @foreach ($getClass as $class)
                                        <option value="{{ $class['class_code'] }}" {{ request('class_code') == $class['class_code'] ? 'selected' : '' }}>{{ $class['class_code'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-filter"></i> Filter</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Kode Reg</th>
                                    <th>Patient Name</th>
                                    <th>Practicioner Name</th>
                                    <th>Priode Start</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($encounters as $encounter)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{ $loop->iteration}}
                                    </td>
                                    <td>{{ $encounter->kode_register }}</td>
                                    <td>{{ $encounter->patient_name }}</td>
                                    <td>{{ $encounter->practitioner_name }}</td>
                                    <td>{{ $encounter->periode_start }}</td>
                                    <td>{{ $encounter->class_code }}</td>
                                    <td>
                                        @if($encounter->status == true)
                                        <div class="badge badge-success">arrived</div>
                                        @else
                                        <div class="badge badge-danger">inactive</div>
                                        @endif
                                    </td>
                                    <td width="15%">
                                        <a href="{{ route('resource.edit', $encounter->id )}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <a href="" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
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
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('resource.index') }}";
    }
</script>
@endpush