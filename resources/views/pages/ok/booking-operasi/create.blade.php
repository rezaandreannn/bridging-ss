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
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">

<style>
    .kbw-signature {
        width: 100%;
        height: 250px;
    }

    .eye-image {
        max-width: 100%;
    }

    .custom-judul {
        font-size: 18px;
        padding-left: 20px;
        color: #6777ef;
        margin-bottom: 0;
        width: 100%;
    }

    .no-margin {
        margin: 0;
    }

    .no-padding {
        padding: 0;
    }

    .align-items-center {
        display: flex;
        align-items: center;
        margin: 0;
    }

    @media (max-width: 768px) {
        .text-right-mobile {
            text-align: right;
            font-size: 6px;
        }

        .text-left-mobile {
            text-align: left;
            font-size: 6px;
        }

        .eye-image {
            max-width: 100px;
        }

        .my-mobile {
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
        }

        .kbw-signature {
            width: 100%;
            height: 250px;
        }
    }

    .my-0 {
        margin-top: -10px !important;
        margin-bottom: 0 !important;
    }

    .my-1 {
        margin-bottom: -30px !important;
    }

</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Penandaan Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    {{-- @include('components.biodata-pasien-bynoreg') --}}
                    <form id="myForm" action="{{ route('operasi.booking.store') }}" method="POST">
                        @csrf
                        <div class="card mb-3">
                            <div class="card-header card-khusus-header">
                                <h6 class="card-khusus-title">Booking Operasi</h6>
                            </div>
                            <!-- include form -->
                            <div class="card-body card-khusus-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>noreg</label>
                                            <input type="text" name="kode_register" value="{{ old('kode_register')}}" class="form-control @error('kode_register') is-invalid @enderror">
                                        </div>
                                        @error('kode_register')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ruangan_id</label>
                                            <input type="text" name="ruangan_id" value="{{ old('ruangan_id')}}" class="form-control @error('ruangan_id') is-invalid @enderror">
                                        </div>
                                        @error('ruangan_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>kode_dokter</label>
                                            <input type="text" name="kode_dokter" value="{{ old('kode_dokter')}}" class="form-control @error('kode_dokter') is-invalid @enderror">
                                        </div>
                                        @error('kode_dokter')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>tanggal</label>
                                            <input type="date" name="tanggal" value="{{ old('tanggal')}}" class="form-control @error('tanggal') is-invalid @enderror">
                                        </div>
                                        @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
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
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


@endpush
