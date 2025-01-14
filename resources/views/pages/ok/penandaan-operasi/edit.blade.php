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
    .kbw-signature {
        width: 100%;
        height: 250px;
    }

    .eye-image {
        max-width: 100%;
    }

    .custom-judul {
        font-size: 18px;
        padding-left: 20px;
        color: #6777ef;
        margin-bottom: 0;
        width: 100%;
    }

    .no-margin {
        margin: 0;
    }

    .no-padding {
        padding: 0;
    }

    .align-items-center {
        display: flex;
        align-items: center;
        margin: 0;
    }

    @media (max-width: 768px) {
        .text-right-mobile {
            text-align: right;
            font-size: 6px;
        }

        .text-left-mobile {
            text-align: left;
            font-size: 6px;
        }

        .eye-image {
            max-width: 100px;
        }

        .my-mobile {
            margin-top: 2rem !important;
            margin-bottom: 1rem !important;
        }

        .kbw-signature {
            width: 100%;
            height: 250px;
        }
    }

    .my-0 {
        margin-top: -10px !important;
        margin-bottom: 0 !important;
    }

    .my-1 {
        margin-bottom: -30px !important;
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
                    <form id="myForm" action="{{ route('operasi.penandaan.update', $penandaan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="kode_register" value="{{ $biodata->pendaftaran->No_Reg }}">
                        <div class="card mb-3">
                            <div class="card-header card-khusus-header">
                                <h6 class="card-khusus-title">Penandaan Operasi @if ($biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L')
                                    Laki-Laki
                                    @else
                                    Perempuan
                                    @endif</h6>
                            </div>
                            <!-- include form -->
                            <div class="card-body card-khusus-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Asal Ruangan</label>
                                            <input type="text" name="asal_ruangan" value="{{ old('asal_ruangan', $penandaan->asal_ruangan ?? '')}}" class="form-control @error('asal_ruangan') is-invalid @enderror" readonly>
                                        </div>
                                        @error('tanggal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Operasi</label>
                                            <input type="text" name="jenis_operasi" value="{{ old('jenis_operasi', $penandaan->jenis_operasi ?? '')}}" class="form-control @error('jenis_operasi') is-invalid @enderror">
                                        </div>
                                        @error('jenis_operasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="#" data-toggle="modal" data-target="#gambarModal{{ $penandaan->id }}" class="badge badge-success">Preview Gambar Sebelumnya</a>
                                            {{-- {{ dd(asset('storage/operasi/' . $penandaan['hasil_gambar'])) }} --}}
                                            {{-- <img src="{{ asset('storage/operasi/'. $penandaan->hasil_gambar) }}" width="100%" height="250" /> --}}
                                        </div>
                                        @error('jenis_operasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Gambar Operasi --}}
                            <div class="card" id="{{ $biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L' ? 'formPria' : 'formWanita' }}" data-gender="{{ $biodata->pendaftaran->registerPasien->JENIS_KELAMIN }}">
                                <div class="card-body card-khusus-body">
                                    <div class="col-md-12">
                                        <div>
                                            <canvas id="drawingCanvas" width="1000" height="600" style="border:1px solid #000; width:100%; height:auto;"></canvas>
                                            <br />
                                            <button id="undoButton" type="button" class="btn btn-sm btn-primary"><i class="fas fa-undo"></i> Undo</button>
                                            <button id="clearCanvasButton" type="button" class="btn btn-sm btn-primary"><i class="fas fa-trash"></i> Hapus</button>
                                            {{-- <button id="drawButton" type="button" class="btn btn-sm btn-primary">Gambar</button> --}}
                                        </div>
                                        <textarea id="signatureData" name="signatureData" style="display:none;"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
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
                <p>Hasil Gambar</p>
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
