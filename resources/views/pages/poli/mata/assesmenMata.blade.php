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
<style>
   .custom-img {
        width: 400px;
        display: block;
        margin: 0 auto;
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
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Poli</a></div>
                <div class="breadcrumb-item">Poli Mata</div>
                <div class="breadcrumb-item">Assesmen Awal</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no mr -->
                    {{-- @include('components.biodata-pasien-fisio-bymr') --}}
                    <!-- components biodata pasien by no mr -->
                    <div class="card card-primary">
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Pemeriksaaan Fisik Mata</h4>
                                            <img src="{{ asset('img/mata.png') }}" class="center-img custom-img"/>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="palpebra_kiri" class="form-control @error('palpebra_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('palpebra_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">PALPEBRA</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="palpebra_kanan" class="form-control @error('palpebra_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('palpebra_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="conjuctiva_kiri" class="form-control @error('conjuctiva_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('conjuctiva_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">CONJUCTIVA</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="conjuctiva_kanan" class="form-control @error('conjuctiva_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('conjuctiva_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="cornea_kiri" class="form-control @error('cornea_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('cornea_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">CORNEA</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="cornea_kanan" class="form-control @error('cornea_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('cornea_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kiri" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('coa_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">C.O.A</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kanan" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('coa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kiri" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('coa_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">IRIS</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kanan" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('coa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kiri" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('coa_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">PUPIL</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kanan" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('coa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kiri" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('coa_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">LENSA</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kanan" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('coa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kiri" class="form-control @error('coa_kiri') is-invalid @enderror" placeholder="Inputan Mata Kiri">
                                        </div>
                                        @error('coa_kiri')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <h4 style="text-align: center">VITREOSH HUMOR</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="coa_kanan" class="form-control @error('coa_kanan') is-invalid @enderror" placeholder="Inputan Mata Kanan">
                                        </div>
                                        @error('coa_kanan')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Pemeriksaaan Penunjang</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Laboratorium</label>
                                            <input type="text" name="penunjang_lab" class="form-control @error('penunjang_lab') is-invalid @enderror">
                                            @error('penunjang_lab')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Radiologi</label>
                                            <input type="text" name="penunjang_radiologi" class="form-control @error('penunjang_radiologi') is-invalid @enderror">
                                            @error('penunjang_radiologi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Lain-lain</label>
                                            <input type="text" name="penunjang_lainnya" class="form-control @error('penunjang_lainnya') is-invalid @enderror">
                                            @error('penunjang_lainnya')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis <code>*</code></label>
                                            <textarea name="diagnosis" class="form-control  @error('diagnosis') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('diagnosis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Masalah Kesehatan</label>
                                            <textarea name="masalah_kesehatan" class="form-control  @error('masalah_kesehatan') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('masalah_kesehatan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Terapi</label>
                                            <textarea name="terapi" class="form-control  @error('terapi') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('terapi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rencana Tindakan</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Tidak Ada" id="rencana_tindakan1" @if(old('rencana_tindakan', '0' )=='Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_tindakan1">
                                                                Tidak Ada
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Ada" id="rencana_tindakan2" @if(old('rencana_tindakan', '0' )=='Ada' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_tindakan2">
                                                                Ada, Jenis Tindakan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="rencana_tindakan" class="form-control @error('rencana_tindakan') is-invalid  
                                                @enderror" value="{{old('rencana_tindakan')}}" placeholder="Jenis Tindakan ...">
                                                </div>
                                                @error('rencana_tindakan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diet</label>
                                            <textarea name="diet" class="form-control  @error('diet') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('diet')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Konsul</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="konsul" value="Tidak" id="konsul1" @if(old('konsul', '0' )=='Tidak' ) checked @endif>
                                                            <label class="form-check-label" for="konsul1">
                                                                Tidak
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="konsul" value="Iya" id="konsul2" @if(old('konsul', '0' )=='Iya' ) checked @endif>
                                                            <label class="form-check-label" for="konsul2">
                                                                Iya, Kebagian
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="konsul" class="form-control @error('konsul') is-invalid  
                                                @enderror" value="{{old('konsul')}}" placeholder="Kebagian konsul ...">
                                                </div>
                                                @error('konsul')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                                <a href="{{ route('poliMata.assesmenMata')}}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>     Simpan</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
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

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>



@endpush