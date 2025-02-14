@extends('layouts.app')

@section('title', 'Berkas Operasi')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->

<style>
    .input-custom {
        width: 400px !important;
    }

    @media (max-width: 768px) {

        /* Jika layar kecil */
        .input-custom {
            width: 1000% !important;
            /* Jadi full di layar kecil */
        }
    }

</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <form action="" method="GET">
                <div class="input-group">
                    <input type="number" name="no_mr" value="{{ old('no_mr', request('no_mr')) }}" class="form-control input-custom  @if(session('error')) is-invalid  @endif " placeholder="Masukkan No. RM" required>
                    <button type="submit" class="btn btn-{{ session('error') ? 'danger' : 'primary' }}"><i class="fas fa-search"></i> Cari</button>
                    @if(session('error'))
                    <div class="invalid-feedback">
                        No Rekam Medis Tidak Ditemukan di pada Berkas Operasi
                    </div>
                    @endif
                </div>
            </form>
        </div>

        <div class="section-body">
            @if(!session('error') && request('no_mr'))
            @foreach($datas as $data)
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Tgl. Kunjungan {{ $data->tanggal }}</h4>
                            <a href="#" class="btn btn-outline-primary btn-sm shadow-sm">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {{-- Informasi Pasien --}}
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-semibold">Nama Pasien</div>
                                        <div class="col-8">: {{ $data->Nama_Pasien ?? '-' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-semibold">No MR</div>
                                        <div class="col-8">: {{ $data->No_MR ?? '-' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-semibold">Tanggal Lahir</div>
                                        <div class="col-8">: {{ \Carbon\Carbon::parse($data->Tgl_Lahir)->format('d-m-Y') ?? '-' }}
                                            ({{ \Carbon\Carbon::parse($data->Tgl_Lahir)->diff(\Carbon\Carbon::now())->format('%y tahun %m bulan') }})
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-semibold">Jenis Kelamin</div>
                                        <div class="col-8">: {{ $data->Jenis_Kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-semibold">Operator</div>
                                        <div class="col-8">: {{ $data->Nama_Dokter ?? '-' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4 font-weight-semibold">Kode Dokter</div>
                                        <div class="col-8">: {{ $data->kode_dokter ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center border-0">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('operasi.penandaan.cetak', $data->kode_register) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-outline-success btn-sm">Penandaan Operasi</a>
                                <a href="{{ route('prabedah.berkas-prabedah.cetak', $data->kode_register) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-outline-success btn-sm">Pra Bedah</a>
                                <a href="{{ route('laporan.operasi.cetak', $data->kode_register) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-outline-success btn-sm">Laporan Operasi</a>
                                <a href="{{ route('pascabedah.perencanaan-pascabedah.cetak', $data->kode_register) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-outline-success btn-sm">Pasca Bedah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
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
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


<!-- Page Specific JS File -->
@endpush
