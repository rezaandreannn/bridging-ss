@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
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
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Patient</a></div>
                <div class="breadcrumb-item">Edit Data</div>
            </div>
        </div>

        <div class="section-body">
            <!-- Detail Pasien -->
            @include('components.biodata-pasien-bynoreg')
            <!-- Tutup Detail Pasien -->
            <a href="{{ route('rj.resume', $biodata->NO_MR )}}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-primary mb-2"><i class="fas fa-download"></i>Profil Ringkas Medis Rawat Jalan</a>
            <button class="btn btn-sm btn-primary mb-2" data-toggle="modal" data-target="#modal-histori"><i class="fas fa-history"></i> History</button>
            <!-- form -->

            <form action="{{ route('rj.update', $asasmen_perawat->FS_KD_REG) }}" method="POST">
                @csrf
                @method('put')
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Allowanamnesa dan Pemeriksaan Fisik</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="FS_KD_REG" value="{{ $noReg }}" />
                                    <input type="hidden" name="KODE_DOKTER" value="{{ $biodata->Kode_Dokter}}" />
                                    <input type="hidden" name="NO_MR" value="{{ $biodata->NO_MR}}" />
                                    <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                    <textarea class="form-control" rows="3" name="FS_ANAMNESA" placeholder="Masukan ...">{{ $asasmen_perawat->FS_ANAMNESA }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pemeriksaan Fisik</label>
                                    <textarea class="form-control" rows="3" name="FS_EDUKASI" value="" placeholder="Masukan ...">{{ $asasmen_perawat->FS_EDUKASI }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- include form -->
                </div>
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Vital Sign</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Suhu</label>
                                    <input type="text" name="FS_SUHU" class="form-control" name="FS_SUHU" id="suhu" value="{{ $asasmen_perawat->FS_SUHU }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nadi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_NADI" id="nadi" value="{{ $asasmen_perawat->FS_NADI }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Respirasi</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_R" id="respirasi" value="{{ $asasmen_perawat->FS_R }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">x/menit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tekanan Darah</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_TD" id="tekananDarah" value="{{ $asasmen_perawat->FS_TD }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="tb" name="FS_TB" value="{{ $asasmen_perawat->FS_TB }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Berat Badan</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="bb" name="FS_BB" value="{{ $asasmen_perawat->FS_BB }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title">Asasmen Nyeri</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ada Nyeri?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NYERI" id="exampleRadios1" value="1" {{ ($asasmen_perawat->FS_NYERI=='1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Ya
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="FS_NYERI" id="exampleRadios2" value="0" {{ ($asasmen_perawat->FS_NYERI=='0') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="exampleRadios2">
                                            Tidak
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Quality</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIQ" id="" class="form-control select2">
                                            <option value="0" {{ ($asasmen_perawat->FS_NYERIQ=='0') ? 'selected' : '' }}>Tidak Ada</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_NYERIQ=='1') ? 'selected' : '' }}>Seperti Di Tusuk-Tusuk</option>
                                            <option value="2" {{ ($asasmen_perawat->FS_NYERIQ=='2') ? 'selected' : '' }}>Seperti Terbakar</option>
                                            <option value="3" {{ ($asasmen_perawat->FS_NYERIQ=='3') ? 'selected' : '' }}>Seperti Tertimpa Beban</option>
                                            <option value="4" {{ ($asasmen_perawat->FS_NYERIQ=='4') ? 'selected' : '' }}>Ngilu</option>
                                            <option value="5" {{ ($asasmen_perawat->FS_NYERIQ=='5') ? 'selected' : '' }}>Sedang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Provokatif</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIP" id="" class="form-control select2">
                                            <option value="0" {{ ($asasmen_perawat->FS_NYERIP=='0') ? 'selected' : '' }}>Tidak Ada Nyeri</option>
                                            <option value="2" {{ ($asasmen_perawat->FS_NYERIP=='2') ? 'selected' : '' }}>Biologik</option>
                                            <option value="3" {{ ($asasmen_perawat->FS_NYERIP=='3') ? 'selected' : '' }}>Kimiawi</option>
                                            <option value="4" {{ ($asasmen_perawat->FS_NYERIP=='4') ? 'selected' : '' }}>Mekanik / Rudapaksa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Severity</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIS" id="" class="form-control select2">
                                            <option value="0" {{ ($asasmen_perawat->FS_NYERIS=='0') ? 'selected' : '' }}>0</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_NYERIS=='1') ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ ($asasmen_perawat->FS_NYERIS=='2') ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ ($asasmen_perawat->FS_NYERIS=='3') ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ ($asasmen_perawat->FS_NYERIS=='4') ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ ($asasmen_perawat->FS_NYERIS=='5') ? 'selected' : '' }}>5</option>
                                            <option value="6" {{ ($asasmen_perawat->FS_NYERIS=='6') ? 'selected' : '' }}>6</option>
                                            <option value="7" {{ ($asasmen_perawat->FS_NYERIS=='7') ? 'selected' : '' }}>7</option>
                                            <option value="8" {{ ($asasmen_perawat->FS_NYERIS=='8') ? 'selected' : '' }}>8</option>
                                            <option value="9" {{ ($asasmen_perawat->FS_NYERIS=='9') ? 'selected' : '' }}>9</option>
                                            <option value="10" {{ ($asasmen_perawat->FS_NYERIS=='10') ? 'selected' : '' }}>10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Regio</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="FS_NYERIR" value="{{$asasmen_perawat->FS_NYERIR}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time</label>
                                    <div class="input-group mb-3">
                                        <select name="FS_NYERIT" id="" class="form-control select2">
                                            <option value="0" {{ ($asasmen_perawat->FS_NYERIT=='0') ? 'selected' : '' }}>Tidak Ada</option>
                                            <option value="1" {{ ($asasmen_perawat->FS_NYERIT=='1') ? 'selected' : '' }}>Kadang-Kadang</option>
                                            <option value="2" {{ ($asasmen_perawat->FS_NYERIT=='2') ? 'selected' : '' }}>Sering</option>
                                            <option value="3" {{ ($asasmen_perawat->FS_NYERIT=='3') ? 'selected' : '' }}>Menetap</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
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
                                    <select name="FS_CARA_BERJALAN1" class="form-control" onchange="click1(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0" {{ ($asasmen_perawat->FS_CARA_BERJALAN1=='0') ? 'selected' : '' }}>TIDAK</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_CARA_BERJALAN1=='1') ? 'selected' : '' }}>YA</option>
                                    </select>
                                </div>
                                <div class="form-group clearfix">
                                    <label>
                                        Pasien berjalan menggunakan alat bantu
                                    </label>
                                    <select name="FS_CARA_BERJALAN2" class="form-control" onchange="click2(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0" {{ ($asasmen_perawat->FS_CARA_BERJALAN2=='0') ? 'selected' : '' }}>TIDAK</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_CARA_BERJALAN2=='1') ? 'selected' : '' }}>YA</option>
                                    </select>

                                </div>
                                <div class="form-group clearfix">
                                    <label for="check3">
                                        Pada saat akan duduk pasien memegang benda untuk menopang
                                    </label>
                                    <select name="FS_CARA_DUDUK" class="form-control" onchange="click3(this)">
                                        <option value="">--Pilih Data--</option>
                                        <option value="0" {{ ($asasmen_perawat->FS_CARA_DUDUK=='0') ? 'selected' : '' }}>TIDAK</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_CARA_DUDUK=='1') ? 'selected' : '' }}>YA</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="hasil_check1">
                            <input type="hidden" id="hasil_check2">
                            <input type="hidden" id="hasil_check3">

                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary4" name="intervensi1" value="Ya" {{ ($asasmen_perawat->intervensi1=='Ya') ? 'checked' : '' }}>
                                        <label for="checkboxPrimary4">
                                            Edukasi
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary5" name="intervensi2" value="Ya" {{ ($asasmen_perawat->intervensi2=='Ya') ? 'checked' : '' }}>
                                        <label for="checkboxPrimary5">
                                            Pasang Stiker Resiko Jatuh (*resiko tinggi)
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                        <h4 class="card-title">Riwayat Kesehatan & Alergi</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit Dahulu</label>
                                    <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU" value="{{$biodata->FS_RIW_PENYAKIT_DAHULU!='' ? $biodata->FS_RIW_PENYAKIT_DAHULU : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Penyakit keluarga</label>
                                    <input type="text" class="form-control" name="FS_RIW_PENYAKIT_DAHULU2" value="{{$biodata->FS_RIW_PENYAKIT_DAHULU2!='' ? $biodata->FS_RIW_PENYAKIT_DAHULU2 : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Riwayat Alergi<code>*</code></label>
                                    <input type="text" class="form-control" name="FS_ALERGI" value="{{$biodata->FS_ALERGI!='' ? $biodata->FS_ALERGI : '-' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reaksi Alergi<code>*</code></label>
                                    <input type="text" class="form-control" name="FS_REAK_ALERGI" value="{{$biodata->FS_ALERGI!='' ? $biodata->FS_ALERGI : '-' }}">
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Status Psikologis, Sosial dan Fungsional </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status Psikologis</label>
                                    <select name="FS_STATUS_PSIK" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_STATUS_PSIK=='1') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true' selected>Tenang</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_STATUS_PSIK=='2') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Cemas</option>
                                        <option value="3" {{ ($asasmen_perawat->FS_STATUS_PSIK=='3') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Takut</option>
                                        <option value="4" {{ ($asasmen_perawat->FS_STATUS_PSIK=='4') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Marah</option>
                                        <option value="5" {{ ($asasmen_perawat->FS_STATUS_PSIK=='5') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = true'>Sedih</option>
                                        <option VALUE="6" {{ ($asasmen_perawat->FS_STATUS_PSIK=='6') ? 'selected' : ''}} onclick='document.getElementById("civstaton3").disabled = false'>Lainnya</option>
                                    </select>
                                    <input type="hidden" name="FS_STATUS_PSIK2" value="" id="civstaton3" size="32">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status fungssional</label>
                                    <select name="FS_ST_FUNGSIONAL" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_ST_FUNGSIONAL=='1') ? 'selected' : ''}}>Mandiri</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_ST_FUNGSIONAL=='2') ? 'selected' : ''}}>Perlu Bantuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penciuman</label>
                                    <select name="FS_PENCIUMAN" id="" class="form-control select2">
                                        <option value="">-- pilih --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_PENCIUMAN=='1') ? 'selected' : ''}}>Normal</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_PENCIUMAN=='2') ? 'selected' : ''}}>Tidak Normal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Skrining Nutrisi </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Penurunan berat badan yang tidak diinginkan selama 6 bulan terakhir</label>
                                    <select name="FS_NUTRISI1" class="form-control select2" onchange="sn1(this)">
                                        <option value="">-- pilih --</option>
                                        <option value="0" {{ ($asasmen_perawat->FS_NUTRISI1=='0') ? 'selected' : ''}}>Tidak</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_NUTRISI1=='1') ? 'selected' : ''}}>Tidak Yakin</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_NUTRISI1=='2') ? 'selected' : ''}}>Ya (1-5 Kg)</option>
                                        <option value="3" {{ ($asasmen_perawat->FS_NUTRISI1=='3') ? 'selected' : ''}}>Ya (6-10 Kg)</option>
                                        <option value="4" {{ ($asasmen_perawat->FS_NUTRISI1=='4') ? 'selected' : ''}}>Ya (11-15 Kg)</option>
                                        <option value="5" {{ ($asasmen_perawat->FS_NUTRISI1=='5') ? 'selected' : ''}}>Ya (>15 Kg)</option>
                                    </select>
                                    <input type="hidden" id="hasil_sn1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asupan makanan menurun dikarenakan adanya penurunan nafsu makan</label>
                                    <select name="FS_NUTRISI2" class="form-control select2" onchange="sn2(this)">
                                        <option value="">-- pilih --</option>
                                        <option value="0" {{ ($asasmen_perawat->FS_NUTRISI2=='0') ? 'selected' : ''}}>Tidak</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_NUTRISI2=='1') ? 'selected' : ''}}>Ya</option>
                                    </select>
                                    <input type="hidden" id="hasil_sn2">
                                </div>
                            </div>
                            <label for="kesimpulan" class="col-sm-2 col-form-label">Kesimpulan : </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="kesimpulan_skrining_nutrisi" readonly>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Spiritual dan Kultural pasien</h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agama</label>
                                    <select name="FS_AGAMA" id="" class="form-control select2">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="1" {{ ($asasmen_perawat->FS_AGAMA=='1') ? 'selected' : ''}}>Islam</option>
                                        <option value="2" {{ ($asasmen_perawat->FS_AGAMA=='2') ? 'selected' : ''}}>Kristen</option>
                                        <option value="3" {{ ($asasmen_perawat->FS_AGAMA=='3') ? 'selected' : ''}}>Katholik</option>
                                        <option value="4" {{ ($asasmen_perawat->FS_AGAMA=='4') ? 'selected' : ''}}>Hindu</option>
                                        <option value="5" {{ ($asasmen_perawat->FS_AGAMA=='5') ? 'selected' : ''}}>Budha</option>
                                        <option value="6" {{ ($asasmen_perawat->FS_AGAMA=='6') ? 'selected' : ''}}>Konghucu</option>
                                    </select>
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
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header card-success">
                        <h4 class="card-title">Keperawatan </h4>
                    </div>
                    <!-- include form -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Masalah Keperawatan</label>
                                    <select name="tujuan[]" id="masalah_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Masalah Keperawatan" style="width: 100%;">

                                        <option value="">-- pilih --</option>
                                        @forelse ($masalah_perGet as $mp)
                                        @foreach ($masalah_perawatan as $mk)
                                        <option value="{{ $mk->FS_KD_DAFTAR_DIAGNOSA }}" {{ $mk->FS_KD_DAFTAR_DIAGNOSA == $mp->FS_KD_MASALAH_KEP ? "selected" : "" }}>{{ $mk->FS_NM_DIAGNOSA }}</option>
                                        @endforeach
                                        @empty
                                        @foreach ($masalah_perawatan as $mk)
                                        <option value="{{ $mk->FS_KD_DAFTAR_DIAGNOSA }}">{{ $mk->FS_NM_DIAGNOSA }}</option>
                                        @endforeach
                                        @endforelse

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rencana Keperawatan</label>
                                    <select multiple name="tembusan[]" id="rencana_perawatan" class="form-control select2" multiple="multiple" data-placeholder="Pilih Rencana Keperawatan" style="width: 100%;">
                                        <option value="">-- pilih --</option>



                                        @forelse ($rencana_perGet as $rpp)
                                        @foreach ($rencana_perawatan as $rp)
                                        <option value="{{ $rp->FS_KD_TRS }}" {{ $rp->FS_KD_TRS == $rpp->FS_KD_REN_KEP ? 'selected' : ''}}>{{ $rp->FS_NM_REN_KEP }}</option>
                                        @endforeach
                                        @empty
                                        @foreach ($rencana_perawatan as $rp)
                                        <option value="{{ $rp->FS_KD_TRS }}">{{ $rp->FS_NM_REN_KEP }}</option>
                                        @endforeach
                                        @endforelse



                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pasien terduga TB (Kode ICD 10 bila terdiagnosa TBC)</label>
                                    <select name="kode_icd_x" id="" class="form-control select2bs4">
                                        <option value="">-- pilih --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Expired Rujukan (jika pasien BPJS)</label>
                                    <input type="date" name="FS_SKDP_FASKES" id="" class="form-control" value="{{$asasmen_perawat->FS_SKDP_FASKES}}">
                                </div>
                            </div>
                            <!-- include form -->
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="text-right">
                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                </div>
                <!-- button -->
                <!-- form -->
            </form>
    </section>
    <!-- modal histori -->
    <div class="modal fade" id="modal-histori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Histori (SUPARNO BIN SUPARJO ) - (124411)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Tgl Kunjungan</th>
                                        <th style="width: 30px">Dokter</th>
                                        <th style="width: 20px">Layanan</th>
                                        <th style="width: 20px">Catatan</th>
                                        <th style="width: 10px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

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

    function sn1(selected) {
        var value1 = selected.value
        $("#hasil_sn1").html(value1);
        score_skrining_nutrisi();
    };

    function sn2(selected) {
        var value2 = selected.value
        $("#hasil_sn2").html(value2);
        score_skrining_nutrisi();
    };
</script>

<script type="text/javascript">
    // score skrining nutrisi
    function score_skrining_nutrisi() {
        var sn = parseInt($("#hasil_sn1").text()) + parseInt($("#hasil_sn2").text());
        $("#totalsn").html(sn);
        if (sn >= 2) {
            $("#kesimpulan_skrining_nutrisi").val("LAPORKAN KE DOKTER");
        } else if (sn < 2) {
            $("#kesimpulan_skrining_nutrisi").val("NORMAL");
        }
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

<!-- Membatasi inputan huruf -->
<script>
    document.getElementById('tekananDarah').addEventListener('keypress', function(event) {
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
    document.getElementById('respirasi').addEventListener('keypress', function(event) {
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
    document.getElementById('bb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });

</script>

@endpush