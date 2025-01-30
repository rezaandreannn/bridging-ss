@extends('layouts.app')

@section('title', 'Tanda Tangan Pasien')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<style>
    .modal-body img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
    }
</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('ttd.pasien.detail') }}">Tanda Tangan</a></div>
                <div class="breadcrumb-item">Dokter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('ttd-dokter.create')}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Tanda Tangan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Dokter</th>
                                    <th>Nama Dokter</th>
                                    <th>Jenis Spesialis</th>
                                    <th>Tanda tangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                       
                                @foreach ($ttdDokters as $ttd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ttd->kode_dokter }}</td>
                                    <td>{{ $ttd->nama_dokter }}</td>
                                    <td>{{ $ttd->spesialis }}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#gambarModal{{ $ttd->id }}">Lihat Tanda Tangan</a>
                                    </td>
                                    <td width="15%">
                                        <form id="delete-form-{{$ttd->id}}" action="{{ route('ttd-dokter.destroy', $ttd->id) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <a class="btn btn-danger btn-sm" href="#" confirm-delete="true" data-menuId="{{$ttd->id}}">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>

                                        <a href="{{ route('ttd-dokter.edit', $ttd->id)}}" class="btn btn-sm btn-warning"><i class="fas fa fa-edit"></i> Edit</a>
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

@foreach ($ttdDokters as $ttd)
<div class="modal fade" id="gambarModal{{ $ttd->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tanda Tangan Dokter - {{ $ttd->nama_dokter }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Dibuat: {{ $ttd->created_at }}</p>
                <img src="{{ asset('storage/ttd/dokter/' . $ttd->ttd_dokter) }}" class="img-fluid" alt="Gambar Pengguna">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach


@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>


<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


<script type="text/javascript">
    var sig = $("#signat").signature({
        syncField: "#signature64",
        syncFormat: "PNG"
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
    });
</script>

<!-- Delete Data -->
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

<!-- Page Specific JS File -->
@endpush