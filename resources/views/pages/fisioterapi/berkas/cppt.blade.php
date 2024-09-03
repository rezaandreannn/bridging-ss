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
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no mr -->
                @include('components.biodata-pasien-fisio-bymr')
                        <!-- components biodata pasien by no mr -->
                    <div class="card">
             
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kode Transaksi</th>
                                            <th>No MR</th>
                                            <th width="15%">Jumlah Max Fisioterapi</th>
                                            <th width="15%">Fisioterapi yang sudah dilakukan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $transaksi)
                                        <tr>
                                            <input type="hidden" class="delete_id" value="{{ $transaksi->ID_TRANSAKSI }}">
                                            <input type="hidden" class="nama" value="{{ $transaksi->NO_MR_PASIEN }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$transaksi->CREATE_AT}}</td>
                                            <td>{{$transaksi->KODE_TRANSAKSI_FISIO}}</td>
                                            <td>{{$transaksi->NO_MR_PASIEN}}</td>
                                            <td>{{$transaksi->JUMLAH_TOTAL_FISIO}}</td>
                                            <td>{{$fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI)}}</td>
                                            <td>
                                                @if($fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI)>=$transaksi->JUMLAH_TOTAL_FISIO)
                                                <span class="badge badge-pill badge-success">Selesai</span>
                                                @else
                                                <span class="badge badge-pill badge-warning">Belum selesai</span>
                                                @endif

                                            </td>
                                            <td width="20%">
                                            @can('add cppt')
                                                <a href="{{ route('cppt.detail', [
                                                'id' => $transaksi->ID_TRANSAKSI,
                                                'no_mr' => $transaksi->NO_MR_PASIEN,'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO
                                                ]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Tambah CPPT</a>
                                            @endcan

                                                <a href="{{ route('cppt.cetakCPPT', [
                                            'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO,
                                            'no_mr' => $transaksi->NO_MR_PASIEN
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fa fa-print"></i> CPPT</a>
                                                
                                                <a href="{{ route('cppt.buktiLayanan', [
                                            'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO,
                                            'no_mr' => $transaksi->NO_MR_PASIEN
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Bukti Pelayanan</a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>



@endpush