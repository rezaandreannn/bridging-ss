@extends('layouts.app')

@section('title', 'Pasien')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">
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
                <div class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Master Data</a></div>
                <div class="breadcrumb-item">Tanda Tangan</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-tranksasi">
                        <i class="fas fa-plus"></i> TAMBAH TTD
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Status</th>
                                    <th>Tanda tangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ttdPetugas as $ttd)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$ttd->USERNAME}}
                                    </td>
                                    <td width="30%">{{$ttd->STATUS}}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#gambarModal{{ $ttd->ID_TTD }}">Lihat Tanda Tangan</a>
                                    </td>
                                    <td width="15%">
                                        <a href="{{ route('list-ttd.edit', ['id' => $ttd->ID_TTD]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <form id="delete-form-{{$ttd->ID_TTD}}" action="{{ route('list-ttd.delete', $ttd->ID_TTD) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <a class="btn btn-sm btn-danger" confirm-delete="true" data-menuId="{{$ttd->ID_TTD}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
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

@foreach ($ttdPetugas as $ttd)
<div class="modal fade" id="gambarModal{{ $ttd->ID_TTD }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Tanda Tangan Pengguna - {{ $ttd->USERNAME }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Dibuat: {{ $ttd->CREATE_AT }}</p>
                <img src="{{ asset('storage/ttd/' . $ttd->IMAGE) }}" class="img-fluid" alt="Gambar Pengguna">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach


<!-- modal add ttd -->
<div class="modal fade" id="modal-add-tranksasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tanda Tangan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card-body">

                    <div class="container">
                        <form method="POST" action="{{ route('list-ttd.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label class="" for="">Tanda Tangan:</label>
                                <br />
                                <div id="signat"></div>
                                <br />
                                <button id="clear">Hapus Tanda Tangan</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <br />
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>


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