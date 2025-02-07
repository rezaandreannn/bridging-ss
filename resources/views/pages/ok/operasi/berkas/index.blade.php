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
                <div class="breadcrumb-item active"><a href="{{ route('operasi.pre-operasi.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Pre Operasi</div>
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
                                            <th scope="col">Kode Register</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama Pasien</th>
                                            <th scope="col">No MR</th>
                                            <th scope="col">Nama Dokter</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($berkas as $booking)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$booking->kode_register}}</td>
                                            <td>{{$booking->tanggal}}</td>
                                            <td>{{ ucwords(strtolower(trim($booking->nama_pasien))) }}</td>
                                            <td>{{$booking->no_mr}}</td>
                                            <td>{{$booking->nama_dokter}}</td>
                                            <td>  
                                                @if (isset($statusPrePost[$booking->kode_register]) && 
                                                    array_filter($statusPrePost[$booking->kode_register]['pre_operasi'] ?? []) &&
                                                    array_filter($statusPrePost[$booking->kode_register]['post_operasi'] ?? []))
                                                    <a href="{{ route('operasi.berkas-prepost.show', $booking->kode_register )}}" class="btn btn-info btn-sm">
                                                        <i class="far fa-eye"></i> Lihat Detail
                                                    </a>
                                                @endif
                                                    <a class="btn btn-primary btn-sm" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" 
                                                        href="{{ route('operasi.berkas-prepost.cetak', $booking->kode_register) }}"> 
                                                        <i class="fas fa-download"></i> Unduh Berkas
                                                    </a>
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

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#table-1').DataTable();

        // Event delegation untuk tombol delete
        $('#table-1').on('click', '[confirm-delete="true"]', function(event) {
            event.preventDefault();
            var menuId = $(this).data('menuid');
            Swal.fire({
                title: 'Apakah Kamu Yakin?'
                , text: "Anda tidak akan dapat mengembalikan ini!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#6777EF'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Hapus saja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#delete-form-' + menuId);
                    if (form.length) {
                        form.submit();
                    } else {
                        console.error('Data will not be deleted!:', menuId);
                    }
                }
            });
        });
    });

</script>

@endpush
