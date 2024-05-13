@extends('layouts.app')

@section('title', 'Tanda Tangan Pasien')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{$title}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('ttd.pasien.detail') }}">Tanda Tangan</a></div>
                <div class="breadcrumb-item">Pasien</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No MR</th>
                                    <th>Dibuat</th>
                                    <th>Tanda tangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ttdDetail as $ttd)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        {{$ttd->NO_MR_PASIEN}}
                                    </td>
                                    <td>
                                        {{$ttd->CREATE_AT}}
                                    </td>
                                    <td><img src="{{ asset('storage/ttd/' . $ttd->IMAGE ) }}" width="25%" alt="Gambar Pengguna"></td>

                                    <td width="15%">
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-ttd{{$ttd->ID_TTD_PASIEN}}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button id="delete" data-id="{{ $ttd->ID_TTD_PASIEN }}" data-nama="{{ $ttd->NO_MR_PASIEN }}" data-bs-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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


@foreach ($ttdDetail as $ttd)
<!-- modal edit ttd -->
<div class="modal fade" id="modal-ttd{{$ttd->ID_TTD_PASIEN}}">
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
                        <form method="POST" action="{{ route('ttd.pasien.update',$ttd->ID_TTD_PASIEN)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <input type="hidden" name="ID_TTD_PASIEN" class="form-control" value="{{ $ttd->ID_TTD_PASIEN }}" readonly>
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