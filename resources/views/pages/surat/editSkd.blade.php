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
                <div class="breadcrumb-item active"><a href="{{ route('surat.index') }}">Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('surat.index') }}">Surat Keterangan Dokter</a></div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-bynoreg')
            <form action="{{ route('update.SKD', $skd->FS_KD_REG) }}" method="POST">
                @csrf
                @method('put')
            <!-- components biodata pasien by no reg -->
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Surat Keterangan Dokter</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="hidden" name="FS_KD_REG" value="{{ $noReg }}" />
                                    <input type="text" name="PEKERJAAN" value="{{ $skd->PEKERJAAN }}" id="PEKERJAAN" class="form-control" placeholder="-">
                                </div>
                                @error('sekolah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tujuan Surat</label>
                                    <input type="text" name="TUJUANSURAT" placeholder="Masukkan Tujuan Surat ..." value="{{ $skd->TUJUANSURAT }}" id="TUJUANSURAT" class="form-control">
                                    @error('TUJUANSURAT')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                @error('sekolah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Berat Badan</label><code> (jika kosong beri tanda -)</code>
                                    <input type="text" name="FS_BB" value="{{ $skd->FS_BB }}" id="FS_BB" placeholder="Masukkan Berat Badan ..." class="form-control" placeholder="-">
                                    @error('FS_BB')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tinggi Badan</label><code> (jika kosong beri tanda -)</code>
                                    <input type="text" name="FS_TB" value="{{ $skd->FS_TB }}" id="FS_TB" placeholder="Masukkan Tinggi Badan ..." class="form-control" placeholder="-">
                                    @error('FS_TB')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tensi Darah</label><code> (contoh : 110/90)</code>
                                    <input type="text" name="FS_TD" value="{{ $skd->FS_TD }}" placeholder="Masukkan Tensi Darah ..." id="FS_TD" class="form-control" placeholder="-">
                                    @error('FS_TD')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Buta Warna</label>
                                    <div class="input-group mb-3">
                                        <select name="BUTA_WARNA" id="" class="form-control select2">
                                            <option value="Tidak" {{ ($skd->BUTA_WARNA=='Tidak') ? 'selected' : ''}}>Tidak</option>
                                            <option value="Ya" {{ ($skd->BUTA_WARNA=='Ya') ? 'selected' : ''}}>Ya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kacamata</label>
                                    <select name="KACAMATA" id="" class="form-control select2">
                                        <option value="Tidak" {{ ($skd->KACAMATA=='Tidak') ? 'selected' : ''}}>Tidak</option>
                                        <option value="Ya" {{ ($skd->KACAMATA=='Ya') ? 'selected' : ''}}>Ya</option>
                                    </select>
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

{{-- SCRIPT VITAL SIGN --}}
<script>
    document.getElementById('jumlahhari').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

@endpush