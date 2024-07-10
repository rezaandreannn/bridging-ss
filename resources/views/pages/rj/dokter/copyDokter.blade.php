@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.dokter') }}">Pemeriksaan Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.dokter') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item">Dokter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('components.biodata-pasien-fisio-bymr')
                    <div class="card card-primary">
                        <div class="card-header card-success">
                            <h4 class="card-title">Pemeriksaan Dokter</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anamnesa (S)</label>
                                            <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('anamnesa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Daftar Masalah</label>
                                            <textarea name="daftar_masalah" class="form-control  @error('daftar_masalah') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('daftar_masalah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pemeriksaan Fisik (O)</label>
                                            <textarea name="pemeriksaan_fisik" class="form-control  @error('pemeriksaan_fisik') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('pemeriksaan_fisik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tindakan (P)</label>
                                            <textarea name="tindakan" class="form-control  @error('tindakan') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('tindakan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosa (A)</label>
                                            <textarea name="diagnosa" class="form-control  @error('diagnosa') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('diagnosa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Hasil USG</label>
                                            <textarea name="hasil_usg" class="form-control  @error('hasil_usg') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('hasil_usg')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosa Sekunder <code>*</code></label>
                                            <textarea name="diagnosa_sekunder" class="form-control  @error('diagnosa_sekunder') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('diagnosa_sekunder')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order Periksa Laboratorium Control Selanjutnya</label>
                                            <select name="periksa_lab[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Lab" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Periksa Lab --</option>
                                            </select>
                                            @error('periksa_lab')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order Periksa Radiologi Control Selanjutnya</label>
                                            <select name="periksa_radiologi[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Radiologi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Periksa Radiologi --</option>
                                            </select>
                                            @error('periksa_radiologi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>EKG</label>
                                            <select name="EKG" id="" class="form-control @error('EKG')  is-invalid @enderror">
                                                <option value="" selected disabled>--Pilih EKG--</option>
                                                <option value="Ya" @if(old('EKG')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('EKG')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                            @error('EKG')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pilih Paket Obat</label>
                                            <select name="paket_obat" id="" class="form-control @error('paket_obat')  is-invalid @enderror">
                                                <option value="" selected disabled>--Pilih Status Mental--</option>
                                                <option value="Dkd" @if(old('paket_obat')=='Dkd' ) selected @endif>Dkd</option>
                                                <option value="Neuropati" @if(old('paket_obat')=='Neuropati' ) selected @endif>Neuropati</option>
                                                <option value="ISPA" @if(old('paket_obat')=='ISPA' ) selected @endif>ISPA</option>
                                                <option value="Kapsul Batuk" @if(old('paket_obat')=='Kapsul Batuk' ) selected @endif>Kapsul Batuk</option>
                                                <option value="Dispepsia" @if(old('paket_obat')=='Dispepsia' ) selected @endif>Dispepsiauk</option>
                                                <option value="Kapsul Cemas" @if(old('paket_obat')=='Kapsul Cemas' ) selected @endif>Kapsul Cemas</option>
                                                <option value="Dermatitis Alergi" @if(old('paket_obat')=='Dermatitis Alergi' ) selected @endif>Dermatitis Alergi</option>
                                                <option value="Tinea" @if(old('paket_obat')=='Tinea' ) selected @endif>Tinea</option>
                                            </select>
                                            @error('paket_obat')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kondisi Pulang</label>
                                            <select name="cara_pulang" id="" class="form-control @error('cara_pulang')  is-invalid @enderror">
                                                <option value="" selected disabled>--Pilih Cara Pulang--</option>
                                                <option value="Tidak Kontrol" @if(old('cara_pulang')=='Tidak Kontrol' ) selected @endif>Tidak Kontrol</option>
                                                <option value="Kontrol" @if(old('cara_pulang')=='Kontrol' ) selected @endif>Kontrol</option>
                                                <option value="Rawat Inap" @if(old('cara_pulang')=='Rawat Inap' ) selected @endif>Rawat Inap</option>
                                                <option value="Rawat Luar RS" @if(old('cara_pulang')=='Rawat Luar RS' ) selected @endif>Rawat Luar RS</option>
                                                <option value="Rawat Internal" @if(old('cara_pulang')=='Rawat Internal' ) selected @endif>Rawat Internal</option>
                                                <option value="Kembali Ke Faskes Primer" @if(old('cara_pulang')=='Kembali Ke Faskes Primer' ) selected @endif>Kembali Ke Faskes Primer</option>
                                                <option value="PRB" @if(old('cara_pulang')=='PRB' ) selected @endif>PRB</option>
                                            </select>
                                            @error('cara_pulang')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Planning</label>
                                            <input type="text" name="planning" class="form-control @error('planning')  is-invalid @enderror">
                                            @error('planning')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
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

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush