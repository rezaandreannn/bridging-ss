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
                                @foreach ($ttdPasien as $ttd)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$ttd['USERNAME']}}
                                    </td>
                                    <td width="30%">{{$ttd['STATUS']}}</td>
                                    <td> <a href="#" data-toggle="modal" data-target="#gambarModal{{$ttd['ID_TTD']}}">Lihat Tanda Tangan</a></td>

                                    <td width="15%">
                                        <a href="{{ route('list-ttd.edit', [
                                            'id' => $ttd['ID_TTD']
                                            ]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <button id="delete" data-id="{{ $ttd['ID_TTD'] }}" data-nama="{{ $ttd['USERNAME'] }}" data-bs-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

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

<div class="modal fade" id="gambarModal{{$ttd['ID_TTD']}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tanda Tangan Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    Dibuat: {{$ttd['CREATE_AT']}}
                    <img src="{{ asset('storage/ttd/' . $ttd['IMAGE'] ) }}" width="50%" alt="Gambar Pengguna">
                </div>
            </div>
        </div>
    </div>
</div>


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
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>


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
    $(document).on('click', '#delete', function() {
        var ttd = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
                title: "Are You Sure?",
                text: "Data Will Be Deleted " + nama + " !!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "{{ route('list-ttd.delete', ['id' => ':id']) }}".replace(':id', ttd);
                } else {
                    swal("Data will not be deleted!");
                }
            });
    });
</script>

<!-- Page Specific JS File -->
@endpush