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
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">

<style>
    .grid {
        display: grid;
        grid-template-columns: auto 1fr; /* Kolom 1 otomatis, kolom 2 fleksibel */
        gap: 10px; /* Jarak antar elemen */
        margin-bottom: 8px;
    }

    .grid span:first-child {
        font-weight: bold; /* Opsi: Bisa buat label lebih tebal */
    }
</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Penandaan Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-ok-bynoreg')
                    <form id="myForm" action="{{ route('operasi.penandaan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kode_register" value="{{ $biodata->pendaftaran->No_Reg }}">
                        <div class="card mb-3">
                            <div class="card-header card-khusus-header">
                                <h6 class="card-khusus-title">Detail Pasien Booking</h6>
                            </div>
                            <!-- include form -->
                            <div class="card-body card-khusus-body">
                                <div class="row">
                                    <div class="col-12 col-lg-7">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="{{ asset('storage/operasi/penandaan-pasien/image/' . $penandaan->hasil_gambar) }}" alt="Gambar Operasi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-5">
                                            <div class="mt-2">
                                                <a href="#">
                                                    <h6 style="text-decoration: underline">{{$biodata->pendaftaran->registerPasien->Nama_Pasien}}</h6>
                                                </a>
                                            </div>
                
                                            <div class="my-3">
                                                {{-- <p><i class="fa fa-bed-pulse"></i> Jenis Tindakan :  {{ $biodata->nama_tindakan }}</p>
                                                <p><i class="fa fa-user-doctor"></i> Dokter : {{ $biodata->dokter->Nama_Dokter ?? ''}}</p>
                                                <p><i class="fa fa-hospital-user"></i> Ruangan : {{ $biodata->ruangan->nama_ruang }}</p>
                                                <p><i class="fa fa-file-medical"></i> Tanggal Operasi : {{ date('d-m-Y', strtotime($biodata->tanggal))}}</p>
                                                <p><i class="fa fa-clock"></i> Jam Operasi : {{ date('h:i', strtotime($biodata->jam_mulai))}} - {{ date('h:i', strtotime($biodata->jam_selesai))}} WIB</p> --}}
                                                <dl class="row">
                                                    <dt class="col-sm-4"><i class="fa fa-bed-pulse"></i> Jenis Tindakan</dt>
                                                    <dd class="col-sm-8">: {{ $biodata->nama_tindakan }}</dd>
                                                    <dt class="col-sm-4"><i class="fa fa-user-doctor"></i> Dokter</dt>
                                                    <dd class="col-sm-8">: {{ $biodata->dokter->Nama_Dokter ?? ''}}</dd>
                                                    {{-- <dd class="col-sm-12 col-sm-offset-3">-------------</dd> --}}
                                                    <dt class="col-sm-4"><i class="fa fa-hospital-user"></i> Ruangan</dt>
                                                    <dd class="col-sm-8">: {{ $biodata->ruangan->nama_ruang }}</dd>
                                                    <dt class="col-sm-4"><i class="fa fa-file-medical"></i> Tanggal Operasi</dt>
                                                    <dd class="col-sm-8">: {{ date('d-m-Y', strtotime($biodata->tanggal))}}</dd>
                                                    <dt class="col-sm-4"><i class="fa fa-clock"></i> Jam Operasi</dt>
                                                    <dd class="col-sm-8">: {{ date('h:i', strtotime($biodata->jam_mulai))}} - {{ date('h:i', strtotime($biodata->jam_selesai))}} WIB</dd>
                                                </dl>
                                            </div>
                                            <a href="cart.html" class="btn amado-btn w-100"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="gambarModal{{ $penandaan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $penandaan->nama_pasien }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Gambar Penandaan Operasi</p>
                <img id="gambarZoom{{ $penandaan->id }}" src="{{ asset('storage/operasi/penandaan-pasien/image/' . $penandaan->hasil_gambar) }}" class="img-fluid" alt="Gambar Pengguna"  style="transition: transform 0.3s ease; cursor: zoom-in;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>
<script src="{{ asset('js/page/tanda-operasi-image.js') }}"></script>
{{-- <script src="{{ asset('ttd/js/signature_pad.min.js') }}"></script> --}}

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });

</script>

<script>

</script>

<script type="text/javascript">
    var sig = $("#signat").signature({
        syncField: "#signature1"
        , syncFormat: "PNG"
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature1").val('');
    });

    var sig2 = $("#signat2").signature({
        syncField: "#signature2"
        , syncFormat: "PNG"
    });
    $('#clear2').click(function(e) {
        e.preventDefault();
        sig2.signature('clear');
        $("#signature2").val('');
    });

</script>

@endpush
