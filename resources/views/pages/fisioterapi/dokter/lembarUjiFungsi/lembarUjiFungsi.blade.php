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

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no mr -->
                    @include('components.biodata-pasien-fisio-bymr')
                    <!-- components biodata pasien by no mr -->
                    <div class="card card-primary">
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('store.ujiFungsi') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="no_mr" class="form-control" value="{{$biodatas->NO_MR}}" readonly>
                                        <input type="hidden" name="no_registrasi" class="form-control" value="{{$biodatas->No_Reg}}" readonly>
                                        {{-- <input type="hidden" name="kode_transaksi_fisio" class="form-control" value="{{$asesmenDokterGet->kode_transaksi_fisio}}" readonly> --}}
                                      
                                        <div class="form-group">
                                            <label>Diagnosis Fungsional / Diagnosis Klinis : <code>*</code></label>
                                            <select name="diagnosis_fungsional" class="form-control select2" data-placeholder="Pilih Kode ICD 10" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected disabled>-- Pilih Diagnosa --</option>
                                                @foreach ($diagnosisMedis as $item)
                                                <option value="{{$item->id}}" {{ $diagnosisMedisGet->diagnosa_klinis == $item->id ? 'selected' : '' }}>{{$item->nama_diagnosis_medis}}</option>
                                        
                                                @endforeach
                                            </select>
                                                @error('diagnosis_fungsional')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <label>Diagnosis Fungsional / Diagnosis Klinis : <code>*</code></label>
                                            <textarea class="form-control @error('diagnosis_fungsional') is-invalid  
                                                @enderror" rows="3" name="diagnosis_fungsional"  placeholder="Masukan ...">{{ old('diagnosis_fungsional')}}</textarea>
                                                @error('diagnosis_fungsional')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div> --}}
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Instrumen Uji Fungsi / Prosedur KFR : <code>*</code></label>
                                            <textarea class="form-control @error('prosedur_kfr') is-invalid  
                                                @enderror" rows="3" name="prosedur_kfr"  placeholder="Masukan ...">{{ old('prosedur_kfr')}}</textarea>
                                                @error('prosedur_kfr')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kesimpulan : </label>
                                            <textarea class="form-control @error('kesimpulan') is-invalid  
                                                @enderror" rows="3" name="kesimpulan"  placeholder="Masukan ...">{{ old('kesimpulan')}}</textarea>
                                                @error('kesimpulan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Rekomendasi : </label>
                                            <textarea class="form-control @error('rekomendasi') is-invalid  
                                                @enderror" rows="3" name="rekomendasi"  placeholder="Masukan ...">Terapi sesuai anjuran</textarea>
                                                @error('rekomendasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Edukasi : </label>
                                            <textarea class="form-control" rows="3" name="edukasi"  placeholder="Masukan ..."></textarea>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        Tanda Tangan
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        {!! DNS2D::getBarcodeHTML($biodatas->No_MR, 'QRCODE', 2, 2) !!}
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                    <div class="col-md-3">
                                        (Nama Dokter Pemeriksa)
                                    </div> --}}
                                </div>
                        </div>
                        <div class="card-body card-khusus-body">
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>

                                {{-- <a href="{{ route('diagnosa.dokter') }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i> Simpan</a> --}}
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