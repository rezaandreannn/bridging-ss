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
                <div class="breadcrumb-item active"><a href="{{ route('penyakitSekarang.index') }}">Poli Mata</a></div>
                <div class="breadcrumb-item"><a href="{{ route('penyakitSekarang.index') }}">Master Data</a></div>
                <div class="breadcrumb-item">Riwayat Penyakit</div>
            </div>
        </div>

        <div class="section-body">
     
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-penyakit-sekarang">
                        <i class="fas fa-plus"></i> Riwayat Penyakit
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Riwayat Penyakit</th>
                                    <th scope="col">Created By</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penyakitSekarang as $item)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{$loop->iteration}}
                                    </td>
                                    <td>{{ $item->nama_penyakit_sekarang }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td width="25%">
                        
                                        <a href="#" data-toggle="modal" data-target="#modal-edit-penyakit-sekarang{{ $item->id }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>

                                        <form id="delete-form-{{$item->id}}" action="{{ route('penyakitSekarang.destroy', $item->id) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <a class="btn btn-danger btn-sm" confirm-delete="true" data-menuId="{{$item->id}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
                              
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

<!-- modal edit penyakit sekarang -->
@foreach ($penyakitSekarang as $item)
<div class="modal fade" id="modal-edit-penyakit-sekarang{{$item->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Riwayat Penyakit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('penyakitSekarang.update', $item->id) }}" method="POST">
                    @csrf
                    @method('put')
                    
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Riwayat Penyakit</label>
                            <input type="text" name="nama_penyakit_sekarang" class="form-control @error('nama_penyakit_sekarang')  is-invalid @enderror" value="{{$item->nama_penyakit_sekarang}}">
                            @error('nama_penyakit_sekarang')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
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
@endforeach


<!-- modal add ttd -->
<div class="modal fade" id="modal-add-penyakit-sekarang">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riwayat Penyakit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('penyakitSekarang.store') }}" method="POST">
            @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Riwayat Penyakit</label>
                            <input type="text" name="nama_penyakit_sekarang" class="form-control @error('nama_penyakit_sekarang')  is-invalid @enderror">
                            @error('nama_penyakit_sekarang')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
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
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>


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