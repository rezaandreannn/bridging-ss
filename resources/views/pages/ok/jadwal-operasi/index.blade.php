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
                <div class="breadcrumb-item active"><a href="{{ route('operasi.jadwal.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Jadwal Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Asal Ruangan</th>
                                    <th scope="col">Terlaksana</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-pill badge-success">{{ $data->no_mr }}</span></td>
                                    <td>{{ ucwords(strtolower(trim($data->nama_pasien))) }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->nama_dokter }}</td>
                                    <td>{{ $data->asal_ruangan}}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terlaksana" class="custom-control-input" tabindex="3" id="terlaksana" {{ $data->terlaksana == '1' ? 'checked' : '' }} disabled>
                                            <label class="custom-control-label" for="terlaksana"></label>
                                        </div>
                                    </td>
                                    {{-- <td>{{ \Carbon\Carbon::parse($data->rencana_operasi)->format('H:i') }}  WIB</td> --}}
                                    <td>
                                        <div class="dropdown d-inline">
                                            <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                @if (isset($statusPenandaan[$data->id]) && $statusPenandaan[$data->id] != 'create')
                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('operasi.penandaan.cetak', $data->kode_register) }}">
                                                        <i class="fas fa-download"></i> Cetak Penandaan Operasi
                                                </a>
                                                @endif

                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('prabedah.berkas-prabedah.cetak', $data->kode_register) }}"> 
                                                    <i class="fas fa-download"></i> Cetak Pra Bedah
                                                </a>
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
