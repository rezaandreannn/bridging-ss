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
                <div class="breadcrumb-item active"><a href="{{ route('prabedah.assesmen-prabedah.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Assesmen Pra Bedah</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('prabedah.assesmen-prabedah.store') }}" method="POST">
            @csrf
            <!-- components biodata pasien by no reg -->
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Assesmen Pra Bedah</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Data Subjektif (Anamnesa) <code>*Wajib Diisi</code></label>
                                    <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('anamnesa') }}</textarea>
                                    @error('anamnesa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Data Objektif (Pemeriksaan Fisik) <code> *Wajib Diisi</code></label>
                                    <textarea name="pemeriksaan_fisik" class="form-control  @error('pemeriksaan_fisik') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('pemeriksaan_fisik') }}</textarea>
                                    @error('pemeriksaan_fisik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis Pra Bedah</label>
                                    <textarea name="diagnosa" class="form-control  @error('diagnosa') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('diagnosa') }}</textarea>
                                    @error('diagnosa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Planning</label>
                                    <textarea name="planning" class="form-control  @error('planning') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('planning') }}</textarea>
                                    @error('planning')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estimasi waktu yang dibutuhkan</label>
                                    <div class="input-group">
                                        <input type="text" name="estimasi_waktu" id="waktu" class="form-control @error('estimasi_waktu') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Jam</b>
                                            </div>
                                        </div>
                                        @error('estimasi_waktu')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rencana Tindakan Pembedahan</label>
                                    <input type="text" name="rencana_tindakan" class="form-control @error('rencana_tindakan') is-invalid @enderror">
                                    @error('rencana_tindakan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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

{{-- SCRIPT TIDAK BISA HURUF --}}
<script>
    document.getElementById('waktu').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

@endpush