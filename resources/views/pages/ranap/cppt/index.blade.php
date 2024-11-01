@extends('layouts.app')

@section('title', $title ?? '')

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
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('cppt.index') }}">Catatan Rawat Inap</a></div>
                <div class="breadcrumb-item"><a href="{{ route('cppt.index') }}">CPPT</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="{{ route('cppt.cariProcess') }}" method="get">
                    <div class="card-body">
                        <div class="section-title">Pilih Pasien</div>
                        <div class="form-group col-md-12">
                            <div class="input-group mb-3">
                                <div class="col-md-6">

                                    <select class="form-control select2" id="noReg" name="noReg">
                                        <option value="" selected disabled>-- silahkan pillih --</option>
                                        @foreach ($pasienCppt as $pasien)
                                        <option value="{{ $pasien->NO_REG }}">{{$pasien->No_MR}} | {{ $pasien->Nama_Pasien }} | {{$pasien->NAMA_RUANG}} </option>
                                        @endforeach
                                     
                                    </select>
                                </div>
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                              </div>
                            </div>
                          </div>
                    </div>
                </form>
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

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.harian') }}";
    }
</script>

@endpush