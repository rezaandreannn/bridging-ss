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
                <div class="breadcrumb-item active"><a href="{{ route('laporan.operasi.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Laporan Operasi</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('laporan.operasi.store') }}" method="POST">
            @csrf
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Data Operasi</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ruangan</label>
                                    <select name="ruang_operasi" class="form-control select2 @error('ruang_operasi') is-invalid @enderror">
                                        @foreach ($ruanganOperasi as $ruangan)
                                        <option value="{{ $ruangan->id }}" @if($biodata->ruangan->nama_ruang == $ruangan->id) selected @endif>
                                            {{ $ruangan->nama_ruang }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Register</label>
                                    <input type="text" name="no_register" value="{{$biodata->pendaftaran->No_Reg}}" class="form-control @error('no_register') is-invalid @enderror">
                                    @error('no_register')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="nama"  value="{{$biodata->pendaftaran->registerPasien->Nama_Pasien}}" class="form-control @error('nama') is-invalid @enderror">
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Umur</label>
                                    <div class="input-group">
                                        <input type="text" name="umur" id="umur" value="{{ \Carbon\Carbon::parse($biodata->pendaftaran->registerPasien->TGL_LAHIR)->age }}" class="form-control @error('umur') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Tahun</b>
                                            </div>
                                        </div>
                                        @error('umur')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Operator</label>
                                    <input type="text" name="nama_operator" value="{{$biodata->dokter->Nama_Dokter}}" class="form-control @error('nama_operator') is-invalid @enderror">
                                    @error('nama_operator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Asisten</label>
                                    <input type="text" name="nama_asisten" class="form-control @error('nama_asisten') is-invalid @enderror">
                                    @error('nama_asisten')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Perawat</label>
                                    <input type="text" name="nama_perawat" class="form-control @error('nama_perawat') is-invalid @enderror">
                                    @error('nama_perawat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Ahli Anestesi</label>
                                    <input type="text" name="ahli_anestesi" class="form-control @error('ahli_anestesi') is-invalid @enderror">
                                    @error('nama_perawat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Anestesi</label>
                                    <input type="text" name="nama_anestesi" class="form-control @error('nama_anestesi') is-invalid @enderror">
                                    @error('nama_anestesi')
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
                        <h6 class="card-khusus-title">Laporan Operasi</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis Pre-Operatif</label>
                                    <textarea name="pre_operatif" class="form-control" id="diagnosa_pra_op" style="height: 50px;" rows="3"></textarea>
                                    @error('pre_operatif')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis Post-Operatif</label>
                                    <textarea name="post_operatif" class="form-control" id="diagnosa_post_op" style="height: 50px;" rows="3"></textarea>
                                    @error('post_operatif')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jaringan yang dieksisi</label>
                                    <textarea name="jaringan" class="form-control" id="jaringan_dieksekusi" style="height: 50px;" rows="3"></textarea>
                                    @error('jaringan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dikirim untuk pemeriksaan PA</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="permintaan_pa" id="permintaan_pa1" value="2">
                                        <label class="form-check-label" for="pemeriksaan_pa1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="permintaan_pa" id="permintaan_pa2" value="1" checked>
                                        <label class="form-check-label" for="permintaan_pa2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tgl Operasi</label>
                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mulai Operasi</label>
                                    <input type="time" name="mulai_operasi" class="form-control @error('mulai_operasi') is-invalid @enderror">
                                    @error('mulai_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Selesai Operasi</label>
                                    <input type="time" name="selesai_operasi" class="form-control @error('selesai_operasi') is-invalid @enderror">
                                    @error('selesai_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Lama Operasi</label>
                                    <div class="input-group">
                                        <input type="text" name="lama_operasi" id="lama_operasi" class="form-control @error('lama_operasi') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Jam</b>
                                            </div>
                                        </div>
                                        @error('lama_operasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Laporan Operasi</label>
                                    <textarea name="laporan_operasi" class="form-control" id="laporan_operasi" style="height: 100px;" rows="3"></textarea>
                                    @error('laporan_operasi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
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