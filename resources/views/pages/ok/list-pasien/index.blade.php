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
                <div class="breadcrumb-item active"><a href="{{ route('operasi.penandaan.index') }}">Operasi</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">{{ $DoctorName ?? '' }}</h2>
            <p class="section-lead">
                Menampilkan list pasien yang sudah terjadwal untuk operasi pada hari ini tanggal <b>{{ date('d-m-Y', strtotime($date ))}}</b>.
            </p>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Asal Ruangan</th>
                                    <th scope="col">Booking by</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><b>{{ $patient->no_mr }}</b></td>
                                    <td>{{ ucwords(strtolower(trim($patient->nama_pasien))) }}</td>
                                    <td>{{ $patient->asal_ruangan ?? ''}}</td>
                                    <td>{{ $patient->created_by ?? ''}}</td>
                                    <td>
                                        @if (auth()->user()->hasRole('perawat ibs'))
                                            @if (isset($statusLaporanOperasi[$patient->id]) && $statusLaporanOperasi[$patient->id] != 'create')
                                            <a href="{{ route('operasi.list-pasien-detail.show', $patient->kode_register )}}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-file-alt"></i>
                                                Laporan Operasi
                                            </a>
                                            @endif
                                        @endif
                                        @if (auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                        <a href="{{ route('operasi.list-pasien-detail.show', $patient->kode_register )}}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-file-alt"></i>
                                            Forms
                                        </a>
                                        <div class="dropdown d-inline">
                                            <a href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-sm btn-success">
                                                <i class="fas fa-download"></i>
                                                Berkas
                                            </a>
                                            <div class="dropdown-menu">
                                                @if (isset($statusPenandaan[$patient->id]) && $statusPenandaan[$patient->id] != 'create')
                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('operasi.penandaan.cetak', $patient->kode_register) }}">
                                                    <i class="fas fa-download"></i> Unduh Penandaan Operasi</a>
                                                @endif
                                                @if (isset($statusLaporanOperasi[$patient->id]) && $statusLaporanOperasi[$patient->id] != 'create')
                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('laporan.operasi.cetak', $patient->kode_register) }}">
                                                    <i class="fas fa-download"></i> Unduh Laporan Operasi
                                                </a>
                                                @endif
                                                @if (isset($statusPascaBedah[$patient->id]) && $statusPascaBedah[$patient->id] != 'create')
                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('pascabedah.perencanaan-pascabedah.cetak', $patient->kode_register) }}"> 
                                                    <i class="fas fa-download"></i> Unduh Pasca Bedah
                                                </a>
                                                @endif
                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('prabedah.berkas-prabedah.cetak', $patient->kode_register) }}"> 
                                                    <i class="fas fa-download"></i> Unduh Pra Bedah
                                                </a>
                                            </div>
                                        </div>
                                        @endif
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
