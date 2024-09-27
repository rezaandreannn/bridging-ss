@extends('layouts.app')

@section('title', $title)

@push('style')
<style>
    .textarea {
      width: 550px;
      height: 550px;
    }
  </style>
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
            <div class="col-12">
            <div class="card card-primary">
                <div class="card-header card-success">
                    <h4 class="card-title">Resume dan Hasil Laboratorium</h4>
                </div>
            
                    <div class="form-group col-md-6">
                        <div class="input-group">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-download"></i> Resume Rawat Jalan</button>
                            <button type="button" onclick="tampil_hasil_lab()" class="btn btn-danger"><i class="fas fa-info-circle"></i> Tampilkan Hasil Lab</button>
                          </div>
                        </div>
                      </div>
         
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                           {{-- Hasil Laboratorium --}}
                    <div class="card card-secondary" id="hasil_lab" style="display: none">
                        <div class="card-header card-success">
                            <h4 class="card-title">Hasil Laboratorium</h4>
                        </div>
                        <!-- include form -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">Jenis Pemeriksaan</th>
                                            <th scope="col">Hasil Pemeriksaan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($getHasilLab as $lab)
                                        <tr>
                                            <td>{{$lab->pemeriksaan}}</td>
                                            <td>{{$lab->hasil}}</td>
                                        </tr>
                                        @empty
                                            
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- @include('components.biodata-pasien-fisio-bymr') --}}
                    <div class="card card-primary">
                        <div class="card-header card-success">
                            <h4 class="card-title">Pemeriksaan Dokter</h4>
                        </div>
                        <div class="card-body">
                            <form id="myForm" action="{{route('rj.storeDokter')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anamnesa (S)</label>
                                            <input type="hidden" class="form-control" name="kode_reg" value="{{$no_reg}}">
                                            <textarea name="anamnesa" style="height: 70px;" class="form-control  @error('anamnesa') is-invalid  
                                            @enderror" rows="5" cols="50"  placeholder="Masukan ...">{{$asesmenPerawat->fs_anamnesa ?? ''}}</textarea>
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
                                            <textarea name="daftar_masalah" style="height: 70px;" class="form-control  @error('daftar_masalah') is-invalid  
                                            @enderror"  rows="5" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('daftar_masalah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    {{-- Suhu : {$vs.FS_SUHU} C, Nadi : {$vs.FS_NADI} x/menit,  Respirasi : {$vs.FS_R} x/menit, TD : {$vs.FS_TD} mmHg, BB : {$vs.FS_BB}, TB : {$vs.FS_TB}, Alergi :  {if $alergi.FS_ALERGI eq '1'} Belum Diketahui,  {elseif $alergi.FS_ALERGI eq '2'} Tidak Ada {elseif $alergi.FS_ALERGI eq '3'}  Ada, {$alergi.FS_ALERGI2} {else}
                {/if}Skala Nyeri :{$nyeri.FS_NYERIS}, Skrining Nutrisi :  {if $result.FS_KD_LAYANAN eq 'P003' || $result.FS_KD_LAYANAN2 eq 'P003'|| $result.FS_KD_LAYANAN3 eq 'P003'}  {if ($nutrisi.FS_NUTRISI_ANAK1 + $nutrisi.FS_NUTRISI_ANAK2+ $nutrisi.FS_NUTRISI_ANAK3+ $nutrisi.FS_NUTRISI_ANAK4) < 1} Normal {else}  Terjadi Penurunan Badan Tidak Diinginkan   {/if} {else}   {if ($nutrisi.FS_NUTRISI1 + $nutrisi.FS_NUTRISI2) < 2}  Normal {else} Terjadi Penurunan Badan Tidak Diinginkan {/if} {/if} --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pemeriksaan Fisik (O)</label>
                                            <textarea name="pemeriksaan_fisik" style="height: 70px;" class="form-control  @error('pemeriksaan_fisik') is-invalid  
                                            @enderror"  rows="5" cols="50" placeholder="Masukan ...">Suhu : {{$vitalSign->FS_SUHU ?? ''}} C, Nadi : {{$vitalSign->FS_NADI ?? ''}} x/menit, Respirasi : {{$vitalSign->FS_R ?? ''}} x/menit, TD {{$vitalSign->FS_TD ?? ''}} : mmHg, BB : Kg, TB : {{$vitalSign->FS_TB ?? ''}}  cm, Alergi : , Skala Nyeri : {{$skalaNyeri->FS_NYERIS ?? ''}} ,Skrining Nutrisi : 

                                        </textarea>
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
                                            <textarea name="tindakan" style="height: 70px;" class="form-control  @error('tindakan') is-invalid  
                                            @enderror"  rows="5" cols="50" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('tindakan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosa (A)</label>
                                            <textarea name="diagnosa" style="height: 70px;" class="form-control  @error('diagnosa') is-invalid  
                                            @enderror"  rows="5" cols="50" placeholder="Masukan ..."></textarea>
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
                                            <textarea name="hasil_usg" style="height: 70px;" class="form-control  @error('hasil_usg') is-invalid  
                                            @enderror"  rows="5" cols="50" placeholder="Masukan ..."></textarea>
                                        </div>
                                        @error('hasil_usg')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosa Sekunder <code>*</code></label>
                                            <textarea name="diagnosa_sekunder" style="height: 70px;" class="form-control  @error('diagnosa_sekunder') is-invalid  
                                                @enderror"  rows="5" cols="50" placeholder="Masukan ..."></textarea>
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
                                                @foreach ($masterLab as $lab)
                                                <option value="{{$lab->No_Jenis}}">{{$lab->Jenis}}</option>
                                                @endforeach
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
                                                <select name="periksa_radiologi[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Periksa Radiologi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    <option value="" disabled>-- Pilih Periksa Radiologi --</option>
                                                    @foreach ($masterRadiologi as $radiologi)
                                                    <option value="{{$radiologi->No_Rinci}}">{{$radiologi->Ket_Tindakan}}</option>
                                                    @endforeach
                                                </select>
                                                @error('periksa_radiologi')
                                                <span class="text-danger" style="font-size: 12px;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Bagian</label>
                                                <select name=" bagian" class="form-control" data-placeholder="Pilih Periksa Radiologi" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                    <option value="" selected>-- Pilih Bagian --</option>
                                                    <option value="Sinistra" >Sinistra</option>
                                                    <option value="Dextra" >Dextra</option>
                                                    <option value="Bilateral" >Bilateral</option>
                                                </select>
                                                @error('bagian')
                                                <span class="text-danger" style="font-size: 12px;">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>

                                        </div>
                              
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>EKG</label>
                                            <select name="ekg" id="" class="form-control select2 @error('ekg')  is-invalid @enderror">
                                                <option value="" selected disabled>--Pilih ekg--</option>
                                                <option value="Ya" @if(old('ekg')=='Ya' ) selected @endif>Ya</option>
                                                <option value="Tidak" @if(old('ekg')=='Tidak' ) selected @endif>Tidak</option>
                                            </select>
                                            @error('ekg')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pilih Paket Obat</label>
                                            <select name="paket_obat" id="" class="form-control select2 @error('paket_obat')  is-invalid @enderror">
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
                                        <div class="card-header card-success">
                                            <h4 class="card-title">Terapi</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nama Obat</label>
                                            <select name="nama_obat" id="namaobat" class="form-control select2 @error('nama_obat')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                @foreach ($masterObat as $obat)
                                                <option value="{{$obat->Nama_Obat}}">{{$obat->Nama_Obat}}</option>
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
                                            <textarea  rows="7" cols="50" style="height: 180px;" class="form-control resep" id="terapi"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header card-success">
                                            <h4 class="card-title">Resep Racikan</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="Namaobat">Nama Obat</label>
                                            <select name="nama_obat" id="namaobat2" class="form-control select2 @error('nama_obat')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                @foreach ($masterObat as $obat)
                                                <option value="{{$obat->Nama_Obat}}">{{$obat->Nama_Obat}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="numero2">Numero</label>
                                                <input type="text" class="form-control numero2" onkeypress="handleResepRacik(event)">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="mf">m.f</label>
                                                <input type="text" class="form-control mf2" onkeypress="handleResepRacik(event)">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="signa2">Signa</label>
                                                <input type="text" class="form-control dosis2" onkeypress="handleResepRacikFull(event)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="resepRacikan">Resep Racikan</label>
                                            <textarea class="form-control resepracik" style="height: 180px;"   rows="5" cols="50"></textarea>
                                        </div>
                                    </div>               
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kondisi Pulang</label>
                                            <select name="cara_pulang" id="" class="form-control select2 @error('cara_pulang')  is-invalid @enderror" onchange="click_kondisi_pulang(this)">
                                                <option value="" selected disabled>--Pilih Cara Pulang--</option>
                                                <option value="0" @if(old('cara_pulang')=='0' ) selected @endif>Tidak Kontrol</option>
                                                <option value="2" @if(old('cara_pulang')=='2' ) selected @endif>Kontrol</option>
                                                <option value="3" @if(old('cara_pulang')=='3' ) selected @endif>Rawat Inap</option>
                                                <option value="4" @if(old('cara_pulang')=='4' ) selected @endif>Rawat Luar RS</option>
                                                <option value="6" @if(old('cara_pulang')=='6' ) selected @endif>Rawat Internal</option>
                                                <option value="7" @if(old('cara_pulang')=='7' ) selected @endif>Kembali Ke Faskes Primer</option>
                                                <option value="8" @if(old('cara_pulang')=='8' ) selected @endif>PRB</option>
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

                        {{-- surat menyurat  --}}
                        <div class="card card-secondary" id="form2" style="display: none">
                            <div class="card-header card-success">
                                <h4 class="card-title">Surat Keterangan Dalam Perawatan</h4>
                            </div>
                            <!-- include form -->
                            <div class="card-body">
                                <!-- <div class="row"> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Belum dapat dikembalikan ke Fasilitas Perujuk dengan alasan</label>
                                        <div class="input-group mb-3">
                                            <select name="FS_SKDP_1" id="FS_SKDP_1" class="form-control" onchange="click_alasan_skdp(this)">
                                                <option value="">-- pilih --</option>
                                       
                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya :</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_SKDP_2" id="rencana_skdp" class="form-control">
                                            <option value="1">--Pilih Rencana Tindakan--</option>
                                        </select>
                                        <input type="text" name="FS_SKDP_KET" placeholder="keterangan.." />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Rencana Kontrol Berikutnya : </label>
                                    <div class="input-group mb-3">
                                        <select name="FS_RENCANA_KONTROL" id="FS_RENCANA_KONTROL" class="form-control" onchange="click_rencana_kontrol(this)">
                                            <option value="">-- pilih --</option>
                                            <option value="1 Minggu">1 Minggu</option>
                                            <option value="2 Minggu">2 Minggu</option>
                                            <option value="Sebulan Kedepan">Sebulan Kedepan</option>
                
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                        <label>contoh </label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="kontrol"  class="form-control" id="kontrol_rencana">
                                        </div>
                                    </div> -->
                                <div class="col-md-6">
                                    <label>Tanggal Kontrol Berikutnya : </label>
                                    <div class="input-group mb-3">
                                        <input type="date" name="FS_SKDP_KONTROL" class="form-control" id="tgl_kontrol_berikutnya">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Tanggal Expired Rujukan Faskes : </label>
                                    <div class="input-group mb-3">
                                        <input type="date" name="FS_SKDP_FASKES" id="FS_SKDP_FASKES"  @if (($asesmenPerawat != null)) @if ($asesmenPerawat->fs_skdp_faskes !='1900-01-01') value="{{$asesmenPerawat->fs_skdp_faskes}}" @endif @endif class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Keterangan Atau Pesan : </label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" rows="3" name="FS_PESAN"  placeholder="Masukan ..."></textarea>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!-- include form -->
                        </div>

                        {{-- surat rujuk luar rs --}}
                        <div class="card card-secondary" id="form3" style="display: none">
                            <div class="card-header card-success">
                                <h4 class="card-title">SURAT RUJUKAN LUAR RS</h4>
                            </div>
                            <!-- include form -->
                            <div class="card-body">
                                <!-- <div class="row"> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FS_TUJUAN_RUJUKAN_LUAR_RS">Kepada : <code>* Wajib Diisi</code></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="FS_TUJUAN_RUJUKAN_LUAR_RS" id="FS_TUJUAN_RUJUKAN_LUAR_RS">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="FS_TUJUAN_RUJUKAN_LUAR_RS2">Rumah Sakit Tujuan : <code>* Wajib Diisi</code></label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="FS_TUJUAN_RUJUKAN_LUAR_RS2" id="FS_TUJUAN_RUJUKAN_LUAR_RS2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="FS_ALASAN_RUJUK_LUAR_RS">Alasan Dirujuk : <code>* Wajib Diisi</code></label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" rows="3" name="FS_ALASAN_RUJUK_LUAR_RS" id="FS_ALASAN_RUJUK_LUAR_RS" value="" placeholder="Masukan ..."></textarea>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!-- include form -->
                        </div>

                        {{-- surat  rujuk internal --}}
                        <div class="card card-secondary" id="form4" style="display: none">
                            <div class="card-header card-success">
                                <h4 class="card-title">SURAT RUJUKAN INTERNAL</h4>
                            </div>
                            <!-- include form -->
                            <div class="card-body">
                                <!-- <div class="row"> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FS_TUJUAN_RUJUKAN">Kepada : <code>* Wajib Diisi</code></label>
                                        <div class="input-group mb-3">
                                            <select name="FS_TUJUAN_RUJUKAN" id="FS_TUJUAN_RUJUKAN" class="form-control select2bs4">
                                                <option value="">-- pilih dokter --</option>
                                    
                                            </select>
                                            <input type="hidden" name="FS_TUJUAN_RUJUKAN2" size="55" value="RSU Muhammadiyah Metro" />
                                        </div>
                                    </div>
                                </div>
                
                                <div class="col-md-6">
                                    <label for="FS_ALASAN_RUJUK">Alasan Dirujuk : <code>* Wajib Diisi</code></label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" rows="3" name="FS_ALASAN_RUJUK" id="FS_ALASAN_RUJUK" value="" placeholder="Masukan ..."></textarea>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!-- include form -->
                        </div>

                        {{-- SURAT DIKEMBALIKAN KE FASKER PRIMER --}}
                        <div class="card card-secondary" id="form5" style="display: none">
                            <div class="card-header card-success">
                                <h4 class="card-title">SURAT DIKEMBALIKAN KE FASKER PRIMER</h4>
                            </div>
                            <!-- include form -->
                            <div class="card-body">
                                <!-- <div class="row"> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="FS_TGL_PRB">Kontrol setelah dari FKTP ke RS tanggal : <code>* Wajib Diisi</code></label>
                                        <div class="input-group mb-3">
                                            <input type="hidden" name="FS_KD_TRS" />
                                            <input type="date" name="FS_TGL_PRB" class="form-control" id="FS_TGL_PRB">
                                            <input type="hidden" name="FS_TUJUAN" value="-" />
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                            </div>
                            <!-- include form -->
                        </div>

                        <div class="card-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 style="text-align: center">History Kunjungan</h4>
                            <h5 style="text-align: center">* untuk melihat history kunjungan pilih tanggal di bawah ini</h5>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header card-success">
                                    <h4 class="card-title">History Pemeriksaan Pasien</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Tanggal Kunjungan</th>
                                            <th scope="col">Dokter</th>
                                            <th scope="col">Layanan</th>
                                            <th scope="col">Catatan</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $dokterModel = new App\Models\RajalDokter();
                                        @endphp
                                        @foreach ($history as $data)
                                            @php
                                                $tanggal = date('d-m-Y', strtotime($data->TANGGAL));
                                            @endphp
                                        <tr>
                                            <td>{{ $tanggal; }}</td>
                                            <td>{{$data->NAMA_DOKTER}}</td>
                                            <td>{{$data->SPESIALIS}}</td>
                                            <td>
                                                @if ($dokterModel->getDataResep($data->NO_REG) == true)
                                                    <a href="{{ route('rj.dokterResep', [$data->NO_REG])  }}">Resep</a>
                                                @endif
                                                @if ($dokterModel->getDataLab($data->NO_REG) == true)
                                                    <a href="{{ route('rj.dokterLab', [$data->NO_REG])  }}">Hasil Lab</a>
                                                @endif
                                            </td>
                                           <td>
                                                @if($data->KODE_RUANG == '')
                                                    <span class="badge badge-pill badge-primary">Rawat Jalan</span>
                                                @elseif($data->KODE_RUANG != '')
                                                    <span class="badge badge-pill badge-success">Rawat Inap</span>
                                                @endif
                                            </td>
                                            <td width="20%">
                                                <a href="{{ route('rj.dokterCopy', ['noReg' => $data->NO_REG, 'noMR'=> $data->NO_MR]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Copy</a>
                                                @if($data->KODE_RUANG == '')
                                                    <a href="{{ route('rj.rmDokter', ['noReg' => $data->NO_REG, 'noMR'=> $data->NO_MR]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> RM</a>
                                                @elseif($data->KODE_RUANG != '')    
                                                    <a href="{{ route('rm.detail', ['noReg' => $data->NO_REG]) }}">Detail</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

<script type="text/javascript">
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

    $("#hasil_lab").hide();
    function tampil_hasil_lab() {

        var x = document.getElementById("hasil_lab");

        // alert(x);


        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    </script>
    
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
          function handleKeyPress(e) {
    var yhr = new XMLHttpRequest();
    var key = e.keyCode || e.which;
    if (key == 13) {
      var namaobat = $("#namaobat").val();
      var numero = $(".numero").val();
      var dosis = $(".dosis").val();
      var kolomresep = document.getElementById("kolomresep");
      var resep = $(".resep").val();

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
      //    alert(namaobat+numero+dosis);
      $("#namaobat").select2("data", null);
      $(".numero").val(null);
      $(".dosis").val(null);

      //    $("#namaobat").select2({}).focus();
      $("#namaobat").select2("open");
    }
  }

//   khusus resep racik
  function handleResepRacik(e) {
    var key = e.keyCode || e.which;
    if (key == 13) {
      var namaobat2 = $("#namaobat2").val();
      var numero2 = $(".numero2").val();
      //    var dosis2 = $(".dosis2").val();
      var resepracik = $(".resepracik").val();

      $(".resepracik").val(
        resepracik + "" + namaobat2 + "   no. " + numero2 + "\n     "
      );
      //    alert(namaobat+numero+dosis);
      $("#namaobat2").select2("data", null);
      $(".numero2").val(null);
      $(".dosis2").val(null);

      //    $("#namaobat").select2({}).focus();
      $("#namaobat2").select2("open");
    }
  }

  function handleResepRacikFull(e) {
    var key = e.keyCode || e.which;
    if (key == 13) {
      var namaobat2 = $("#namaobat2").val();
      var numero2 = $(".numero2").val();
      var dosis2 = $(".dosis2").val();
      var mf2 = $(".mf2").val();
      var resepracik = $(".resepracik").val();
      if (namaobat2 == null) {
        $(".resepracik").val(
          resepracik +
            "          " +
            mf2 +
            "\n   S  " +
            dosis2 +
            "\n ------------------------------------------------- \n \n   /R"
        );
      } else {
        $(".resepracik").val(
          resepracik +
            "    " +
            namaobat2 +
            "   no. " +
            numero2 +
            "\n" +
            "           " +
            mf2 +
            "\n    S      " +
            dosis2 +
            "\n ------------------------------------------ \n \n  /R"
        );
      } //    alert(namaobat+numero+dosis);
      $("#namaobat2").select2("data", null);
      $(".numero2").val(null);
      $(".dosis2").val(null);
      $(".mf2").val(null);

      //    $("#namaobat").select2({}).focus();
      $("#namaobat2").select2("open");
    }
  }
    </script>

@endpush