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
                                        <label>Keluhan Utama (Anamnesa) <code>*</code></label>
                                        <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid  
                                            @enderror" style="height: 70px;" rows="7" placeholder="Masukan ...">{{ $asasmen_dokter->anamnesa }}</textarea>
                                    </div>
                                    @error('anamnesa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Riwayat Penyakit Sekarang</label>
                                        <input type="text" name="RIWAYAT_SEKARANG" class="form-control" id="riwayat_sekarang" style="height: 50px;" rows="3" value="{{ $asasmen_dokter->RIWAYAT_SEKARANG }}">
                                        @error('riwayat_penyakit')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
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
                                        <label>Status Mental</label>
                                        <select name="status_mental" id="status_mental" class="form-control select2 @error('status_mental')  is-invalid @enderror">
                                            <option value="">-- Pilih Status Mental --</option>
                                            <option value="1" {{ ($asasmen_dokter->status_mental=='1') ? 'selected' : ''}}>Kooperatif</option>
                                            <option value="2" {{ ($asasmen_dokter->status_mental=='2') ? 'selected' : ''}}>Tidak Kooperatif</option>
                                            <option value="3" {{ ($asasmen_dokter->status_mental=='3') ? 'selected' : ''}}>Gelisah/Delirium/Berontak</option>
                                            <option value="4" {{ ($asasmen_dokter->status_mental=='4') ? 'selected' : ''}}>Ketidak Mampuan Dalam Mengikuti Perintah</option>
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
                                        <label>Keadaan Umum</label>
                                        <select name="keadaan_umum" id="keadaan_umum" class="form-control select2 @error('keadaan_umum')  is-invalid @enderror">
                                            <option value="">-- Pilih Status Mental --</option>
                                            <option value="1" {{ ($asasmen_dokter->keadaan_umum=='1') ? 'selected' : ''}}>Baik</option>
                                            <option value="2" {{ ($asasmen_dokter->keadaan_umum=='2') ? 'selected' : ''}}>Sedang</option>
                                            <option value="3" {{ ($asasmen_dokter->keadaan_umum=='3') ? 'selected' : ''}}>Buruk</option>
                                        </select>
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
                                        <select name="kesadaran" id="kesadaran" class="form-control select2 @error('kesadaran')  is-invalid @enderror">
                                            <option value="">-- Pilih Status Mental --</option>
                                            <option value="1" {{ ($asasmen_dokter->kesadaran=='1') ? 'selected' : ''}}>Baik</option>
                                            <option value="2" {{ ($asasmen_dokter->kesadaran=='2') ? 'selected' : ''}}>Sedang</option>
                                            <option value="3" {{ ($asasmen_dokter->kesadaran=='3') ? 'selected' : ''}}>Buruk</option>
                                        </select>
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
                                            <input type="text" value="{{ $asasmen_dokter->respirasi }}" name="respirasi" id="respirasi" placeholder="masukkan hanya angka" class="form-control @error('respirasi') is-invalid  
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
                                            <input type="text" value="{{ $asasmen_dokter->nadi }}" name="nadi" id="nadi" placeholder="masukkan hanya angka" class="form-control @error('nadi') is-invalid  
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
                                            <input type="text" name="tekanan_darah" id="td" value="{{ $asasmen_dokter->tekanan_darah }}" placeholder="masukkan hanya angka" class="form-control @error('td') is-invalid  
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
                                            <input type="text" name="suhu" id="suhu" value="{{ $asasmen_dokter->suhu }}" placeholder="masukkan hanya angka" class="form-control @error('suhu') is-invalid  
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
                                            <input type="text" name="berat_badan" id="bb" value="{{ $asasmen_dokter->berat_badan }}" placeholder="masukkan hanya angka" class="form-control @error('bb') is-invalid  
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
                                            <input type="text" name="tinggi_badan" id="tb" value="{{ $asasmen_dokter->tinggi_badan }}" placeholder="masukkan hanya angka" class="form-control @error('tb') is-invalid  
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
                            </div>
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="card">
                        <div class="card-header card-success card-khusus-header">
                            <h6 class="card-khusus-title">Pemeriksaan Fisik Mata</h6>
                        </div>
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                {{-- <div class="row">
                                    <h4 class="custom-judul my-1">Pemeriksaan Fisik Mata</h4>
                                </div> --}}
                                        <div class="row align-items-center">
                                            <div class="col-md-4 col-4 text-right text-right-mobile no-padding">
                                                <p class="no-margin">O.D</p>
                                                <p class="no-margin">Status Presen</p>
                                            </div>
                                            <div class="col-md-4 col-4 text-center no-padding my-mobile">
                                                <img src="{{ asset('img/mata.png') }}" alt="Right Eye" class="eye-image">
                                            </div>
                                            <div class="col-md-4 col-4 text-left text-left-mobile no-padding">
                                                <p class="no-margin">OS</p>
                                                <p class="no-margin">Kedudukan / Gerak Bola Mata</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Visus</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="VISUS_OD" class="mr-2 mt-2">
                                                                OD
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kanan" value="{{ $asasmen_dokter->VISUS_OD }}" class="form-control" name="VISUS_OD">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="VISUS_OS" class="mr-2 mt-2">
                                                                OS
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kiri" value="{{ $asasmen_dokter->VISUS_OS }}" class="form-control" name="VISUS_OS">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tonometri</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="NCT_TOD" class="mr-2 mt-2">
                                                                TOD
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kanan" value="{{ $asasmen_dokter->NCT_TOD }}" class="form-control" name="NCT_TOD" id="NCT_TOD">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="NCT_TOS" class="mr-2 mt-2">
                                                                TOS
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kiri" value="{{ $asasmen_dokter->NCT_TOS }}" class="form-control" name="NCT_TOS" id="NCT_TOS">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Add</label>
                                                <div class="col-md-12">
                                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="ADD_OD" class="mr-2 mt-2">
                                                                OD
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kanan" value="{{ $asasmen_dokter->ADD_OD }}" class="form-control" name="ADD_OD">
                                                        </div>
                                                        <div class="input-group" style="margin-right: 10px;">
                                                            <label for="ADD_OS" class="mr-2 mt-2">
                                                                OS
                                                            </label>
                                                            <input type="text" placeholder="Inputan Mata Kiri" value="{{ $asasmen_dokter->ADD_OS }}" class="form-control" name="ADD_OS">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6">
                                            <label for="">Preview Mata Kiri :</label>
                                            @if(isset($MataKiri) && $MataKiri->GAMBAR)
                                                <img src="{{ asset('storage/gambar_mata/'. $MataKiri->GAMBAR) }}" width="100%" height="250" />
                                            @else
                                                <p>Gambar Tidak Ada</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Preview Mata Kanan :</label>
                                            @if(isset($MataKanan) && $MataKanan->GAMBAR)
                                                <img src="{{ asset('storage/gambar_mata/'. $MataKanan->GAMBAR) }}" width="100%" height="250" />
                                            @else
                                                <p>Gambar Tidak Ada</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="" for="">Mata Kiri:</label>
                                            <br />
                                            <canvas id="canvasMataKiri" width="400" height="300" style="border:1px solid #000;"></canvas>
                                            <br />
                                            <button id="clearCanvas" type="button">Hapus Gambar</button>
                                            <input type="hidden" name="id_kiri" value="{{ $MataKiri->id ?? '' }}" />
                                            <textarea id="signatureData" name="signed_kiri" style="display: none"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="" for="">Mata Kanan:</label>
                                            <br />
                                            <canvas id="canvasMataKanan" width="400" height="300" style="border:1px solid #000;"></canvas>
                                            <br />
                                            <button id="clear2" type="button">Hapus Gambar</button>
                                            <input type="hidden" name="id_kanan" value="{{ $MataKanan->id ?? '' }}" />
                                            <textarea id="signature2" name="signed_kanan" style="display: none"></textarea>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Deskripsi Kiri :</label>
                                                <textarea rows="7" cols="50" style="height: 100px;" name="DESKRIPSI_KIRI" class="form-control">{{ $MataKiri->DESKRIPSI ?? ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Deskripsi Kanan :</label>
                                                <textarea rows="7" cols="50" style="height: 100px;" name="DESKRIPSI_KANAN" class="form-control">{{ $MataKanan->DESKRIPSI ?? ''}}</textarea>
                                            </div>
                                        </div> 
                                        
                            </div>
                        </div>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Diagnosa</label>
                                        <textarea name="DIAGNOSA" class="form-control  @error('DIAGNOSA') is-invalid  
                                            @enderror" rows="3" placeholder="Masukan Diagnosa ...">{{ $asasmen_dokter->DIAGNOSA }}</textarea>
                                    </div>
                                    @error('DIAGNOSA')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Edukasi</label>
                                        <textarea name="edukasi" class="form-control  @error('edukasi') is-invalid  
                                        @enderror" rows="3" placeholder="Masukan Edukasi ...">{{ $asasmen_dokter->edukasi }}</textarea>
                                    </div>
                                    @error('edukasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @if(Auth::user()->username == '156')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Paket Obat</label>
                                        <select name="namapaketdrarfan" id="namapaketdrarfan" class="form-control namapaketdrarfan @error('cara_pulang')  is-invalid @enderror" onchange="click_kondisi_pulang(this)">
                                            <option value="">--Pilih Paket Obat--</option>
                                            <option value="Post Phaco 1 Hari">Post Phaco 1 Hari</option>
                                            <option value="Post Phaco 1 Minggu">Post Phaco 1 Minggu</option>
                                            <option value="Resep Kacamata">Resep Kacamata</option>
                                        </select>
                                        @error('cara_pulang')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                @if(Auth::user()->username == '148')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Paket Obat</label>
                                        <select name="namapaketdrsuner" id="namapaketdrsuner" class="form-control namapaketdrsuner @error('cara_pulang')  is-invalid @enderror" onchange="click_kondisi_pulang(this)">
                                            <option value="">--Pilih Paket Obat--</option>
                                            <option value="Pre op Phaco">Pre op Phaco</option>
                                            <option value="Glaucoma">Glaucoma</option>
                                            <option value="Post Phaco 1 Hari">Post Phaco 1 Hari</option>
                                            <option value="Post Phaco 1 Minggu">Post Phaco 1 Minggu</option>
                                            <option value="Resep Kacamata">Resep Kacamata</option>
                                            <option value="Post Insisi Chalazion">Post Insisi Chalazion</option>
                                            <option value="Post op pteregium 1 hari">Post op pteregium 1 hari</option>
                                            <option value="Post op pteregium 1 minggu">Post op pteregium 1 minggu</option>
                                        </select>
                                        @error('cara_pulang')
                                        <span class="text-danger" style="font-size: 12px;">
                                            {{ $message }}
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="d-block">Kondisi Pulang</label>
                                        <select name="FS_CARA_PULANG" id="kondisi" class="form-control select2 @error('cara_pulang')  is-invalid @enderror" onchange="click_kondisi_pulang(this)">
                                            <option value="" selected disabled>--Pilih Cara Pulang--</option>
                                            <option value="0" {{ ($asasmen_dokter->FS_CARA_PULANG=='0') ? 'selected' : ''}}>Tidak Kontrol</option>
                                            <option value="2" {{ ($asasmen_dokter->FS_CARA_PULANG=='2') ? 'selected' : ''}}>Kontrol</option>
                                            <option value="3" {{ ($asasmen_dokter->FS_CARA_PULANG=='3') ? 'selected' : ''}}>Rawat Inap</option>
                                            <option value="4" {{ ($asasmen_dokter->FS_CARA_PULANG=='4') ? 'selected' : ''}}>Rawat Luar RS</option>
                                            <option value="6" {{ ($asasmen_dokter->FS_CARA_PULANG=='6') ? 'selected' : ''}}>Rawat Internal</option>
                                            <option value="7" {{ ($asasmen_dokter->FS_CARA_PULANG=='7') ? 'selected' : ''}}>Kembali Ke Faskes Primer</option>
                                            <option value="8" {{ ($asasmen_dokter->FS_CARA_PULANG=='8') ? 'selected' : ''}}>PRB</option>
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
    // Fungsi untuk menginisialisasi canvas
    function setupCanvas(canvasId, signatureId, imgSrc) {
       const canvas = document.getElementById(canvasId); // ID Gambar Retina
       const ctx = canvas.getContext('2d'); // CTX = (Context) digunakan untuk menggambar 2 dimensi
       const signatureData = document.getElementById(signatureId); // ID Gambar coretan

       
       // Tambahkan gambar ke canvas
       const img = new Image();
       img.src = imgSrc; // Ganti dengan path gambar mata yang sesuai
       img.onload = function() {
           ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
       }; //Letak Gambar Mata

       // Variabel untuk menggambar
       let drawing = false;

       // Event listeners untuk menggambar
       canvas.addEventListener('mousedown', () => {
           drawing = true;
           ctx.beginPath();
       });

       canvas.addEventListener('mouseup', () => {
           drawing = false;
           ctx.closePath();
           // Simpan data coretan ke textarea hanya saat mouse dilepaskan
           signatureData.value = canvas.toDataURL();
       });

       canvas.addEventListener('mousemove', (event) => {
           if (drawing) {
               ctx.lineWidth = 1;
               ctx.lineCap = 'round';
               ctx.strokeStyle = 'red'; // Warna coretan
               ctx.lineTo(event.offsetX, event.offsetY);
               ctx.stroke();
           }
       });

       return { ctx, img, signatureData };
   }

   // Setup canvas untuk Mata Kiri dan Mata Kanan
   const mataKiri = setupCanvas('canvasMataKiri', 'signatureData', '{{ asset('img/retinaa.png') }}');
   const mataKanan = setupCanvas('canvasMataKanan', 'signature2', '{{ asset('img/retinaa.png') }}');

   // Event listener untuk tombol clear untuk Mata Kiri
   document.getElementById('clearCanvas').addEventListener('click', () => {
       mataKiri.ctx.clearRect(0, 0, mataKiri.ctx.canvas.width, mataKiri.ctx.canvas.height);
       mataKiri.ctx.drawImage(mataKiri.img, 0, 0, mataKiri.ctx.canvas.width, mataKiri.ctx.canvas.height); // Gambar ulang mata
       mataKiri.signatureData.value = ''; // Kosongkan data coretan tanpa menyimpan
   });

   // Event listener untuk tombol clear untuk Mata Kanan
   document.getElementById('clear2').addEventListener('click', () => {
       mataKanan.ctx.clearRect(0, 0, mataKanan.ctx.canvas.width, mataKanan.ctx.canvas.height);
       mataKanan.ctx.drawImage(mataKanan.img, 0, 0, mataKanan.ctx.canvas.width, mataKanan.ctx.canvas.height); // Gambar ulang mata
       mataKanan.signatureData.value = ''; // Kosongkan data coretan tanpa menyimpan
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
          "\n /R  Ciprofloxacin 500mg No VI \n  S 2dd1 tablet  \n ---------------------------------------- \n \n /R  Natrium Diclofenak 25mg No VI \n  S 2dd1 tablet  \n ---------------------------------------- \n \n /R  Levofloxacin ed No 1 \n  S 6 ddgtt 1 \n ---------------------------------------- \n \n /R  P.pred ed No V \n  S 6 ddgtt 1 \n ---------------------------------------- \n"
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