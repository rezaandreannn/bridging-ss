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
    .kbw-signature {
        width: 250px;
        height: 250px;
    }

    #sig canvas {
        width: 100% !important;
        height: auto;
    }
</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tanda Tangan Pasien</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('ttd.pasien.detail') }}">Tanda Tangan Operasi</a></div>
                <div class="breadcrumb-item">Penandaan</div>
                <div class="breadcrumb-item">Pasien Add</div>
            </div>
        </div>
   <!-- components biodata pasien by no reg -->
   @include('components.biodata-pasien-ok-bynoreg')
   
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ttd-ok.penandaan.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                            <input type="hidden" name="nama_pasien" value="{{$biodata->pendaftaran->registerPasien->Nama_Pasien}}">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="d-block">Yang bertanda tangan : </label>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="pasien" id="exampleRadios1" onclick="cek_tanda_tangan(this)" value="0">
                                      <label class="form-check-label" for="exampleRadios1">
                                        Pasien
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="pasien" id="exampleRadios2" onclick="cek_tanda_tangan(this)" value="1">
                                      <label class="form-check-label" for="exampleRadios2">
                                        Perwakilan keluarga
                                      </label>
                                    </div>
                                  </div>
                            </div>

                            <div class="col-md-4" id="form1" style="display: none">
                                <div class="form-group">
                                    <label>Nama Keluarga</label>
                                    <input type="text" name="nama_keluarga" class="form-control @error('nama_keluarga') is-invalid @enderror" >
                                </div>
                                @error('nama_keluarga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="col-md-12">
                                <label class="" for="">Tanda Tangan:</label>
                                <br />
                                <div id="signat"></div>
                                <br />
                                <button id="clear">Hapus Tanda Tangan</button>
                                <textarea id="signature64" name="ttd_pasien" style="display: none"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-left">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.ui.touch-punch.min.js') }}"></script>


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

<script>
    function cek_tanda_tangan(selected) {
        var radiobox = selected.value
        $("#form1").hide();
        if (radiobox == "1") {
            $("#form1").show();
        } 
    }
</script>
<!-- Page Specific JS File -->
@endpush