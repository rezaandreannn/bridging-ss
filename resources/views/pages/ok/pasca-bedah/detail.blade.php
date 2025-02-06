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
                <div class="breadcrumb-item active"><a href="{{ route('prabedah.verifikasi-prabedah.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Perencanaan Pasca Bedah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary card-fixed">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">{{ $biodata->NAMA_PASIEN}} - ({{ $biodata->NO_MR}})</a>
                            </div>
                            <div class="author-box-job"><b></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-md-12">
                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Rekanan</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodata->NAMAREKANAN ?? ''}}
                                            </div>
                                        </div>
                    
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Tanggal Lahir</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ date('d-m-Y', strtotime($biodata->TGL_LAHIR))}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Jenis Kelamin</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : @if ($biodata->JENIS_KELAMIN == 'L')
                                                Laki-Laki
                                                @else
                                                Perempuan
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Umur</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                @php
                                                use Carbon\Carbon; // Pastikan Carbon diimpor
                                                $dateOfBirth = Carbon::parse($biodata->TGL_LAHIR);
                                                $age = $dateOfBirth->age; // Menghitung umur
                                                 @endphp
                                            : {{$age}} tahun
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Alamat</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodata->ALAMAT ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-sm-none"></div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header card-success">
                    <a href="{{ route('pascabedah.perencanaan-pascabedah.index')}}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-rotate-back"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tingkat Perawatan Medis</th>
                                    <th scope="col">Monitor dan Terapi Lanjutan</th>
                                    <th scope="col">Pengobatan yang diperlukan</th>
                                    <th scope="col">Dokter Operator</th>
                                    <th scope="col">Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pascaBedahDetail as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->tingkat_perawatan}}</td>
                                    <td> a. Monitor TD, Nadi, RR, Suhu Setiap : {{$item->monitoring_ttv_start}} sampai {{$item->monitoring_ttv_end}} <br><br>
                                    b. Konsultasi pemberi pelayanan lain : {{$item->konsultasi_pelayanan}}</td>
                                    <td>{{$item->terapi}}</td>
                                    <td>{{$item->nama_dokter}}</td>
                                    <td>{{$item->created_at}}</td>
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
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


@endpush
