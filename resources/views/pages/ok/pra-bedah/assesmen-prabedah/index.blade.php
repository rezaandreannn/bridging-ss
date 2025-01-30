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
                <div class="breadcrumb-item active"><a href="{{ route('prabedah.assesmen-prabedah.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Assesmen Pra Bedah</div>
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
                                            <th scope="col">No MR</th>
                                            <th scope="col">Nama Pasien</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Dokter Operator</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($verifikasis as $booking)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$booking->no_mr}}</td>
                                            <td>{{ ucwords(strtolower(trim($booking->nama_pasien))) }}</td>
                                            <td>{{$booking->tanggal}}</td>
                                            <td>{{$booking->nama_dokter}}</td>
                                            <td>
                                                @if (isset($statusAssesmen[$booking->id]) && $statusAssesmen[$booking->id] == 'create')
                                                <span class="badge badge-warning">Belum</span>
                                                @else
                                                <span class="badge badge-success">Sudah</span>
                                                @endif
                                            </td>
                                            <td>  
                                                <div class="dropdown d-inline">
                                                    <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        {{-- Input --}}
                                                        <a class="dropdown-item has-icon" href="{{ isset($statusAssesmen[$booking->id]) && $statusAssesmen[$booking->id] == 'create' ? route('prabedah.assesmen-prabedah.create', $booking->kode_register) : route('prabedah.assesmen-prabedah.edit', $booking->kode_register) }}">
                                                            <i class="fas fa-marker"></i> {{ isset($statusAssesmen[$booking->id]) && $statusAssesmen[$booking->id] == 'create' ? 'Tambah' : 'Edit' }}</a>
                                                            @if (!$statusTtd)
                                                            {{-- <a class="dropdown-item has-icon" href="{{ route('ttd-perawat.create') }}"> 
                                                                <i class="fas fa-signature"></i> Tanda Tangan
                                                            </a> --}}
                                                            @endif
                                                    </div>
                                                </div>
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
