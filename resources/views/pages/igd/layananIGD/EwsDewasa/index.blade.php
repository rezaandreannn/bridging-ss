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
                <div class="breadcrumb-item active"><a href="{{ route('layanan.ewsDewasa') }}">Layanan IGD</a></div>
                <div class="breadcrumb-item"><a href="{{ route('layanan.ewsDewasa') }}">EWS</a></div>
                <div class="breadcrumb-item">Dewasa</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="section-title">Masukkan No Rekam Medis</div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="nomr" value="{{request('nomr')}}" placeholder="" aria-label="">
                              <div class="input-group-append">
                                {{-- <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button> --}}
                                <a href="{{ route('layanan.ewsDewasa.add')}}" class="btn btn-primary"><i class="fas fa-search"></i> Search</a>
                                <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
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
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

@endpush