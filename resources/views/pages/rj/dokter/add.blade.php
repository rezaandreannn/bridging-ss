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
            <div class="row">
                <div class="col-12">
                    {{-- @include('components.biodata-pasien-fisio-bymr') --}}
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
                                            <textarea name="anamnesa" style="height: 70px;" class="form-control  @error('anamnesa') is-invalid  
                                            @enderror" rows="5" cols="50"  placeholder="Masukan ..."></textarea>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pemeriksaan Fisik (O)</label>
                                            <textarea name="pemeriksaan_fisik" style="height: 70px;" class="form-control  @error('pemeriksaan_fisik') is-invalid  
                                            @enderror"  rows="5" cols="50" placeholder="Masukan ..."></textarea>
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
                                    <div class="col-md-6">
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
                                    <div class="col-md-12">
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
                                            <select name="EKG" id="" class="form-control select2" @error('EKG')  is-invalid @enderror">
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
                                            <select name="nama_obat" id="" class="form-control select2 @error('nama_obat')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <option value="Paracetamol" @if(old('Paracetamol')=='Paracetamol' ) selected @endif>Paracetamol</option>
                                                <option value="Kontrol" @if(old('cara_pulang')=='Kontrol' ) selected @endif>Kontrol</option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="numero">Numero</label>
                                                <input type="text" class="form-control" id="numero">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="signa">Signa</label>
                                                <input type="text" class="form-control" id="signa">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="terapi">Terapi</label>
                                            <textarea  rows="7" cols="50" style="height: 180px;" class="form-control" id="terapi"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-header card-success">
                                            <h4 class="card-title">Resep Racikan</h4>
                                        </div>
                                        <div class="form-group">
                                            <label for="Namaobat">Nama Obat</label>
                                            <select name="nama_obat" id="" class="form-control select2"  @error('nama_obat')  is-invalid @enderror">
                                                <option value="" selected disabled>-- Pilih --</option>
                                                <option value="Paracetamol" @if(old('Paracetamol')=='Paracetamol' ) selected @endif>Paracetamol</option>
                                                <option value="Kontrol" @if(old('cara_pulang')=='Kontrol' ) selected @endif>Kontrol</option>
                                            </select>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="numero2">Numero</label>
                                                <input type="text" class="form-control" id="numero2">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="mf">m.f</label>
                                                <input type="text" class="form-control" id="mf">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="signa2">Signa</label>
                                                <input type="text" class="form-control" id="signa2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="resepRacikan">Resep Racikan</label>
                                            <textarea class="form-control" style="height: 180px;" id="resepRacikan"  rows="5" cols="50"></textarea>
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
                                        <input type="date" name="FS_SKDP_FASKES" id="FS_SKDP_FASKES" class="form-control" >
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
                                                    <a href="{{ route('ri.dokterBerkas', ['noReg' => $data->NO_REG]) }}">Detail</a>
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

    </script>

@endpush