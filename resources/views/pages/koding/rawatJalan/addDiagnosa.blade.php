@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">



{{-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> --}}
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Koding</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item">Add Diagnosa</div>
            </div>
        </div>
        <div class="section-body">
            <!-- Detail Pasien -->
            @include('components.biodata-pasien-bynoreg')
 
            <!-- form -->
            <form action="{{ route('koding.addproses', $noReg) }}" method="POST">
                @csrf
            

                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Add Diagnosa Pemeriksaan Dokter</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Diagnosa</label>
                                    <input type="text" name="diagnosa" class="form-control @error('planning')  is-invalid @enderror" value="{{$getAsesmenDokter->DIAGNOSA_MATA == NULL ? $getAsesmenDokter->FS_DIAGNOSA : $getAsesmenDokter->DIAGNOSA_MATA  }}" readonly>
                                    <input type="hidden" name="kode_dokter" value="{{$getAsesmenDokter->FS_KD_MEDIS}}">
                                    <input type="hidden" name="tanggal" value="{{$getAsesmenDokter->mdd}}">
                                    <input type="hidden" name="jam" value="{{$getAsesmenDokter->FS_JAM_TRS}}">
                                    @error('diagnosa')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode ICD10</label>
                                    <select name="kode_diagnosa" class="form-control select2" style="width: 100%;">
                                        <option value="" selected disabled>-- Pilih Kode ICD 10 --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>

                <!-- button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
                <!-- button -->
                <!-- form -->
            </form>
    </section>
    <!-- modal histori -->
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>

$(document).ready(function() {
    $('.select2').select2({
        placeholder: '-- Pilih Kode ICD 10 --',
        ajax: {
            url: '{{ route('icd10.search') }}',  // URL untuk memproses pencarian ICD10
            dataType: 'json',
            delay: 250,  // Menunggu 250ms sebelum melakukan pencarian
            data: function (params) {
                return {
                    search: params.term // Mencari berdasarkan query yang diketik
                };
            },
            processResults: function (data) {
                return {
                    results: data.map(function(item) {
                        return {
                            id: item.icd10_code,
                            text: item.icd10_code + ' || ' + item.icd10_en
                        };
                    })
                };
            },
            cache: true
        }
    });
});

</script>

@endpush