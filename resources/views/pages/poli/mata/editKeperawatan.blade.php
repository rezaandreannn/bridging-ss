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
                <div class="breadcrumb-item active"><a href="{{ route('poliMata.index') }}">Poli</a></div>
                <div class="breadcrumb-item"><a href="{{ route('poliMata.index') }}">Mata</a></div>
                <div class="breadcrumb-item">Assesmen Perawat</div>
            </div>
        </div>

        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-bynoreg')
            <form action="{{ route('poliMata.assesmenKeperawatanUpdate', $asasmen_perawat->FS_KD_REG) }}" method="POST">
            @csrf
            @method('put')
            <!-- components biodata pasien by no reg -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Allowanamnesa & Riwayat Alergi</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Keluhan Utama (Anamnesa) <code>*</code></label>
                                    <input type="hidden" name="FS_KD_REG" value="{{ $noReg }}" />
                                    <input type="hidden" name="KODE_DOKTER" value="{{ $biodata->Kode_Dokter}}" />
                                    <input type="hidden" name="NO_MR" value="{{ $biodata->NO_MR}}" />
                                    <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan ...">{{ $asasmen_perawat->FS_ANAMNESA }}</textarea>
                                </div>
                                @error('anamnesa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Pemeriksaan Fisik</label>
                                    <textarea class="form-control" rows="3" name="FS_EDUKASI" value="" placeholder="Masukan ...">{{ $asasmen_perawat->FS_EDUKASI }}</textarea>
                                    @error('pemeriksaan_fisik')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit Dahulu</label>
                                    <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU" value="{{$asasmen_perawat->FS_RIW_PENYAKIT_DAHULU!='' ? $asasmen_perawat->FS_RIW_PENYAKIT_DAHULU : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit keluarga</label>
                                    <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU2" value="{{$asasmen_perawat->FS_RIW_PENYAKIT_DAHULU2!='' ? $asasmen_perawat->FS_RIW_PENYAKIT_DAHULU2 : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Alergi<code>*</code></label>
                                    <input type="text" class="form-control" name="FS_ALERGI" value="{{$asasmen_perawat->FS_ALERGI!='' ? $asasmen_perawat->FS_ALERGI : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reaksi Alergi<code>*</code></label>
                                    <input type="text" class="form-control" name="FS_REAK_ALERGI" value="{{$asasmen_perawat->FS_REAK_ALERGI!='' ? $asasmen_perawat->FS_REAK_ALERGI : '-' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Spiritual dan Kultural pasien</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Agama</label>
                                    <select name="FS_AGAMA" id="" class="form-control select2">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_AGAMA=='1') ? 'selected' : ''}}>Islam</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_AGAMA=='2') ? 'selected' : ''}}>Kristen</option>
                                        <option value="3" {{ ($asasmen_perawat->FS_AGAMA=='3') ? 'selected' : ''}}>Katholik</option>
                                        <option value="4" {{ ($asasmen_perawat->FS_AGAMA=='4') ? 'selected' : ''}}>Hindu</option>
                                        <option value="5" {{ ($asasmen_perawat->FS_AGAMA=='5') ? 'selected' : ''}}>Budha</option>
                                        <option value="6" {{ ($asasmen_perawat->FS_AGAMA=='6') ? 'selected' : ''}}>Konghucu</option>
                                    </select>
                                    @error('agama')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nilai/Kepercayaan khusus</label>
                                    <!-- <input type="text" class="form-control" name="FS_NILAI_KHUSUS" value=""> -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NILAI_KHUSUS" id="exampleRadios1" value="2" {{ ($asasmen_perawat->FS_NILAI_KHUSUS=='2') ? 'checked' : ''}} onclick='document.getElementById("civstaton4").disabled = true'>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NILAI_KHUSUS" id="exampleRadios2" value="1" {{ ($asasmen_perawat->FS_NILAI_KHUSUS=='1') ? 'checked' : ''}} onclick='document.getElementById("civstaton4").disabled = true'>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                                <!-- <input type="text" name="FS_NILAI_KHUSUS2" id="civstaton4" disabled size="32"> -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Status Pernikahan</label>
                                    <select name="PERNIKAHAN" id="pernikahan" class="form-control select2 @error('pernikahan')  is-invalid @enderror">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="1" {{ ($asasmen_perawat->PERNIKAHAN=='1') ? 'selected' : ''}}>Single</option>
                                        <option value="2" {{ ($asasmen_perawat->PERNIKAHAN=='2') ? 'selected' : ''}}>Menikah</option>
                                        <option value="3" {{ ($asasmen_perawat->PERNIKAHAN=='3') ? 'selected' : ''}}>Janda/Duda</option>
                                    </select>
                                    @error('pernikahan')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Pekerjaan</label>
                                    <select name="JOB" id="job" class="form-control select2 @error('pernikahan')  is-invalid @enderror">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        <option value="1" {{ ($asasmen_perawat->PERNIKAHAN=='1') ? 'selected' : ''}}>PNS</option>
                                        <option value="2" {{ ($asasmen_perawat->PERNIKAHAN=='2') ? 'selected' : ''}}>Karyawan Swasta</option>
                                        <option value="3" {{ ($asasmen_perawat->PERNIKAHAN=='3') ? 'selected' : ''}}>Lainnya</option>
                                    </select>
                                    @error('pekerjaan')
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
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Status Psikologis, Sosial dan Fungsional</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Psikologis</label>
                                    <select name="FS_STATUS_PSIK" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" onclick='document.getElementById("civstaton3").disabled = true' selected>Tenang</option>
                                        <option value="2" onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
                                        <option value="3" onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
                                        <option value="4" onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
                                        <option value="5" onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
                                        <option VALUE="6" onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
                                    </select>
                                    <input type="hidden" name="FS_STATUS_PSIK2" value="" id="civstaton3" size="32">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Mental</label>
                                    <select name="STATUS_MENTAL" id="status_mental" class="form-control select2 @error('status_mental')  is-invalid @enderror">
                                        <option value="">-- Pilih Status Mental --</option>
                                        <option value="1" {{ ($asasmen_perawat->STATUS_MENTAL=='1') ? 'selected' : ''}}>Kooperatif</option>
                                        <option value="2" {{ ($asasmen_perawat->STATUS_MENTAL=='2') ? 'selected' : ''}}>Tidak Kooperatif</option>
                                        <option value="2" {{ ($asasmen_perawat->STATUS_MENTAL=='3') ? 'selected' : ''}}>Gelisah/Delirium/Berontak</option>
                                        <option value="2" {{ ($asasmen_perawat->STATUS_MENTAL=='4') ? 'selected' : ''}}>Ketidak Mampuan Dalam Mengikuti Perintah</option>
                                    </select> 
                                    @error('status_mental')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status fungsional</label>
                                    <select name="FS_ST_FUNGSIONAL" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_ST_FUNGSIONAL=='1') ? 'selected' : ''}}>Mandiri</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_ST_FUNGSIONAL=='2') ? 'selected' : ''}}>Perlu Bantuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hubungan Dengan Anggota Keluarga</label>
                                    <select name="FS_HUB_KELUARGA" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_HUB_KELUARGA=='1') ? 'selected' : ''}}>Baik</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_HUB_KELUARGA=='2') ? 'selected' : ''}}>Tidak Baik</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Penglihatan</label>
                                    <select name="FS_PENGELIHATAN" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_PENGELIHATAN=='1') ? 'selected' : ''}}>Normal</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_PENGELIHATAN=='2') ? 'selected' : ''}}>Kabur</option>
                                        <option value="3" {{ ($asasmen_perawat->FS_PENGELIHATAN=='3') ? 'selected' : ''}}>Kaca Mata</option>
                                        <option value="4" {{ ($asasmen_perawat->FS_PENGELIHATAN=='4') ? 'selected' : ''}}>Lensa Kontak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Penciuman</label>
                                    <select name="FS_PENCIUMAN" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_PENCIUMAN=='1') ? 'selected' : ''}}>Normal</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_PENCIUMAN=='2') ? 'selected' : ''}}>Tidak Normal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pendengaran</label>
                                    <select name="FS_PENDENGARAN" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_PENDENGARAN=='1') ? 'selected' : ''}}>Normal</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_PENDENGARAN=='2') ? 'selected' : ''}}>Tidak Normal (Kanan)</option>
                                        <option value="3" {{ ($asasmen_perawat->FS_PENDENGARAN=='3') ? 'selected' : ''}}>Tidak Normal (Kiri)</option>
                                        <option value="4" {{ ($asasmen_perawat->FS_PENDENGARAN=='4') ? 'selected' : ''}}>Tidak Normal (Kanan & Kiri)</option>
                                        <option value="5" {{ ($asasmen_perawat->FS_PENDENGARAN=='5') ? 'selected' : ''}}>Alat Bantu Dengar (Kanan)</option>
                                        <option value="6" {{ ($asasmen_perawat->FS_PENDENGARAN=='6') ? 'selected' : ''}}>Alat Bantu Dengar (Kiri)</option>
                                        <option value="7" {{ ($asasmen_perawat->FS_PENDENGARAN=='7') ? 'selected' : ''}}>Alat Bantu Dengar (Kanan & Kiri)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Pemeriksaan Fisik</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keadaan Umum</label>
                                    <input type="text" name="KEADAAN_UMUM" class="form-control @error('keadaan_umum') is-invalid  
                                        @enderror" value="{{ $asasmen_perawat->KEADAAN_UMUM }}">
                                </div>
                                @error('keadaan_umum')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kesadaran</label>
                                    <input type="text" name="KESADARAN" class="form-control @error('kesadaran') is-invalid  
                                        @enderror" value="{{ $asasmen_perawat->KESADARAN }}">
                                </div>
                                @error('kesadaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>R</label>
                                    <div class="input-group">
                                        <input type="text" value="{{ $asasmen_perawat->FS_R }}" name="respirasi" id="respirasi" placeholder="masukkan hanya angka" class="form-control @error('respirasi') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                        @error('respirasi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nadi</label>
                                    <div class="input-group">
                                        <input type="text" value="{{ $asasmen_perawat->FS_NADI }}" name="nadi" id="nadi" placeholder="masukkan hanya angka" class="form-control @error('nadi') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                        @error('nadi')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>TD</label><code> (contoh : 110/90)</code>
                                    <div class="input-group">
                                        <input type="text" name="td" id="td" value="{{ $asasmen_perawat->FS_TD }}" placeholder="masukkan hanya angka" class="form-control @error('td') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>mmHg</b>
                                            </div>
                                        </div>
                                        @error('td')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suhu</label><code> (gunakan tanda . contoh : 36.5)</code>
                                    <div class="input-group">
                                        <input type="text" name="suhu" id="suhu" value="{{ $asasmen_perawat->FS_SUHU }}" placeholder="masukkan hanya angka" class="form-control @error('suhu') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>C</b>
                                            </div>
                                        </div>
                                        @error('suhu')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat Badan</label>
                                    <div class="input-group">
                                        <input type="text" name="bb" id="bb" value="{{ $asasmen_perawat->FS_BB }}" placeholder="masukkan hanya angka" class="form-control @error('bb') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>Kg</b>
                                            </div>
                                        </div>
                                        @error('bb')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <div class="input-group">
                                        <input type="text" name="tb" id="tb" value="{{ $asasmen_perawat->FS_TB }}" placeholder="masukkan hanya angka" class="form-control @error('tb') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>M/Cm</b>
                                            </div>
                                        </div>
                                        @error('tb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lingkar Kepala</label>
                                    <div class="input-group">
                                        <input type="text" name="LINGKAR_KEPALA" value="{{ $asasmen_perawat->LINGKAR_KEPALA }}" class="form-control @error('lingkar_kepala') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>cm</b>
                                            </div>
                                        </div>
                                        @error('lingkar_kepala')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Gizi</label>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="STATUS_GIZI" id="status_gizi1" value="1" {{ ($asasmen_perawat->STATUS_GIZI=='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status_gizi1">
                                                    Baik
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="STATUS_GIZI" id="status_gizi2" value="2" {{ ($asasmen_perawat->STATUS_GIZI=='2') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status_gizi2">
                                                    Cukup
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="STATUS_GIZI" id="status_gizi3" value="3" {{ ($asasmen_perawat->STATUS_GIZI=='3') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status_gizi3">
                                                    Kurang
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Kebutuhan Fungsional & Brain</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visus</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="input-group" style="margin-right: 10px;">
                                                <label for="VISUS_OD" class="mr-2 mt-2">
                                                    OD
                                                </label>
                                                <input type="text" placeholder="Inputan Mata Kanan" value="{{ $asasmen_perawat->VISUS_OD }}" class="form-control" name="VISUS_OD" id="VISUS_OD">
                                            </div>
                                            <div class="input-group" style="margin-right: 10px;">
                                                <label for="VISUS_OS" class="mr-2 mt-2">
                                                    OS
                                                </label>
                                                <input type="text" placeholder="Inputan Mata Kiri" value="{{ $asasmen_perawat->VISUS_OS }}" class="form-control" name="VISUS_OS" id="VISUS_OS">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Protesa</label>
                                    <input type="text" name="PROTESA" value="{{ $asasmen_perawat->PROTESA }}" class="form-control @error('PROTESA') is-invalid @enderror">
                                    @error('PROTESA')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Cacat Tubuh</label>
                                    <input type="text" name="CACAT" value="{{ $asasmen_perawat->CACAT }}" class="form-control @error('CACAT') is-invalid @enderror">
                                    @error('CACAT')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>ADL</label>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="ADL" value="Mandiri" id="adl1" @if(old('ADL', '0') == 'Mandiri') checked @endif>
                                                <label class="form-check-label" for="adl1">
                                                    Mandiri
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="ADL" value="Dibantu" id="adl2" @if(old('ADL', '0') == 'Dibantu') checked @endif>
                                                <label class="form-check-label" for="adl2">
                                                    Dibantu
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Reflek Cahaya</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="REFLEK_CAHAYA" value="Positif" id="reflek_cahaya1" @if(old('REFLEK_CAHAYA', '0' )=='Positif' ) checked @endif>
                                                <label class="form-check-label" for="reflek_cahaya1">
                                                    Positif
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="REFLEK_CAHAYA" value="Negatif" id="reflek_cahaya2" @if(old('REFLEK_CAHAYA', '0' )=='Negatif' ) checked @endif>
                                                <label class="form-check-label" for="reflek_cahaya2">
                                                    Negatif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pupil</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="PUPIL" value="Isokor" id="pupil1" @if(old('PUPIL', '0' )=='Isokor' ) checked @endif>
                                                <label class="form-check-label" for="pupil1">
                                                    Isokor
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="PUPIL" value="Anisokor" id="pupil2" @if(old('PUPIL', '0' )=='Anisokor' ) checked @endif>
                                                <label class="form-check-label" for="pupil2">
                                                    Anisokor
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kelumpuhan</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="LUMPUH" value="Ada" id="kelumpuhan1" @if(old('LUMPUH', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="kelumpuhan1">
                                                    Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="LUMPUH" value="Tidak Ada" id="kelumpuhan2" @if(old('LUMPUH', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="kelumpuhan2">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pusing</label>
                                    <div class="col-md-12">
                                        <div class="form-group" style="display: flex; flex-direction: row;">
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="PUSING" value="Tidak Ada" id="pusing1" @if(old('PUSING', '0') == 'Tidak Ada') checked @endif>
                                                <label class="form-check-label" for="pusing1">
                                                    Tidak Ada
                                                </label>
                                            </div>
                                            <div class="form-check" style="margin-right: 10px;">
                                                <input class="form-check-input" type="radio" name="PUSING" value="Ada" id="pusing2" @if(old('PUSING', '0') == 'Ada') checked @endif>
                                                <label class="form-check-label" for="pusing2">
                                                    Ada
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Asesmen Jatuh</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>Pasien berjalan tidak seimbang / sempoyongan</label>
                                    <select name="FS_CARA_BERJALAN1" class="form-control select2" onchange="click1(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label>
                                        Pasien berjalan menggunakan alat bantu
                                    </label>
                                    <select name="FS_CARA_BERJALAN2" class="form-control select2" onchange="click2(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <label for="check3">
                                        Pada saat akan duduk pasien memegang benda untuk menopang
                                    </label>
                                    <select name="FS_CARA_DUDUK" class="form-control select2" onchange="click3(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0">TIDAK</option>
                                        <option value="1">YA</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="hasil_check1">
                            <input type="hidden" id="hasil_check2">
                            <input type="hidden" id="hasil_check3">
                            <label for="kesimpulan" class="col-sm-2 col-form-label">Kesimpulan : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="kesimpulan_asesmen_jatuh" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Analisis & Rencana</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosa Keperawatan</label>
                                    <textarea name="diagnosa_keperawatan" class="form-control  @error('diagnosa_keperawatan') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan ..."></textarea>
                                </div>
                                @error('diagnosa_keperawatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Masalah Keperawatan</label>
                                    <select name="tujuan[]" id="masalah_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Masalah Keperawatan" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option value="">-- pilih --</option>
                                        @foreach ($masalah_perawatan as $mk)
                                        <option value="{{ $mk->FS_KD_DAFTAR_DIAGNOSA }}" >{{ $mk->FS_NM_DIAGNOSA }}</tion>
                                        @endforeach
                                    </select>
                                </div>
                                @error('masalah_keperawatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Rencana Keperawatan</label>
                                    <select multiple name="tembusan[]" id="rencana_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Rencana Keperawatan" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                        <option value="">-- pilih --</option>
                                        @foreach ($rencana_perawatan as $rp)
                                        <option value="{{ $rp->FS_KD_TRS }}" >{{ $rp->FS_NM_REN_KEP }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('rencana_perawatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Edukasi</label>
                                    <input type="text" name="edukasi" class="form-control @error('edukasi') is-invalid @enderror">
                                    @error('edukasi')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Expired Rujukan (jika pasien BPJS)</label>
                                    <input type="date" name="FS_SKDP_FASKES" id="" class="form-control" value="">
                                </div>
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