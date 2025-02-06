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

</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="">Operasi</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')

            <div class="row mt5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4> Silahkan isi formulir di bawah ini.</h4>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->hasAnyRole(['perawat ibs', 'dokter bedah','dokter mata']))
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                @if (auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata') ? 'active' : '' }}" id="home-tab3" data-toggle="tab" href="#penandaan-operasi" role="tab" aria-controls="home" aria-selected="true">
                                            Penandaan Operasi
                                            @if(isset($penandaan))
                                            ✅
                                            @endif
                                        </a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#assesmen-pra-bedah" role="tab" aria-controls="profile" aria-selected="false">
                                            Assesmen Pra Bedah 
                                            @if(isset($assesmen))
                                            ✅
                                            @endif
                                        </a>
                                    </li>
                                @endif
                        
                                @if (auth()->user()->hasRole('perawat ibs') || auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                    <li class="nav-item">
                                        <a class="nav-link {{ auth()->user()->hasRole('perawat ibs') ? 'active' : '' }}" id="contact-tab3" data-toggle="tab" href="#laporan-operasi" role="tab" aria-controls="contact" aria-selected="false">
                                            Laporan Operasi
                                            @if(isset($laporanOperasi))
                                            ✅
                                            @endif
                                        </a>
                                    </li>
                                @endif
                        
                                @if (auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                    <li class="nav-item">
                                        <a class="nav-link" id="pasca-bedah-tab4" data-toggle="tab" href="#pasca-bedah" role="tab" aria-controls="contact" aria-selected="false">
                                            Pasca Bedah
                                            @if(isset($pascaBedah))
                                            ✅
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            </ul>
                            @endif
                
                            @if (auth()->user()->hasAnyRole(['perawat ibs', 'dokter bedah','dokter mata']))
                            <div class="tab-content" id="myTabContent2">
                                @if (auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                {{-- Penandaan Operasi --}}
                                <div class="tab-pane fade {{ auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata') ? 'show active' : '' }}" id="penandaan-operasi" role="tabpanel" aria-labelledby="home-tab3">
                                    <form id="myForm" action="{{ isset($penandaan) ? route('operasi.penandaan.update', $penandaan->id) : route('operasi.penandaan.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if(isset($penandaan))
                                        @method('PUT')
                                        @endif
                                        <input type="hidden" name="kode_register" value="{{ $biodata->pendaftaran->No_Reg }}">
                                        <div class="card mb-3">
                                            <!-- include form -->
                                            <div class="card-body card-khusus-body mt-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Asal Ruangan</label>
                                                            <input type="text" name="asal_ruangan" value="{{ old('asal_ruangan', $biodata->asal_ruangan ?? '')}}" class="form-control @error('asal_ruangan') is-invalid @enderror">
                                                        </div>
                                                        @error('tanggal')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jenis Operasi</label>
                                                            <input type="text" name="jenis_operasi" value="{{ isset($penandaan) && $penandaan->jenis_operasi ? $penandaan->jenis_operasi : '' }}" class="form-control @error('jenis_operasi') is-invalid @enderror">
                                                        </div>
                                                        @error('jenis_operasi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    @if(isset($penandaan))
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <a href="#" data-toggle="modal" data-target="#gambarModal{{ $penandaan->id }}" class="badge badge-success">Preview Gambar Sebelumnya</a>
                                                            {{-- {{ dd(asset('storage/operasi/' . $penandaan['hasil_gambar'])) }} --}}
                                                            {{-- <img src="{{ asset('storage/operasi/'. $penandaan->hasil_gambar) }}" width="100%" height="250" /> --}}
                                                        </div>
                                                        @error('jenis_operasi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- Gambar Operasi --}}
                                            <div class="card" id="{{ $biodata->pendaftaran->registerPasien->JENIS_KELAMIN == 'L' ? 'formPria' : 'formWanita' }}" data-gender="{{ $biodata->pendaftaran->registerPasien->JENIS_KELAMIN }}">
                                                <div class="card-body card-khusus-body">
                                                    <div class="col-md-12">
                                                        <div>
                                                            <canvas id="drawingCanvas" width="1000" height="600" style="border:1px solid #000; width:100%; height:auto;"></canvas>
                                                            <br />
                                                            <button id="undoButton" type="button" class="btn btn-sm btn-primary"><i class="fas fa-undo"></i> Undo</button>
                                                            <button id="clearCanvasButton" type="button" class="btn btn-sm btn-primary"><i class="fas fa-trash"></i> Hapus</button>
                                                            {{-- <button id="drawButton" type="button" class="btn btn-sm btn-primary">Gambar</button> --}}
                                                        </div>
                                                        <textarea id="signatureData" name="signatureData" style="display:none;"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> {{ isset($penandaan) ? 'Update' : 'Simpan' }}</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- Assesmen Pra Bedah --}}
                                <div class="tab-pane fade" id="assesmen-pra-bedah" role="tabpanel" aria-labelledby="profile-tab3">
                                    <form action="{{ isset($assesmen) ? route('prabedah.assesmen-prabedah.update', $assesmen->kode_register) : route('prabedah.assesmen-prabedah.store') }}" method="POST">
                                        @csrf
                                        @if(isset($assesmen))
                                        @method('PUT')
                                        @endif
                                        <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                                        <div class="card mb-3">
                                            <!-- include form -->
                                            <div class="card-body card-khusus-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Data Subjektif (Anamnesa) <code>*Wajib Diisi</code></label>
                                                            <textarea name="anamnesa" class="form-control @error('anamnesa') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('anamnesa', isset($assesmen) && $assesmen->anamnesa ? $assesmen->anamnesa : '') }}</textarea>
                                                            @error('anamnesa')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Data Objektif (Pemeriksaan Fisik) <code> *Wajib Diisi</code></label>
                                                            <textarea name="pemeriksaan_fisik" class="form-control  @error('pemeriksaan_fisik') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('pemeriksaan_fisik',isset($assesmen) && $assesmen->pemeriksaan_fisik ? $assesmen->pemeriksaan_fisik : '') }}</textarea>
                                                            @error('pemeriksaan_fisik')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Diagnosis Pra Bedah</label>
                                                            <textarea name="diagnosa" class="form-control  @error('diagnosa') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('diagnosa',isset($assesmen) && $assesmen->diagnosa ? $assesmen->diagnosa : '') }}</textarea>
                                                            @error('diagnosa')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Planning</label>
                                                            <textarea name="planning" class="form-control  @error('planning') is-invalid @enderror" rows="3" placeholder="Masukan ...">{{ old('planning',isset($assesmen) && $assesmen->planning ? $assesmen->planning : '') }}</textarea>
                                                            @error('planning')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Estimasi waktu yang dibutuhkan</label>
                                                            <div class="input-group">
                                                                <input type="text" name="estimasi_waktu" id="waktu" class="form-control @error('estimasi_waktu') is-invalid @enderror" value="{{ old('estimasi_waktu',isset($other) && $other->estimasi_waktu ? $other->estimasi_waktu : '') }}">
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <b>Jam</b>
                                                                    </div>
                                                                </div>
                                                                @error('estimasi_waktu')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Rencana Tindakan Pembedahan</label>
                                                            <input type="text" name="rencana_tindakan" class="form-control @error('rencana_tindakan') is-invalid @enderror" value="{{ old('rencana_tindakan',isset($other) && $other->rencana_tindakan ? $other->rencana_tindakan : '') }}">
                                                            @error('rencana_tindakan')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- include form -->
                                        </div>
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> {{ isset($assesmen) ? 'Update' : 'Simpan' }}</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                                @if (auth()->user()->hasRole('perawat ibs') || auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                {{-- Laporan Operasi --}}
                                <div class="tab-pane fade {{ auth()->user()->hasRole('perawat ibs') ? 'show active' : '' }}" id="laporan-operasi" role="tabpanel" aria-labelledby="contact-tab3">
                                    <form action="{{ isset($laporanOperasi) ? route('laporan.operasi.update', $laporanOperasi->kode_register) : route('laporan.operasi.store') }}" method="POST">
                                        @csrf
                                        @if(isset($laporanOperasi))
                                        @method('PUT')
                                        @endif
                                        <div class="card mb-3">
                                            <div class="card-header ">
                                                <h4>Data Operasi</h4>
                                            </div>
                                            <!-- include form -->
                                            <div class="card-body card-khusus-body">
                                                <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}" class="form-control @error('no_register') is-invalid @enderror" readonly>
                                                <input type="hidden" value="{{$bookingByRegister->dokter->Kode_Dokter}}" name="nama_operator">
                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Nama Assisten</label>
                                                    <div class="col-9">
                                                        <select name="nama_asisten[]" class="form-control @error('nama_asisten') is-invalid @enderror select2" multiple>
                                                            <option value="" disabled>--Pilih Asisten--</option>
                                                            @foreach ($asistenOperasi as $asisten)
                                                            <option value="{{$asisten->kode_dokter}}" {{in_array($asisten->kode_dokter,old('nama_asisten',$asistenArray)) ? 'selected' : ''}}>{{$asisten->nama_asisten}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nama_asisten')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Nama Perawat</label>
                                                    <div class="col-9">
                                                        <select name="nama_perawat[]" class="form-control @error('nama_perawat') is-invalid @enderror select2" multiple>
                                                            <option value="" disabled>--Pilih Perawat--</option>
                                                            @foreach ($asistenOperasi as $asisten)
                                                            <option value="{{$asisten->kode_dokter}}" {{in_array($asisten->kode_dokter,old('nama_perawat',$perawatArray)) ? 'selected' : ''}}>{{$asisten->nama_asisten}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nama_perawat')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Nama Ahli Anastesi</label>
                                                    <div class="col-9">
                                                        <select name="nama_ahli_anastesi[]" class="form-control @error('nama_ahli_anastesi') is-invalid @enderror select2" multiple>
                                                            <option value="" disabled>--Pilih Ahli Anastesi--</option>
                                                            @foreach ($spesialisAnastesi as $anastesi)
                                                            <option value="{{$anastesi->kode_dokter}}" {{in_array($anastesi->kode_dokter,old('nama_ahli_anastesi',$ahliAnastesiArray)) ? 'selected' : ''}}>{{$anastesi->nama_asisten}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nama_ahli_anastesi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Nama Perawat Anastesi</label>
                                                    <div class="col-9">
                                                        <select name="nama_anastesi[]" class="form-control @error('nama_anastesi') is-invalid @enderror select2" multiple>
                                                            <option value="" disabled>--Pilih Penata Anastesi--</option>
                                                            @foreach ($penataAnastesi as $penataAnastesi)
                                                            <option value="{{$penataAnastesi->kode_dokter}}" {{in_array($penataAnastesi->kode_dokter,old('nama_anastesi',$anastesiArray)) ? 'selected' : ''}}>{{$penataAnastesi->nama_asisten}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('nama_anastesi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Jenis Anastesi</label>
                                                    <div class="col-9">
                                                        <input type="text" name="jenis_anastesi" value="{{ old('jenis_anastesi',isset($anestesi) && $anestesi->jenis_anastesi ? $anestesi->jenis_anastesi : '') }}" class="form-control @error('jenis_anastesi') is-invalid @enderror">
                                                        @error('jenis_anastesi')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- include form -->
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-header card-khusus-header">
                                                <h6 class="card-khusus-title">Laporan Operasi</h6>
                                            </div>

                                            <!-- include form -->
                                            <div class="card-body card-khusus-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Diagnosis Pre-Operatif</label>
                                                            <textarea name="diagnosa_pre_op" class="form-control @error('diagnosa_pre_op') is-invalid @enderror" id="diagnosa_pre_op" style="height: 50px;" rows="3">{{ old('diagnosa_pre_op',isset($laporanOperasi) && $laporanOperasi->diagnosa_pre_op ? $laporanOperasi->diagnosa_pre_op : '') }}</textarea>
                                                            @error('diagnosa_pre_op')
                                                            <span class="text-danger" style="font-size: 12px;">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Diagnosis Post-Operatif</label>
                                                            <textarea name="diagnosa_post_op" class="form-control @error('diagnosa_post_op') is-invalid @enderror" id="diagnosa_post_op" style="height: 50px;" rows="3">{{ old('diagnosa_post_op',isset($laporanOperasi) && $laporanOperasi->diagnosa_post_op ? $laporanOperasi->diagnosa_post_op : '') }}</textarea>
                                                            @error('diagnosa_post_op')
                                                            <span class="text-danger" style="font-size: 12px;">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Jaringan yang dieksisi</label>
                                                            <textarea name="jaringan_dieksekusi" class="form-control @error('jaringan_dieksekusi') is-invalid @enderror" id="jaringan_dieksekusi" style="height: 50px;" rows="3">{{ old('jaringan_dieksekusi',isset($laporanOperasi) && $laporanOperasi->jaringan_dieksekusi ? $laporanOperasi->jaringan_dieksekusi : '') }}</textarea>
                                                            @error('jaringan_dieksekusi')
                                                            <span class="text-danger" style="font-size: 12px;">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Dikirim untuk pemeriksaan PA</label>
                                                            <div class="form-check">
                                                                <input class="form-check-input @error('permintaan_pa') is-invalid @enderror" type="radio" name="permintaan_pa" id="permintaan_pa1" value="1" 
                                                                {{ old('permintaan_pa', isset($laporanOperasi) ? $laporanOperasi->permintaan_pa : null) == 1 ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="permintaan_pa1">
                                                                    Ya
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input @error('permintaan_pa') is-invalid @enderror" type="radio" name="permintaan_pa" id="permintaan_pa2" value="0" 
                                                                {{ old('permintaan_pa', isset($laporanOperasi) ? $laporanOperasi->permintaan_pa : null) == 0 ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="permintaan_pa2">
                                                                    Tidak
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                    // Ambil status `use_template` dari database
                                                    $useTemplate = \App\Models\Operasi\UseTemplateLaporanOperasi::where('kode_dokter', auth()->user()->username)->first();
                                                    @endphp
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nama / Macam Operasi</label>
                                                            @if ($useTemplate && $useTemplate->use_template)
                                                            <select name="macam_operasi" id="macam_operasi" class="form-control @error('macam_operasi') is-invalid @enderror select2">
                                                                <option value="">--Pilih Macam Operasi --</option>
                                                                @foreach($templates as $template)
                                                                {{-- <option value="{{ $template->macam_operasi }}">{{ $template->macam_operasi }}</option> --}}
                                                                <option value="{{ $template->macam_operasi }}" {{ old('macam_operasi', isset($laporanOperasi) ? $laporanOperasi->macam_operasi : '') == $template->macam_operasi ? 'selected' : '' }}>
                                                                    {{ $template->macam_operasi }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            @error('macam_operasi')
                                                            <span class="text-danger" style="font-size: 12px;">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                            @else
                                                            <input type="text" name="macam_operasi" class="form-control @error('macam_operasi') is-invalid @enderror" placeholder="Masukkan Nama Operasi" value="{{ old('macam_operasi',isset($laporanOperasi) && $laporanOperasi->macam_operasi ? $laporanOperasi->macam_operasi : '') }}">
                                                            @error('macam_operasi')
                                                            <span class="text-danger" style="font-size: 12px;">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Perdarahan</label>
                                                            <input type="text" name="pendarahan" class="form-control @error('pendarahan') is-invalid @enderror" value="{{ old('pendarahan',isset($laporanOperasi) && $laporanOperasi->pendarahan ? $laporanOperasi->pendarahan : '') }}">
                                                            @error('pendarahan')
                                                            <span class="text-danger" style="font-size: 12px;">
                                                                {{ $message }}
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Tgl Operasi</label>
                                                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{old('tanggal',$bookingByRegister->tanggal)}}" readonly>
                                                            @error('tanggal')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Mulai Operasi</label>
                                                            <input type="time" name="mulai_operasi" id="mulai_operasi" class="form-control @error('mulai_operasi') is-invalid @enderror" value="{{ old('mulai_operasi',isset($laporanOperasi) && $laporanOperasi->mulai_operasi ? date('H:i', strtotime($laporanOperasi->mulai_operasi)) : '') }}">
                                                            @error('mulai_operasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Selesai Operasi</label>
                                                            <input type="time" name="selesai_operasi" id="selesai_operasi" class="form-control @error('selesai_operasi') is-invalid @enderror" value="{{ old('selesai_operasi',isset($laporanOperasi) && $laporanOperasi->selesai_operasi ? date('H:i', strtotime($laporanOperasi->selesai_operasi)) : '') }}">
                                                            @error('selesai_operasi')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Lama Operasi</label>
                                                            <div class="input-group">
                                                                <input type="text" name="lama_operasi" id="lama_operasi" value="{{ old('lama_operasi',isset($laporanOperasi) && $laporanOperasi->lama_operasi ? date('H:i', strtotime($laporanOperasi->lama_operasi)) : '') }}" class="form-control @error('lama_operasi') is-invalid @enderror" readonly>
                                                                <div class="input-group-append">
                                                                    <div class="input-group-text">
                                                                        <b>Jam</b>
                                                                    </div>
                                                                </div>
                                                                @error('lama_operasi')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Laporan Operasi</label>
                                                            <textarea name="laporan_operasi" class="form-control @error('laporan_operasi') is-invalid @enderror" id="laporan_operasi" style="height: 300px;" rows="3">{{ old('laporan_operasi',isset($laporanOperasi) && $laporanOperasi->laporan_operasi ? $laporanOperasi->laporan_operasi : '') }}</textarea>
                                                            @error('laporan_operasi')
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
                                        <div class="text-left">
                                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> {{ isset($laporanOperasi) ? 'Update' : 'Simpan' }}</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                                @if (auth()->user()->hasRole('dokter bedah') || auth()->user()->hasRole('dokter mata'))
                                {{-- Perencanaan Pasca Bedah --}}
                                <div class="tab-pane fade" id="pasca-bedah" role="tabpanel" aria-labelledby="pasca-bedah-tab4">
                                    <form action="{{ isset($pascaBedah) ? route('pascabedah.perencanaan-pascabedah.update', $pascaBedah->kode_register) : route('pascabedah.perencanaan-pascabedah.store') }}" method="POST">
                                        @csrf
                                        @if(isset($pascaBedah))
                                        @method('PUT')
                                        @endif
                                        <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                                        <div class="card mb-3">
                                            <div class="card-header card-khusus-header">
                                                <h6 class="card-khusus-title">Pasca Bedah</h6>
                                            </div>
                                            <!-- include form -->
                                            <div class="card-body card-khusus-body">
                                                {{-- masih salah bukan dari booking --}}
                                                <input type="hidden" value="{{$bookingByRegister->dokter->Kode_Dokter}}" name="nama_operator">
                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Tingkat Perawatan Medis</label>
                                                    <div class="col-9">
                                                        <select name="tingkat_perawatan" class="form-control @error('tingkat_perawatan') is-invalid @enderror selectric">
                                                            <option value="tinggi" 
                                                            {{ old('tingkat_perawatan', isset($pascaBedah) ? $pascaBedah->tingkat_perawatan : '') == 'tinggi' ? 'selected' : '' }}>
                                                            Tinggi (ICU)
                                                        </option>
                                                        <option value="sedang" 
                                                            {{ old('tingkat_perawatan', isset($pascaBedah) ? $pascaBedah->tingkat_perawatan : '') == 'sedang' ? 'selected' : '' }}>
                                                            Sedang (HCU)
                                                        </option>
                                                        <option value="rendah" 
                                                            {{ old('tingkat_perawatan', isset($pascaBedah) ? $pascaBedah->tingkat_perawatan : '') == 'rendah' ? 'selected' : '' }}>
                                                            Rendah (Ruang rawat, ODC / Pulang)
                                                        </option>
                                                        </select>
                                                        @error('tingkat_perawatan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Monitoring TD, Nadi, RR, Suhu setiap</label>
                                                    <div class="col-9">
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="monitoring_ttv_start" class="form-control @error('monitoring_ttv_start') is-invalid @enderror" value="{{ old('monitoring_ttv_start', isset($pascaBedah) && $pascaBedah->monitoring_ttv_start ? $pascaBedah->monitoring_ttv_start : '') }}">
                                                            @error('monitoring_ttv_start')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            <span class="input-group-text"><b>Sampai</b></span>
                                                            <input type="text" name="monitoring_ttv_end" class="form-control  @error('monitoring_ttv_end') is-invalid @enderror" value="{{ old('monitoring_ttv_end', isset($pascaBedah) && $pascaBedah->monitoring_ttv_end ? $pascaBedah->monitoring_ttv_end : '') }}">
                                                            @error('monitoring_ttv_end')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-3 col-form-label">Konsultasi pembari pelayanan lain</label>
                                                    <div class="col-9">
                                                        <input type="text" id="" name="konsultasi_pelayanan" class="form-control @error('konsultasi_pelayanan') is-invalid @enderror" value="{{ old('konsultasi_pelayanan',isset($pascaBedah) && $pascaBedah->konsultasi_pelayanan ? $pascaBedah->konsultasi_pelayanan : '') }}">
                                                        @error('konsultasi_pelayanan')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <label class="col-3 col-form-label">Pengobatan yang diperlukan</label>
                                                    <div class="col-9">
                                                        <textarea class="form-control @error('terapi') is-invalid @enderror" id="" name="terapi" style="height: 200px;">{{ old('terapi',isset($pascaBedah) && $pascaBedah->terapi ? $pascaBedah->terapi : '') }}</textarea>
                                                        @error('terapi')
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
                                            <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> {{ isset($pascaBedah) ? 'Update' : 'Simpan' }}</button>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>


            </div>
    </section>
</div>

@if(isset($penandaan))
<div class="modal fade" id="gambarModal{{ $penandaan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $penandaan->nama_pasien }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Hasil Gambar</p>
                <img id="gambarZoom{{ $penandaan->id }}" src="{{ asset('storage/operasi/penandaan-pasien/image/' . $penandaan->hasil_gambar) }}" class="img-fluid" alt="Gambar Pengguna" style="transition: transform 0.3s ease; cursor: zoom-in;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('js/page/tanda-operasi-image.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
    // Persist selected tab
    var selectedTab = localStorage.getItem('selectedTab') || '#spkfr2';
    $('#myTab3 a[href="' + selectedTab + '"]').tab('show');

    $('#myTab3 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr('href');
        localStorage.setItem('selectedTab', target);
        
    });

});
</script>

<script type="text/javascript">
    var sig = $("#signat").signature({
        syncField: "#signature1"
        , syncFormat: "PNG"
    });
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature1").val('');
    });

    var sig2 = $("#signat2").signature({
        syncField: "#signature2"
        , syncFormat: "PNG"
    });
    $('#clear2').click(function(e) {
        e.preventDefault();
        sig2.signature('clear');
        $("#signature2").val('');
    });

</script>
<script>
    // Menambahkan event listener pada kedua input
    document.getElementById('mulai_operasi').addEventListener('input', calculateDuration);
    document.getElementById('selesai_operasi').addEventListener('input', calculateDuration);
    const lamaOperasi = document.getElementById('lama_operasi');

    // Fungsi untuk menghitung durasi
    function calculateDuration() {
        // Ambil nilai input jam mulai dan jam selesai
        const startTime = document.getElementById('mulai_operasi').value;
        const endTime = document.getElementById('selesai_operasi').value;

        // Pastikan kedua input memiliki nilai
        if (startTime && endTime) {
            // Ubah jam menjadi format Date untuk manipulasi waktu
            const start = new Date(`1970-01-01T${startTime}:00`);
            const end = new Date(`1970-01-01T${endTime}:00`);

            // Jika jam selesai lebih kecil dari jam mulai (misalnya, jam selesai pada hari berikutnya)
            if (end < start) {
                end.setDate(end.getDate() + 1); // Tambah satu hari pada jam selesai
            }

            // Hitung durasi dalam milidetik, kemudian konversikan ke jam
            const duration = (end - start) / 1000 / 60; // konversi milidetik ke jam

            const hours = Math.floor(duration / 60);
            const minutes = duration % 60;

            // Tampilkan hasil durasi
            lamaOperasi.value = `${hours} Jam ${minutes} Menit`;
        } else {
            lamaOperasi.value = "";
        }
    }

    // Panggil fungsi perhitungan saat halaman dimuat (untuk memastikan hasil pertama)
    window.onload = calculateDuration;

</script>

<script>
    $(document).ready(function() {
        // Menangani perubahan pada dropdown
        $("#macam_operasi").change(function() {

            // Ambil nilai ID yang dipilih dari select
            var macam_operasi = $("#macam_operasi").val();

            if (macam_operasi) {
                // Lakukan AJAX request ke server untuk mendapatkan laporan_operasi
                $.ajax({
                    type: "GET"
                    , url: "{{ route('operasi.template.macam-operasi') }}"
                    , data: {
                        macam_operasi: macam_operasi
                    }
                    , success: function(data) {
                        // alert(data.data.laporan_operasi);

                        var laporanOperasi = data.data.laporan_operasi
                        // Hapus tag HTML menggunakan regex
                        laporanOperasi = laporanOperasi.replace(/<\/?[^>]+(>|$)/g, "\n"); // Menghapus tag HTML

                        // Ganti &nbsp; dengan spasi biasa
                        laporanOperasi = laporanOperasi.replace(/&nbsp;/g, " ");

                        // Hapus baris kosong ekstra (newline berturut-turut)
                        laporanOperasi = laporanOperasi.replace(/(\r\n|\r|\n){2,}/g, "\n");

                        // Hapus whitespace di awal dan akhir teks
                        laporanOperasi = laporanOperasi.trim();

                        // Set teks baru ke dalam textarea
                        $("#laporan_operasi").val(laporanOperasi);

                        // Reset dropdown
                        $(this).val(null).trigger('change');
                    },

                    error: function(xhr, status, error) {
                        // Tangani kesalahan, misalnya tampilkan pesan error
                        console.error("Error:", error);
                        alert("Terjadi kesalahan saat mengambil data.");
                    }
                });
            }
        });
    });

</script>
@endpush
