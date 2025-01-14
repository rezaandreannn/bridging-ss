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
<style>
    tbody.small tr td {
        padding: 0.3rem;
    }

    .table-blue thead tr {
        background-color: #007bff;
        color: white;
    }

    .table-blue tbody tr {
        background-color: white !important;
    }

    .table-blue tbody tr:hover {
        background-color: #f2f2f2 !important;
    }

</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('prabedah.verifikasi-prabedah.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Verifikasi Pra Bedah</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            {{-- @include('components.biodata-pasien-bynoreg') --}}
            <form action="{{ route('prabedah.verifikasi-prabedah.store') }}" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Verifikasi Pra Bedah</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Berkas Rekam Medis terkait :</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status_pasien" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Status Pasien
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="assesmen_pra_bedah" id="flexCheckDefault" value="1" {{ $checklistAssesmenPraBedah == 'true' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Asesmen Pra Bedah
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="penandaan_lokasi" id="flexCheckDefault" value="1" {{ $checklistPenandaan == 'true' ? 'checked' : ''}}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Penandaan Lokasi Operasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="informed_consent_bedah" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Informed Consent Bedah
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="informed_consent_anastesi" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Informed Consent Anestesi / Sedasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="assesmen_pra_anastesi_sedasi" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Assesmen Pra Anestesi / Sedasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="edukasi_anastesi" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Edukasi Anestesi
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Hasil pemeriksaan penunjang yang telah teridentifikasi secara benar :</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="laboratorium" id="berkasLab" value="1" onclick="toggleLabData()" {{ count($labs) > 0 ? 'checked' : ''}} disabled>
                                                <label class="form-check-label" for="berkasLab">
                                                    Laboratorium
                                                </label>
                                                @if(count($labs) > 0)
                                                <div id="labData">
                                                    <div class="row">
                                                        <table class="table table-bordered table-blue table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Pemeriksaan</th>
                                                                    <th>Hasil</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="small">
                                                                @forelse ($labs as $data)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $data->PEMERIKSAAN ?? '' }}</td>
                                                                    <td>{{ $data->Hasil ?? '' }}</td>
                                                                </tr>
                                                                @empty
                                                                <tr>
                                                                    <td colspan="3" class="text-center">
                                                                        <h5>Data lab kosong</h5>
                                                                    </td>
                                                                </tr>
                                                                @endforelse
                                                            <tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="radiologi" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Radiologi
                                                </label>
                                                <input type="text" placeholder="Inputan Radiologi" class="form-control" name="deskripsi_radiologi" id="radiologi_pasien">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ekg" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    EKG
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="darah" id="darah_khusus_check" value="1">
                                                <label class="form-check-label" for="darah_khusus_check">
                                                    Darah
                                                </label>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="text" class="form-control" name="deskripsi_darah" id="darah_khusus" placeholder="Deskripsi">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control mb-3 mt-2" name="jumlah" id="jumlah_darah" placeholder="Jumlah">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control mb-3 mt-2" name="gol" id="gol_darah" placeholder="Golongan Darah">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="obat" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Obat-obat pasien yang dibawa
                                                </label>
                                                <input type="text" placeholder="Inputan Obat Pasien" class="form-control" name="deskripsi_obat" id="obat_pasien">
                                            </div>
                                        </div>
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

<script>
    function toggleLabData() {
        const labCheckbox = document.getElementById('berkasLab');
        const labDataDiv = document.getElementById('labData');
        const inputs = document.querySelectorAll('#labData input');

        if (labCheckbox.checked) {
            // Tampilkan dan aktifkan input
            labDataDiv.style.display = 'block';
            labCheckbox.setAttribute('aria-expanded', 'true');
            inputs.forEach(input => input.disabled = false);
        } else {
            // Sembunyikan dan nonaktifkan input
            labDataDiv.style.display = 'none';
            labCheckbox.setAttribute('aria-expanded', 'false');
            inputs.forEach(input => {
                input.disabled = true;
                input.value = ''; // Kosongkan nilai jika tidak dipilih
            });
        }
    }

</script>

{{-- SCRIPT TIDAK BISA HURUF --}}
<script>
    document.getElementById('hb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('trombosite').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('leukosit').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('hematokrit').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('bt').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('ct').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });

</script>

@endpush
