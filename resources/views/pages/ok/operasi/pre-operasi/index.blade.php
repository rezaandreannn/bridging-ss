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
                                            <th scope="col">Status</th>
                                            <th scope="col">Verifikasi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($preOperasi as $booking)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$booking->kode_register}}</td>
                                            <td>{{$booking->tanggal}}</td>
                                            <td>{{ ucwords(strtolower(trim($booking->nama_pasien))) }}</td>
                                            <td>{{$booking->no_mr}}</td>
                                            <td>{{$booking->nama_dokter}}</td>
                                            <td>
                                                @if (isset($statusPre[$booking->kode_register]) && array_filter($statusPre[$booking->kode_register]))
                                                <span class="badge badge-success">Sudah</span>
                                                @else
                                                <span class="badge badge-danger">Belum</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($verifikasiPre[$booking->kode_register]) && array_filter($verifikasiPre[$booking->kode_register]))
                                                <span class="badge badge-light">
                                                    {{ $verifikasiPre[$booking->kode_register]['verifikasi']->user->name }} <br> {{ $verifikasiPre[$booking->kode_register]['verifikasi']->created_at }}
                                                </span>

                                                @else
                                                -
                                                @endif
                                            </td>
                                            <td>  
                                                <div class="dropdown d-inline">
                                                    <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        {{-- Input --}}
                                                        @if (isset($statusPre[$booking->kode_register]) && 
                                                            array_filter($statusPre[$booking->kode_register]))
                                                              <a class="dropdown-item has-icon" href="{{ route('operasi.pre-operasi.edit', $booking->kode_register) }}">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            
                                                            {{-- tombol verifikasi anastesi --}}

                                                            @if (!isset($verifikasiPre[$booking->kode_register]) || !array_filter($verifikasiPre[$booking->kode_register]))
                                                            <form id="verifikasi-form-{{$booking->kode_register}}" action="{{ route('operasi.pre-operasi.Verifikasi-pre-op', $booking->kode_register) }}" method="POST" style="display: none;">
                                                                @method('post')
                                                                @csrf
                                                            </form>
                                                            <a class="dropdown-item has-icon" confirm-delete="true" data-menuId="{{$booking->kode_register}}" href="#"><i class="fas fa-check"></i> Verifkasi</a>
                                                            @endif
                                                            
                                                        @else
                                                        <a class="dropdown-item has-icon" href="{{ route('operasi.pre-operasi.create', $booking->kode_register )}}"> 
                                                            <i class="fas fa-pencil-alt"></i> Tambah
                                                        </a>
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
                title: 'Apakah Kamu Yakin Menerima Pasien?'
                , text: "Anda tidak akan dapat mengembalikan ini!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#6777EF'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Terima!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $('#verifikasi-form-' + menuId);
                    if (form.length) {
                        form.submit();
                    } else {
                        console.error('Data gagal di verifikasi!:', menuId);
                    }
                }
            });
        });
    });

</script>

@endpush
