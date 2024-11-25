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
                <div class="breadcrumb-item active"><a href="{{ route('operasi.assesmen-prabedah.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Assesmen Pra Bedah</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            {{-- @include('components.biodata-pasien-bynoreg') --}}
            <form action="{{ route('operasi.assesmen-prabedah.store') }}" method="POST">
            @csrf
            <!-- components biodata pasien by no reg -->
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Assesmen Pra Bedah</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
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
                                    <textarea name="diagnosis_prabedah" class="form-control  @error('diagnosis_prabedah') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('diagnosis_prabedah') }}</textarea>
                                    @error('diagnosis_prabedah')
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
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Verifikasi Pra Bedah</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Berkas Rekam Medis terkait :</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="berkas" id="flexCheckDefault" value="1" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Status Pasien
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="berkas" id="flexCheckDefault" value="2">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Asesmen Pra Bedah & Penandaan Lokasi Operasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="berkas" id="flexCheckDefault" value="3" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Informed Consent Bedah
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="berkas" id="flexCheckDefault" value="4" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Informed Consent Anestesi / Sedasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="berkas" id="flexCheckDefault" value="5" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Assesmen Pra Anestesi / Sedasi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="berkas" id="flexCheckDefault" value="5" >
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
                                                <input class="form-check-input" type="checkbox" name="lab[]" id="berkasLab" value="1" onclick="toggleLabData()">
                                                <label class="form-check-label" for="berkasLab">
                                                    Laboratorium
                                                </label>
                                                <div id="labData" style="display: none;">
                                                    <h5 style="font-size: 12px; color:black">HB : <input type="text" name="hb" class="form-control" id="hb" readonly></h5>
                                                    <h5 style="font-size: 12px; color:black">Trombosite : <input type="text" name="trombosite" class="form-control" id="trombosite" readonly></h5>
                                                    <h5 style="font-size: 12px; color:black">Leukosit : <input type="text" name="leukosit" class="form-control" id="leukosit" readonly></h5>
                                                    <h5 style="font-size: 12px; color:black">Hematokrit : <input type="text" name="hematokrit" class="form-control" id="hematokrit" readonly></h5>
                                                    <h5 style="font-size: 12px; color:black">BT : <input type="text" name="bt" class="form-control" id="bt" readonly></h5>
                                                    <h5 style="font-size: 12px; color:black">CT : <input type="text" name="ct" class="form-control" id="ct" readonly></h5>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="rontgen" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Rontgen
                                                </label>
                                                <input type="text" placeholder="Inputan Rontgen" class="form-control" name="rontgen" id="rontgen">
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ekg" id="flexCheckDefault" value="1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    EKG
                                                </label>
                                                <input type="text" placeholder="Inputan EKG" class="form-control" name="ekg" id="ekg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="darah_khusus" id="darah_khusus_check" value="3">
                                                <label class="form-check-label" for="darah_khusus_check">
                                                    Darah / Alat khusus yang diperlukan
                                                </label>
                                            </div>
                                            <div class="form-group mt-2">
                                                <input type="text" class="form-control" name="darah_khusus" id="darah_khusus" placeholder="Deskripsi">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control mb-3 mt-2" name="jumlah_darah" id="jumlah_darah" placeholder="Jumlah">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control mb-3 mt-2" name="gol_darah" id="gol_darah" placeholder="Gol">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="obat_pasien" id="flexCheckDefault" value="4" >
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Obat-obat pasien yang dibawa
                                                </label>
                                                <input type="text" placeholder="Inputan Obat Pasien" class="form-control" name="obat_pasien" id="obat_pasien">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estimasi waktu yang dibutuhkan</label>
                                    <div class="input-group">
                                        <input type="text" name="estimasi_waktu" id="estimasi_waktu" class="form-control @error('estimasi_waktu') is-invalid  
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

<script>
   // Function to toggle the display and enable/disable fields based on checkbox selection
    function toggleLabData() {
        var labCheckbox = document.getElementById('berkasLab');
        var labDataDiv = document.getElementById('labData');
        var inputs = document.querySelectorAll('#labData input');

        if (labCheckbox.checked) {
            // Show the input fields and enable them
            labDataDiv.style.display = 'block';
            inputs.forEach(function(input) {
                input.disabled = false; // Enable each input
            });

            // Optional: Set default values (if needed)
            document.getElementById('hb').value = '1.75';           // You can set these with dynamic values from server if necessary
            document.getElementById('trombosite').value = '2.2';
            document.getElementById('leukosit').value = '5';
            document.getElementById('hematokrit').value = '2';
            document.getElementById('bt').value = '1.21';
            document.getElementById('ct').value = '1.65';
        } else {
            // Hide the input fields and disable them
            labDataDiv.style.display = 'none';
            inputs.forEach(function(input) {
                input.disabled = true; // Disable each input
            });
        }
    }
</script>

@endpush