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

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.ruang.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Ruang Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-ruang">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Ruang</th>
                                    <th scope="col">Nama Ruang</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $ruang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ruang->kode_ruang }}</td>
                                    <td>{{ $ruang->nama_ruang }}</td>
                                    <td> 
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit-ruang{{ $ruang->id }}">
                                            <i class="fas fa-plus"></i> Edit
                                        </button>
                                        <form id="delete-form-{{$ruang->id}}" action="{{ route('operasi.ruang.destroy', $ruang->id) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <a class="btn btn-danger btn-sm" confirm-delete="true" data-menuId="{{$ruang->id}}" href="#"><i class="fas fa-trash"></i> Delete</a>
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

<div class="modal fade" id="modal-add-ruang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operasi.ruang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Ruang</label>
                                <input type="text" name="kode_ruang" value="{{ old('kode_ruang')}}" class="form-control @error('kode_ruang') is-invalid @enderror">
                            </div>
                            @error('kode_ruang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Ruang</label>
                                <input type="text" name="nama_ruang" value="{{ old('nama_ruang')}}" class="form-control @error('nama_ruang') is-invalid @enderror">
                            </div>
                            @error('nama_ruang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> 
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data as $ruang)
<div class="modal fade" id="modal-edit-ruang{{ $ruang->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditRuangLabel{{ $ruang->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditRuangLabel{{ $ruang->id }}">Edit Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('operasi.ruang.update', $ruang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editKodeRuang{{ $ruang->id }}">Kode Ruang</label>
                        <input type="text" class="form-control" id="editKodeRuang{{ $ruang->id }}" name="kode_ruang" value="{{ $ruang->kode_ruang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="editNamaRuang{{ $ruang->id }}">Nama Ruang</label>
                        <input type="text" class="form-control" id="editNamaRuang{{ $ruang->id }}" name="nama_ruang" value="{{ $ruang->nama_ruang }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>

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
                title: 'Apakah Kamu Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6777EF',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus saja!'
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