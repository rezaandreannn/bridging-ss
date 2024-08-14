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
                            <a href="{{ route('list_pasiens.dokter')}}" class="btn btn-sm btn-light"><i class="fas fa-arrow-rotate-back"></i> Kembali</a>
                        </div>
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('update.spkfr') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="" value="" readonly>{{$asesmenDokter->anamnesa}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pemeriksaan Fisik dan Uji Fungsi </label>
                                            <input type="hidden" class="form-control" name="no_registrasi" value="{{$lembarSpkfr->no_registrasi}}" ></input>
                                            {{-- <input type="hidden" class="form-control" name="kode_transaksi_fisio" value="{{$lembarSpkfr->kode_transaksi_fisio}}"></input> --}}
                                            <input type="text" class="form-control" name="pemeriksaan_fisik" value="{{$lembarSpkfr->pemeriksaan_fisik}}" ></input>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis Medis (ICD-10)</label>
                                            <textarea class="form-control" rows="2" name="diagnosis_medis">{{$lembarSpkfr->diagnosis_medis}}</textarea>
                       
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosis Fungsi (ICD-10)</label>
                                            <select name="diagnosis_fungsi" class="form-control select2" data-placeholder="Pilih Diagnosa Fungsi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected disabled>-- Pilih Diagnosa --</option>
                                                @foreach ($diagnosisFungsi as $diagFungsi)
                                                <option value="{{$diagFungsi->id}}" {{ $lembarSpkfr->diagnosis_fungsi == $diagFungsi->id ? 'selected' : '' }}>{{$diagFungsi->nama_diagnosis_fungsi}}</option>
                                        
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Pemeriksaan Penunjang</label>
                                            <input type="text" class="form-control" name="pemeriksaan_penunjang" value="{{$lembarSpkfr->pemeriksaan_penunjang}}" ></input>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tata Laksana KFR (ICD 9 CM)</label>
                                            <input type="text" class="form-control" name="tata_laksana_kfr" value="{{$lembarSpkfr->tata_laksana_kfr}}" ></input>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Suspek Penyakit Akibat Kerja</label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_akibat_kerja" value="Ya" id="penyakit_akibat_kerja1" @if($lembarSpkfr->penyakit_akibat_kerja=='Ya' ) checked @endif>
                                                <label class="form-check-label">
                                                    Ya
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="penyakit_akibat_kerja" value="Tidak" id="penyakit_akibat_kerja2" @if($lembarSpkfr->penyakit_akibat_kerja=='Tidak' ) checked @endif>
                                                <label class="form-check-label" >
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Deskrispsi suspek penyakit akibat kerja <code>Isi jika ya</code></label>
                                            <input type="text" class="form-control" name="deskripsi_akibat_kerja" value="{{$lembarSpkfr->deskripsi_akibat_kerja}}" ></input>
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