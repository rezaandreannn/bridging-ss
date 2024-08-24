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
                        <div class="card-header card-success card-khusus-header">
                            <a href="{{ route('list_pasiens.dokter')}}" class="btn btn-sm btn-light"><i class="fas fa-arrow-rotate-back"></i> Kembali</a>
                        </div>
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('asesmenUpdate.dokter') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Registrasi Pendaftaran </label>
                                            <input type="text" name="no_registrasi" class="form-control" value="{{$biodatas->NO_REG}}" readonly>
                                            <input type="hidden" name="NO_MR" class="form-control" value="{{$biodatas->NO_MR}}" readonly>
                                            {{-- <input type="hidden" name="kode_transaksi_fisio" class="form-control" value="{{$asesmenDokterGet->kode_transaksi_fisio}}" readonly> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid  
                                                @enderror" value="{{ $asesmenDokterGet->tanggal}}">
                                                    @error('tanggal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class=" col-md-6">
                                                    <input type="time" name="jam" class="form-control" value="{{ date('H:i:s', strtotime($asesmenDokterGet->jam))}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ...">{{$asesmenDokterGet->anamnesa}}</textarea>
                                        </div>
                                        @error('anamnesa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Pemeriksaan Fisik</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tekanan Darah</label>
                                            <div class="input-group">
                                                <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->tekanan_darah}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>mmHG</b>
                                                    </div>
                                                </div>
                                                @error('tekanan_darah')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nadi</label>
                                            <div class="input-group">
                                                <input type="text" name="nadi" class="form-control @error('nadi') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->nadi}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>x/menit</b>
                                                    </div>
                                                </div>
                                                @error('nadi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Respirasi</label>
                                            <div class="input-group">
                                                <input type="text" name="respirasi" class="form-control @error('respirasi') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->respirasi}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>x/menit</b>
                                                    </div>
                                                </div>
                                                @error('respirasi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Suhu</label>
                                            <div class="input-group">
                                                <input type="text" name="suhu" class="form-control @error('suhu') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->suhu}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>C</b>
                                                    </div>
                                                </div>
                                                @error('suhu')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat Badan</label>
                                            <div class="input-group">
                                                <input type="text" name="berat_badan" class="form-control @error('berat_badan') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->berat_badan}}">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>Kg</b>
                                                    </div>
                                                </div>
                                                @error('berat_badan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Prothesa</label>
                                            <input type="text" name="prothesa" class="form-control @error('prothesa') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->prothesa}}">
                                        </div>
                                        @error('prothesa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Orthosis</label>

                                                <select name="orthosis" id="" class="form-control select2 @error('orthosis') is-invalid  
                                                @enderror" >
                                                    <option value="" selected disabled>pilih</option>
                                                    <option value="">Tidak Ada</option>
                                                    <option value="LS corset" @if($asesmenDokterGet->orthosis=='LS corset' ) selected @endif>LS corset</option>
                                                    <option value="Neck Soft Collar" @if($asesmenDokterGet->orthosis=='Neck Soft Collar' ) selected @endif>Neck Soft Collar</option>
                                                    <option value="Axillary crutch" @if($asesmenDokterGet->orthosis=='Axillary crutch' ) selected @endif>Axillary crutch</option>
                                                </select>
                                        </div>
                                        @error('orthosis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cara Pasien Datang</label>
                                            <select name="JENIS_FISIO[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Cara Pulang" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Cara Pulang --</option>
                                                <option value="#">Sendiri</option>
                                                <option value="#">Diantar</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Analisa</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosa Klinis <code>*</code></label>
                                            <textarea name="diagnosa_klinis" class="form-control  @error('diagnosa_klinis') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ...">{{$asesmenDokterGet->diagnosa_klinis}}</textarea>
                                
                                        </div>
                                        @error('diagnosa_klinis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosa Klinis <code>*</code></label>
                                            <textarea class="form-control @error('diagnosa_klinis') is-invalid  
                                                @enderror" rows="3" name="diagnosa_klinis" value="" placeholder="Masukan ...">{{ $asesmenDokterGet->diagnosa_klinis}}</textarea>
                                        </div>
                                        @error('diagnosa_klinis')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> --}}
                                    <div class="card-header card-success">
                                        <h4 class="card-title">Perencanaan</h4>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Terapi <code>*</code></label>
                                            <textarea name="jenis_terapi_fisio" class="form-control  @error('jenis_terapi_fisio') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan ...">{{$asesmenDokterGet->terapi}}</textarea>
                                            @error('jenis_terapi_fisio')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rencana Tindakan</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Tidak Ada" id="rencana_tindakan1" @if($asesmenDokterGet->rencana_tindakan=='Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_tindakan1">
                                                                Tidak Ada
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Ya" id="rencana_tindakan2" @if($asesmenDokterGet->rencana_tindakan=='Ya' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_tindakan2">
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" name="jenis_tindakan" class="form-control @error('jenis_tindakan') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->jenis_tindakan}}" placeholder="Isi jenis tindakan jika ya">
                                                </div>
                                                @error('jenis_tindakan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rujuk</label>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_rujukan" value="Tidak Ada" id="rencana_rujukan1" @if($asesmenDokterGet->rencana_rujukan=='Tidak Ada' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_rujukan1">
                                                                Tidak Ada
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_rujukan" value="Ya" id="rencana_rujukan2" @if($asesmenDokterGet->rencana_rujukan=='Ya' ) checked @endif>
                                                            <label class="form-check-label" for="rencana_rujukan2">
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rujukan Ke : </label>
                                            <input type="text" name="deskripsi_rujukan" class="form-control @error('deskripsi_rujukan') is-invalid  
                                            @enderror" value="{{$asesmenDokterGet->deskripsi_rujukan}}" placeholder="Rujukan Ke">
                                            @error('deskripsi_rujukan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                    
                                   
                                        </div>
                                    </div>

                             
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Konsul</label>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rencana_konsul" value="Tidak Ada" id="rencana_konsul1" @if($asesmenDokterGet->rencana_konsul=='Tidak Ada' ) checked @endif>
                                                        <label class="form-check-label" for="rencana_konsul1">
                                                            Tidak Ada
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rencana_konsul" value="Ya" id="rencana_konsul2" @if($asesmenDokterGet->rencana_konsul=='Ya' ) checked @endif>
                                                        <label class="form-check-label" for="rencana_konsul2">
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ke bagian : </label>
                                            <input type="text" name="deskripsi_konsul" class="form-control @error('deskripsi_konsul') is-invalid  
                                                @enderror" value="{{$asesmenDokterGet->deskripsi_konsul}}" placeholder="Ke Bagian">
                                        </div>
                                        @error('deskripsi_konsul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div> --}}


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anjuran</label>
                                            <div class="input-group">
                                                <select name="anjuran_terapi" id="" class="form-control @error('anjuran_terapi')  is-invalid @enderror">
                                                    <option value="" selected disabled>--Pilih Anjuran--</option>
                                                    <option value="1" @if($asesmenDokterGet->anjuran_terapi=='1' ) selected @endif>1</option>
                                                    <option value="2" @if($asesmenDokterGet->anjuran_terapi=='2' ) selected @endif>2</option>
                                                    <option value="3" @if($asesmenDokterGet->anjuran_terapi=='3' ) selected @endif>3</option>
                                                    <option value="4" @if($asesmenDokterGet->anjuran_terapi=='4' ) selected @endif>4</option>
                                                    <option value="5" @if($asesmenDokterGet->anjuran_terapi=='5' ) selected @endif>5</option>
                                                    <option value="6" @if($asesmenDokterGet->anjuran_terapi=='6' ) selected @endif>6</option>
                                                    <option value="7" @if($asesmenDokterGet->anjuran_terapi=='7' ) selected @endif>7</option>
                                                    <option value="8" @if($asesmenDokterGet->anjuran_terapi=='8' ) selected @endif>8</option>
                                                </select>
                                                @error('anjuran_terapi')
                                                <span class="text-danger" style="font-size: 12px;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>Seminggu</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Evaluasi</label>
                                            <div class="input-group">
                                                <select name="evaluasi_terapi" id="" class="form-control @error('evaluasi_terapi')  is-invalid @enderror">
                                                    <option value="" selected disabled>--Pilih Evaluasi--</option>
                                                    <option value="1" @if($asesmenDokterGet->evaluasi_terapi=='1' ) selected @endif>1</option>
                                                    <option value="2" @if($asesmenDokterGet->evaluasi_terapi=='2' ) selected @endif>2</option>
                                                    <option value="3" @if($asesmenDokterGet->evaluasi_terapi=='3' ) selected @endif>3</option>
                                                    <option value="4" @if($asesmenDokterGet->evaluasi_terapi=='4' ) selected @endif>4</option>
                                                    <option value="5" @if($asesmenDokterGet->evaluasi_terapi=='5' ) selected @endif>5</option>
                                                    <option value="6" @if($asesmenDokterGet->evaluasi_terapi=='6' ) selected @endif>6</option>
                                                    <option value="7" @if($asesmenDokterGet->evaluasi_terapi=='7' ) selected @endif>7</option>
                                                    <option value="8" @if($asesmenDokterGet->evaluasi_terapi=='8' ) selected @endif>8</option>
                                                </select>
                                                @error('evaluasi_terapi')
                                                <span class="text-danger" style="font-size: 12px;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>Terapi</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Instrumen Uji Fungsi / Prosedur KFR : <code>*</code></label>
                                            <textarea class="form-control @error('prosedur_kfr') is-invalid  
                                                @enderror" rows="3" name="prosedur_kfr"  placeholder="Masukan ...">{{$lembarUjiFungsiGet->prosedur_kfr}}</textarea>
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
                                                @enderror" rows="3" name="kesimpulan"  placeholder="Masukan ...">{{$lembarUjiFungsiGet->kesimpulan}}</textarea>
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
                                                @enderror" rows="3" name="rekomendasi"  placeholder="Masukan ...">{{$lembarUjiFungsiGet->rekomendasi}}</textarea>
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
                                            <textarea class="form-control" rows="3" name="edukasi"  placeholder="Masukan ...">{{$lembarUjiFungsiGet->edukasi}}</textarea>
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
                                            <input type="text" class="form-control" name="deskripsi_akibat_kerja" value="{{$lembarSpkfr->deskripsi_akibat_kerja}}"  placeholder="Masukan ..."></input>
                                        
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="card-body card-khusus-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                                <!-- <a href="{{ route('tindakan.dokter', ['no_mr' => $biodatas->NO_MR]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i> Simpan</a> -->
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