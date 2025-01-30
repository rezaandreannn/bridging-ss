@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.signin.index') }}">Checklist Pembedahan</a></div>
                <div class="breadcrumb-item">Sign In</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('operasi.signin.update',$biodata->kode_register) }}" method="POST">
                @csrf
                @method('put')
                {{-- Data UMUM --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">SIGN IN</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                                <div class="form-group">
                                    <label>Apakah pasien telah dikonfirmasi : identitas, lokasi/area operasi dan tindakan operasi dan informed consent ?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="identitas_pasien" id="identitas_pasien1" value="1" {{ ($sign->identitas_pasien =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="identitas_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="identitas_pasien" id="identitas_pasien2" value="0" {{ ($sign->identitas_pasien =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="identitas_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah lokasi operasi diberi tanda ?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="lokasi_operasi_pasien" id="lokasi_operasi_pasien1" value="1" {{ ($sign->lokasi_operasi_pasien =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lokasi_operasi_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="lokasi_operasi_pasien" id="lokasi_operasi_pasien2" value="0" {{ ($sign->lokasi_operasi_pasien =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="lokasi_operasi_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah mesin anastesi dan obat-obatan di cek lengkap?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mesin_anestesi_lengkap" id="mesin_anestesi_lengkap1" value="1" {{ ($sign->mesin_anestesi_lengkap =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mesin_anestesi_lengkap1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="mesin_anestesi_lengkap" id="mesin_anestesi_lengkap2" value="0" {{ ($sign->mesin_anestesi_lengkap =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="mesin_anestesi_lengkap2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah pasien memiliki alergi?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="alergi_pasien" id="alergi_pasien1" value="1" {{ ($sign->alergi_pasien =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="alergi_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="alergi_pasien" id="alergi_pasien2" value="0" {{ ($sign->alergi_pasien =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="alergi_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah memilikiriwayat asma / resiko aspirasi?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="riwayat_asma_pasien" id="riwayat_asma_pasien1" value="1" {{ ($sign->riwayat_asma_pasien =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riwayat_asma_pasien1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="riwayat_asma_pasien" id="riwayat_asma_pasien2" value="0" {{ ($sign->riwayat_asma_pasien =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="riwayat_asma_pasien2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Apakah rencana pemasangan implant?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pemasangan_implant" id="pemasangan_implant1" value="1" {{ ($sign->pemasangan_implant =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pemasangan_implant1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pemasangan_implant" id="pemasangan_implant2" value="0" {{ ($sign->pemasangan_implant =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pemasangan_implant2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Resiko kehilangan darah >500 ml (7ml/kg pada anak) ?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kehilangan_darah" id="kehilangan_darah1" value="1" {{ ($sign->kehilangan_darah =='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kehilangan_darah1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kehilangan_darah" id="kehilangan_darah2" value="0" {{ ($sign->kehilangan_darah =='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="kehilangan_darah2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                
                <div class="text-left">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
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
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

@endpush