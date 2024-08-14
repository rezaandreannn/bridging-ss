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
                <div class="breadcrumb-item">SPKFR Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no mr -->
                    @include('components.biodata-pasien-fisio-bymr')
                    <!-- components biodata pasien by no mr -->
                    <div class="card card-primary">
                        <div class="card-header card-success card-khusus-header">
                            <h6 class="card-khusus-title">Form SPKFR Fisioterapi</h6>
                        </div>
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('store.spkfr') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="" value="" placeholder="Masukan ..." readonly>{{$asesmenDokter->anamnesa}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pemeriksaan Fisik dan Uji Fungsi </label>
                                            <input type="hidden" class="form-control" name="no_registrasi" value="{{$asesmenDokter->no_registrasi}}" placeholder="Masukan ..."></input>
                                            {{-- <input type="hidden" class="form-control" name="kode_transaksi_fisio" value="{{$asesmenDokter->kode_transaksi_fisio}}" placeholder="Masukan ..."></input> --}}
                                            <input type="text" class="form-control @error('pemeriksaan_fisik') is-invalid  
                                                @enderror" name="pemeriksaan_fisik" value="{{ old('pemeriksaan_fisik')}}"  placeholder="Masukan ..."></input>
                                                @error('pemeriksaan_fisik')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis Medis (ICD-10)</label>
                                            <select name="diagnosis_medis" class="form-control select2" data-placeholder="Pilih Diagnosa" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected disabled>-- Pilih Diagnosa --</option>
                                                @foreach ($diagnosisMedis as $diagMedis)
                                                <option value="{{$diagMedis->id}}" {{ $diagnosisMedisGet->diagnosa_klinis == $diagMedis->id ? 'selected' : '' }}>{{$diagMedis->nama_diagnosis_medis}}</option>
                                        
                                                @endforeach
                                            </select>
                                                @error('diagnosis_medis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis Medis (ICD-10)</label>
                                            <input type="text" class="form-control  @error('diagnosis_medis') is-invalid  
                                                @enderror" name="diagnosis_medis" value="{{ old('diagnosis_medis')}}"  placeholder="Masukan ..."></input>
                                                @error('diagnosis_medis')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis Fungsi (ICD-10)</label>
                                            <select name="diagnosis_fungsi" class="form-control select2" data-placeholder="Pilih diagnosa Fungsi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected disabled>-- Pilih Diagnosa --</option>
                                                @foreach ($diagnosisFungsi as $diagFungsi)
                                                <option value="{{$diagFungsi->id}}">{{$diagFungsi->nama_diagnosis_fungsi}}</option>
                                        
                                                @endforeach
                                            </select>
                                                @error('diagnosis_fungsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis Fungsi (ICD-10)</label>
                                            <input type="text" class="form-control  @error('diagnosis_fungsi') is-invalid  
                                                @enderror" name="diagnosis_fungsi" value="{{ old('diagnosis_fungsi')}}"  placeholder="Masukan ..."></input>
                                                @error('diagnosis_fungsi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tata Laksana KFR (ICD 9 CM)</label>
                                            <input type="text" class="form-control  @error('tata_laksana_kfr') is-invalid  
                                                @enderror" name="tata_laksana_kfr" value="{{ old('tata_laksana_kfr')}}"  placeholder="Masukan ..."></input>
                                                @error('tata_laksana_kfr')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Suspek Penyakit Akibat Kerja</label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_akibat_kerja" value="Ya" id="penyakit_akibat_kerja1">
                                                <label class="form-check-label">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_akibat_kerja" value="Tidak" id="penyakit_akibat_kerja2" checked>
                                                <label class="form-check-label">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskrispsi suspek penyakit akibat kerja <code>Isi jika ya</code></label>
                                            <input type="text" class="form-control" name="deskripsi_akibat_kerja" value="{{ old('deskripsi_akibat_kerja')}}"  placeholder="Masukan ..."></input>
                                        
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body card-khusus-body">
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