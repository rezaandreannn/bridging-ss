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
    .kbw-signature {
        width: 100%;
        height: 250px;
    }
    .eye-image {
         max-width: 100%;
         }
     .custom-judul{
         font-size: 18px;
         padding-left: 20px;
         color: #6777ef;
         margin-bottom: 0;
         width: 100%;
     }
     .no-margin {
         margin: 0;
     }
     .no-padding {
             padding: 0;
     }
     .align-items-center {
             display: flex;
             align-items: center;
             margin: 0;
     }
     @media (max-width: 768px) {
             .text-right-mobile {
                 text-align: right;
                 font-size: 6px;
             }
             .text-left-mobile {
                 text-align: left;
                 font-size: 6px;
             }
             .eye-image {
                 max-width:100px;
             }
             .my-mobile {
                 margin-top: 2rem !important;
                 margin-bottom: 1rem !important;
             }
             .kbw-signature {
                width: 100%;
                height: 250px;
            }
        }
        .my-0 {
                margin-top: -10px !important;
                margin-bottom: 0 !important;
        }
        .my-1 {
                margin-bottom: -30px !important;
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
                <div class="breadcrumb-item">Assesmen Dokter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-bynoreg')
                    <form action="{{ route('poliMata.assesmenAwalUpdate', $asasmen_dokter->NO_REG) }}" method="POST">
                    @csrf
                    @method('put')
                    <!-- components biodata pasien by no reg -->
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Allowanamnesa & Riwayat Alergi</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="NO_REG" value="{{ $noReg }}" />
                                        <input type="hidden" name="KODE_DOKTER" value="{{ $biodata->Kode_Dokter}}" />
                                        <input type="hidden" name="NO_MR" value="{{ $biodata->NO_MR}}" />
                                        <label>Keluhan Utama (Anamnesa) <code>* Wajib Diisi</code></label>
                                        <textarea name="FS_ANAMNESA" class="form-control  @error('FS_ANAMNESA') is-invalid  
                                            @enderror" style="height: 70px;" rows="7" placeholder="Masukan ...">{{ $asasmen_dokter->anamnesa }}</textarea>
                                    </div>
                                    @error('FS_ANAMNESA')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Pemeriksaan Fisik <code>*</code></label>       
                                        <textarea name="FS_CATATAN_FISIK" class="form-control  @error('FS_CATATAN_FISIK') is-invalid  
                                            @enderror" style="height: 70px;" rows="7" placeholder="Masukan ...">{{ old('FS_CATATAN_FISIK', "Suhu :  $asasmen_dokter->suhu C, Nadi :  $asasmen_dokter->nadi x/menit,  Respirasi : $asasmen_dokter->respirasi x/menit, TD : $asasmen_dokter->tekanan_darah mmHg, \nBB : $asasmen_dokter->berat_badan Kg, TB : $asasmen_dokter->tinggi_badan cm, Alergi : , Skala Nyeri :, Skrining Nutrisi : Normal") }}</textarea>
                                    </div>
                                    @error('FS_CATATAN_FISIK')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Riwayat Penyakit Dahulu</label>
                                        <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU" value="{{$biodata->FS_RIW_PENYAKIT_DAHULU!='' ? $biodata->FS_RIW_PENYAKIT_DAHULU : '-' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Riwayat Penyakit keluarga</label>
                                        <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU2" value="{{$biodata->FS_RIW_PENYAKIT_DAHULU2!='' ? $biodata->FS_RIW_PENYAKIT_DAHULU2 : '-' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Riwayat Alergi<code>*</code></label>
                                        <input type="text" class="form-control" name="FS_ALERGI" value="{{$biodata->FS_ALERGI!='' ? $biodata->FS_ALERGI : '-' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reaksi Alergi<code>*</code></label>
                                        <input type="text" class="form-control" name="FS_REAK_ALERGI" value="{{$biodata->FS_REAK_ALERGI!='' ? $biodata->FS_REAK_ALERGI : '-' }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Status & Pemeriksaan Fisik</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status Psikologis</label>
                                        <select name="status_psikologi" id="" class="form-control select2">
                                            <option value="">-- pilih --</option>
                                            <option value="1" {{ ($asasmen_dokter->status_psikologi=='1') ? 'selected' : ''}} selected>Tenang</option>
                                            <option value="2" {{ ($asasmen_dokter->status_psikologi=='2') ? 'selected' : ''}}>Cemas</option>
                                            <option value="3" {{ ($asasmen_dokter->status_psikologi=='3') ? 'selected' : ''}}>Takut</option>
                                            <option value="4" {{ ($asasmen_dokter->status_psikologi=='4') ? 'selected' : ''}}>Marah</option>
                                            <option value="5" {{ ($asasmen_dokter->status_psikologi=='5') ? 'selected' : ''}}>Sedih</option>
                                            <option VALUE="6" {{ ($asasmen_dokter->status_psikologi=='6') ? 'selected' : ''}}>Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hubungan dengan anggota keluarga</label>
                                        <select name="FS_HUB_KELUARGA" id="FS_HUB_KELUARGA" class="form-control select2 @error('FS_HUB_KELUARGA')  is-invalid @enderror">
                                            <option value="">-- Pilih Data --</option>
                                            <option value="1" selected>Baik</option>
                                            <option value="2">Tidak Baik</option>
                                        </select> 
                                        @error('FS_HUB_KELUARGA')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Konjungtiva</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KONJUNGTIVA" id="KONJUNGTIVA1" value="Pucat" {{ old('KONJUNGTIVA') == 'Pucat' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="KONJUNGTIVA1">Pucat</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KONJUNGTIVA" id="KONJUNGTIVA2" value="Pink" {{ old('KONJUNGTIVA','Pink') == 'Pink' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="KONJUNGTIVA2">Pink</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Deviasi Trakea</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="DEVIASI" id="DEVIASI1" value="Kanan" {{ old('DEVIASI') == 'Kanan' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="DEVIASI1">
                                                    Kanan
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="DEVIASI" id="DEVIASI2" value="Kiri" {{ old('DEVIASI') == 'Kiri' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="DEVIASI2">
                                                    Kiri
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="DEVIASI" id="DEVIASI3" value="" {{ old('DEVIASI') == '' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="DEVIASI3">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Skelera</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="SKELERA" id="SKELERA1" value="Ikterik" {{ old('SKELERA') == 'Ikterik' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="SKELERA1">
                                                    Ikterik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="SKELERA" id="SKELERA2" value="Tidak" {{ old('SKELERA','Tidak') == 'Tidak' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="SKELERA2">
                                                    Tidak Ikterik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>JVP</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="JVP" id="JVP1" value="Meningkat" {{ old('JVP') == 'Meningkat' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="JVP1">
                                                    Meningkat
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="JVP" id="JVP2" value="Tidak" {{ old('JVP','Tidak') == 'Tidak' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="JVP2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Bibir/Lidah</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="BIBIR" id="BIBIR1" value="Sianosis" {{ old('BIBIR') == 'Sianosis' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="BIBIR1">
                                                    Sianosis
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="BIBIR" id="BIBIR2" value="Tidak" {{ old('BIBIR','Tidak') == 'Tidak' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="BIBIR2">
                                                    Tidak
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mukosa</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="MUKOSA" id="MUKOSA1" value="Kering" {{ old('MUKOSA') == 'Kering' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="MUKOSA1">
                                                    Kering
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="MUKOSA" id="MUKOSA2" value="Tidak" {{ old('MUKOSA','Tidak') == 'Tidak' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="MUKOSA2">
                                                    Basah
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Thorax</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paru</label>
                                        <textarea name="THORAX" class="form-control   @error('THORAX') is-invalid  
                                            @enderror" rows="3"></textarea>
                                    </div>
                                    @error('THORAX')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jantung</label>
                                        <textarea name="JANTUNG" class="form-control  @error('JANTUNG') is-invalid  
                                        @enderror" rows="3"></textarea>
                                    </div>
                                    @error('JANTUNG')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Abdomen</label>
                                        <textarea name="ABDOMEN" class="form-control  @error('ABDOMEN') is-invalid  
                                        @enderror" rows="3"></textarea>
                                    </div>
                                    @error('ABDOMEN')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pinggang</label>
                                        <textarea name="PINGGANG" class="form-control  @error('PINGGANG') is-invalid  
                                        @enderror" rows="3"></textarea>
                                    </div>
                                    @error('PINGGANG')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label>EKSTREMITAS</label>
                                    <div class="row"> <!-- Tambahkan row untuk membuat grid -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Atas</label>
                                                <textarea name="EKS_ATAS" class="form-control @error('EKS_ATAS') is-invalid @enderror" rows="3"></textarea>
                                                @error('EKS_ATAS')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bawah</label>
                                                <textarea name="EKS_BAWAH" class="form-control @error('EKS_BAWAH') is-invalid @enderror" rows="3"></textarea>
                                                @error('EKS_BAWAH')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Pemeriksaaan Penunjang</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Order Periksa Laboratorium Control Selanjutnya</label>
                                        <select name="periksa_lab[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Lab" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                            <option value="" disabled>-- Pilih Periksa Lab --</option>
                                            @forelse ($getLab as $gl)
                                            @foreach ($masterLab as $ml)
                                            <option value="{{ $ml->No_Jenis }}" {{ $ml->No_Jenis == $gl->fs_kd_tarif ? "selected" : "" }}>{{ $ml->Jenis }}</option>
                                            @endforeach
                                            @empty
                                            @foreach ($masterLab as $ml)
                                            <option value="{{ $ml->No_Jenis }}">{{ $ml->Jenis }}</option>
                                            @endforeach
                                            @endforelse
                                        </select>
                                        @error('periksa_lab')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label>Order Periksa Radiologi Control Selanjutnya</label>
                                            <select name="periksa_rad[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Radiologi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Periksa Radiologi --</option>
                                                @forelse ($getRad as $gr)
                                                @foreach ($masterRadiologi as $mr)
                                                <option value="{{ $mr->No_Rinci }}" {{ $mr->No_Rinci == $gr->fs_kd_tarif ? "selected" : "" }}>{{ $mr->Ket_Tindakan }}</option>
                                                @endforeach
                                                @empty
                                                @foreach ($masterRadiologi as $mr)
                                                <option value="{{ $mr->No_Rinci }}">{{ $mr->Ket_Tindakan }}</option>
                                                @endforeach
                                                @endforelse
                                            </select>
                                            @error('periksa_radiologi')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Bagian</label>
                                            <select name="FS_BAGIAN" class="form-control select2" data-placeholder="Pilih Periksa Bagian" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected>-- Pilih Bagian --</option>
                                                <option value="Sinistra" {{ old('FS_BAGIAN', $getCekRad->fs_bagian ?? '') == 'Sinistra' ? 'selected' : '' }}>Sinistra</option>
                                                <option value="Dextra" {{ old('FS_BAGIAN', $getCekRad->fs_bagian ?? '') == 'Dextra' ? 'selected' : '' }}>Dextra</option>
                                                <option value="Bilateral" {{ old('FS_BAGIAN', $getCekRad->fs_bagian ?? '') == 'Bilateral' ? 'selected' : '' }}>Bilateral</option>
                                            </select>
                                            @error('bagian')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card mb-3">
                        <div class="card-header card-khusus-header">
                            <h6 class="card-khusus-title">Analisis & Rencana</h6>
                        </div>
                        <!-- include form -->
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hasil Pemeriksaan Penunjang</label>
                                        <textarea name="FS_HASIL_PEMERIKSAAN_PENUNJANG" class="form-control  @error('FS_HASIL_PEMERIKSAAN_PENUNJANG') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan Hasil Pemeriksaan Penunjang ...">{{ $asasmen_dokter->DIAGNOSA }}</textarea>
                                    </div>
                                    @error('FS_HASIL_PEMERIKSAAN_PENUNJANG')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Diagnosa</label>
                                        <textarea name="FS_DIAGNOSA" class="form-control  @error('FS_DIAGNOSA') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan Diagnosa ...">{{ $asasmen_dokter->DIAGNOSA }}</textarea>
                                    </div>
                                    @error('FS_DIAGNOSA')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Daftar Masalah</label>
                                        <textarea name="FS_DAFTAR_MASALAH" class="form-control  @error('FS_DAFTAR_MASALAH') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan Daftar Masalah ...">{{ $asasmen_dokter->edukasi }}</textarea>
                                    </div>
                                    @error('FS_DAFTAR_MASALAH')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Rencana Tindakan</label>
                                        <textarea name="FS_TINDAKAN" class="form-control  @error('FS_TINDAKAN') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan Rencana Tindakan ...">{{ $asasmen_dokter->edukasi }}</textarea>
                                    </div>
                                    @error('FS_TINDAKAN')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namaobat">Nama Obat</label>
                                        <select name="nama_obat" id="namaobat" class="form-control select2 @error('nama_obat') is-invalid @enderror">
                                            <option value="" selected disabled>-- Pilih --</option>
                                            @foreach ($masterObat as $obat)
                                                <option value="{{ $obat->Nama_Obat }}">{{ $obat->Nama_Obat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="numero">Numero</label>
                                            <input type="text" class="form-control numero" onkeypress="handleKeyPress(event)">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="signa">Signa</label>
                                            <input type="text" class="form-control dosis" onkeypress="handleKeyPress(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="terapi">Terapi</label>
                                        <textarea rows="7" cols="50" style="height: 180px;" name="FS_TERAPI" class="form-control resep" id="terapi">{{ $asasmen_dokter->FS_TERAPI }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pesan</label>
                                       <input type="text" name="FS_PESAN" class="form-control @error('FS_PESAN') is-invalid  
                                        @enderror" id="FS_PESAN">
                                    </div>
                                    @error('FS_PESAN')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="text-left">
                        {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                        {{-- <a href="{{ route('poliMata.assesmenAwal', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>Simpan</a> --}}
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
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
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });
</script>

<script>
    $("#namapaketdrarfan").change(function () {
    var resep = $(".resep").val();
    if ($("#namapaketdrarfan").val() == "Post Phaco 1 Hari") {
      $(".resep").val(
        resep +
          "\n /R  Ciprofloxacin 500mg No X \n  S 2dd1   \n ---------------------------------------- \n \n /R   Asam Mefenamat 500mg No XV \n  S 3dd 1 tablet  \n ---------------------------------------- \n \n /R   Methilprednisolon 8mg No XV \n  S 3 dd 8mg  \n ---------------------------------------- \n \n /R   LFX ed No 1 \n  S 6 ddgtt 1   \n ---------------------------------------- \n \n /R   P.pred ed No V \n  S 6ddgtt 1   \n ---------------------------------------- \n"
      );
      $("#namapaketdrarfan").select2("data", null);
    } else if ($("#namapaketdrarfan").val() == "Post Phaco 1 Minggu") {
      $(".resep").val(
        resep +
          "\n /R  Bralyflex Plus No 1 \n  S 4 ddgtt 1  \n ---------------------------------------- \n \n /R  Cenfresh ed No 5 \n  S 4 ddgtt 1 ODS   \n ---------------------------------------- \n"
      );
      $("#namapaketdrarfan").select2("data", null);
    } else if ($("#namapaketdrarfan").val() == "Resep Kacamata") {
      $(".resep").val(
        resep +
          "\n /R  Sanbe Tears No 1 \n  S 4ddgtt 1 ODS  \n ---------------------------------------- \n \n /R  Berry Vision No V  \n  S 1 dd 1  \n ---------------------------------------- \n"
      );
      $("#namapaketdrarfan").select2("data", null);
    }
  });
  $("#namapaketdrsuner").change(function () {
    var resep = $(".resep").val();
    if ($("#namapaketdrsuner").val() == "Pre op Phaco") {
      $(".resep").val(
        resep +
          "\n /R  cenfresh No 5 \n  S 4 ddgtt 1 tetes ODS   \n ---------------------------------------- \n \n /R  Floxa No 2 \n  S 6 ddgtt 1 tetes O (3 hari sebelum operasi)  \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Glaucoma") {
      $(".resep").val(
        resep +
          "\n /R  Optimol 0,5 ed No 1 \n  S 2 ddgtt 1 ODS  \n ---------------------------------------- \n \n /R  Lanosan Ed No 1  \n  S 1 ddgtt 1 ODS (Malam Hari) \n ---------------------------------------- \n \n /R  Cenfresh EDMD No 5  \n  S 4 ddgtt 1 ODS \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Post Phaco 1 Hari") {
      $(".resep").val(
        resep +
          "\n /R  Ciprofloxacin 500mg No VI \n  S 2dd1 tablet  \n ---------------------------------------- \n \n /R  Natrium Diclofenak 500mg No VI \n  S 2dd1 tablet  \n ---------------------------------------- \n \n /R  Levofloxacin ed No 1 \n  S 6 ddgtt 1 \n ---------------------------------------- \n \n /R  P.pred ed No V \n  S 6 ddgtt 1 \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Post Phaco 1 Minggu") {
      $(".resep").val(
        resep +
          "\n /R  Bralyflex Plus No 1 \n  S 4 ddgtt 1 tetes  \n ---------------------------------------- \n \n /R  Cenfresh ed No 5 \n  S 4 ddgtt 1 tetes ODS   \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Resep Kacamata") {
      $(".resep").val(
        resep +
          "\n /R  Cenfresh No V \n  S 4 ddgtt 1 tetes ODS  \n ---------------------------------------- \n \n /R  Berry Vision No VI  \n  S 1 dd 1 tablet \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Post Insisi Chalazion") {
      $(".resep").val(
        resep +
          "\n /R  Ciprofloxacin 500mg No X \n  S 2 dd 1 tablet  \n ---------------------------------------- \n \n /R  Na.Diclofenak 250mg No X  \n  S 2 dd 1 tablet \n ---------------------------------------- \n \n /R  C-Mycos No 1  \n  S 3 dd 1 salep \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Post op pteregium 1 hari") {
      $(".resep").val(
        resep +
          "\n /R  LFX ed No V \n  S 6 ddgtt 1 tetes  \n ---------------------------------------- \n \n /R  C-mycos eo No 1  \n  S 3 dd 1 \n ---------------------------------------- \n \n /R  Ciprofloxacin 500mg VI  \n  S 2 dd 1 tablet \n ---------------------------------------- \n \n /R  Na Diclofenak 250mg No X  \n  S 2 dd 1 tablet \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    } else if ($("#namapaketdrsuner").val() == "Post op pteregium 1 minggu") {
      $(".resep").val(
        resep +
          "\n /R  Alletrol No 1 \n  S 4 ddgtt 1 tetes  \n ---------------------------------------- \n \n /R  Cenfresh No 1  \n  S 4 ddgtt 1 tetes \n ---------------------------------------- \n"
      );
      $("#namapaketdrsuner").select2("data", null);
    }
  });
</script>

<script type="text/javascript">

    var sig = $("#signat").signature({
        syncField: "#signature1",
        syncFormat: "PNG"
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature1").val('');
    });

    var sig2 = $("#signat2").signature({
        syncField: "#signature2",
        syncFormat: "PNG"
    });
    $('#clear2').click(function(e) {
        e.preventDefault();
        sig2.signature('clear');
        $("#signature2").val('');
    });
</script>

<script>
     function click_kondisi_pulang(selected) {
        $("#form2").hide();
        $("#form3").hide();
        $("#form4").hide();
        $("#form5").hide();
        var checkbox1 = selected.value

        if (checkbox1 == "2") {
            $("#form2").show();
        } else if (checkbox1 == "4") {
            $("#form3").show();
        } else if (checkbox1 == "6") {
            $("#form4").show();
        } else if (checkbox1 == "7") {
            $("#form5").show();

        } else {
            $("#form2").hide();
            $("#form3").hide();
            $("#form4").hide();
            $("#form5").hide();
        }
    }
</script>

<script>
    function click_alasan_skdp(selected) {

        var FS_SKDP_1 = $("#FS_SKDP_1").val();

        $.ajax({
            type: "GET",
            url: "{{ route('rj.skdp_rencana_kontrol') }}",
            data: {
                FS_SKDP_1: FS_SKDP_1
            },
            async: false,
            dataType: 'json',

            success: function(data) {
                //jika data sukses diambil dari server kita tampilkan
                //di <select id=kota


        
                var html = '';
                var i;
                let array = data.data;


                for (i = 0; i < array.length; i++) {
                    
                
                    html += '<option value=' + array[i].FS_KD_TRS + '>' + array[i].FS_NM_SKDP_RENCANA + '</option>';
                    
                }
                $('#rencana_skdp').html(html);

            }
        });
    }
</script>

{{-- Resep --}}
<script>
    function handleKeyPress(e) {
        var key = e.keyCode || e.which;
        if (key == 13) {
            e.preventDefault(); // Prevent form submission

            var namaobat = $("#namaobat").val();
            var numero = $(".numero").val();
            var dosis = $(".dosis").val();
            var resep = $(".resep").val();

            // Append new recipe information to the textarea
            $(".resep").val(
                resep +
                "\n /R   " +
                namaobat +
                "   no. " +
                numero +
                "\n S    " +
                dosis +
                "\n ----------------------------------------------- \n "
            );

            // Clear inputs
            $("#namaobat").val(null).trigger('change'); // Clear and reset select2 dropdown
            $(".numero").val(null);
            $(".dosis").val(null);

            // Optionally reopen the select2 dropdown
            $("#namaobat").select2("open");
        }
    }
</script>

{{-- SCRIPT VITAL SIGN --}}
<script>
    document.getElementById('td').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('suhu').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('nadi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('bb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('tb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('respirasi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>
{{-- SCRIPT ASSESMEN JATUH --}}
<script type="text/javascript">
     function click1(selected) {
        var checkbox1 = selected.value
        $("#hasil_check1").html(checkbox1);
        score_skrining_asasmen_jatuh();
    }

    function click2(selected) {
        var checkbox2 = selected.value
        $("#hasil_check2").html(checkbox2);
        score_skrining_asasmen_jatuh();
    }

    function click3(selected) {
        var checkbox3 = selected.value
        $("#hasil_check3").html(checkbox3);
        score_skrining_asasmen_jatuh();
    }

     // score skrining asesmen jatuh
     function score_skrining_asasmen_jatuh() {
        var score_jatuh = parseInt($("#hasil_check1").text()) + parseInt($("#hasil_check2").text()) + parseInt($("#hasil_check3").text());
        $("#totalscore_jatuh").html(score_jatuh);

        if (score_jatuh >= 3) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO TINGGI");
        } else if (score_jatuh == 2) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO SEDANG");
        } else if (score_jatuh <= 1) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO RENDAH");
        }
    }
</script>

@endpush