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
                <div class="breadcrumb-item active"><a href="{{ route('operasi.post-operasi.index') }}">Operasi</a></div>
                <div class="breadcrumb-item">Post Operasi</div>
            </div>
        </div>
        <div class="section-body">
            <!-- components biodata pasien by no reg -->
            @include('components.biodata-pasien-ok-bynoreg')
            <form action="{{ route('operasi.post-operasi.update',$biodata->kode_register) }}" method="POST">
                @csrf
                @method('put')
                {{-- Data UMUM --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Data Umum</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="kode_register" value="{{$biodata->pendaftaran->No_Reg}}">
                                <div class="form-group">
                                    <label>Diagnosis Pra Bedah</label>
                                    <textarea name="diagnosa_prabedah" class="form-control" id="diagnosa_prabedah" style="height: 50px;" rows="3">{{$postOperasi['dataUmum']->diagnosa_prabedah}}</textarea>
                                    @error('diagnosa_prabedah')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Diagnosis Pasca Bedah</label>
                                    <textarea name="diagnosa_pascabedah" class="form-control" id="diagnosa_pascabedah" style="height: 50px;" rows="3">{{$postOperasi['dataUmum']->diagnosa_prabedah}}</textarea>
                                    @error('diagnosa_pascabedah')
                                    <span class="text-danger" style="font-size: 12px;">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dokter Operator</label>
                                    <select name="dokter_operator" id="" class="form-control @error('dokter_operator') is-invalid @enderror" readonly>
                                        <option value="{{$biodata->dokter->Kode_Dokter}}" selected>{{$biodata->dokter->Nama_Dokter}}</option>
                                    </select>
                                    @error('dokter_operator')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Asisten Bedah</label>
                                    <select name="asisten_bedah[]" class="form-control @error('asisten_bedah') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Asisten--</option>
                                        @foreach ($asistenOperasi as $asisten)
                                            <option value="{{$asisten->kode_dokter}}" {{(in_array($asisten->kode_dokter,$asistenArray)) ? 'selected' : ''}}>{{$asisten->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('asisten_bedah')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jenis Operasi</label>
                                    <input type="text" name="jenis_operasi"  class="form-control @error('jenis_operasi') is-invalid @enderror" value="{{$postOperasi['dataUmum']->jenis_operasi}}">
                                    @error('jenis_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jam Operasi</label>
                                    <input type="time" name="jam_operasi" class="form-control @error('jam_operasi') is-invalid @enderror" value="{{date('H:i:s',strtotime($postOperasi['dataUmum']->jam_operasi))}}">
                                    @error('jam_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis Anestesi</label>
                                    <input type="text" name="jenis_anastesi" class="form-control @error('jenis_anastesi') is-invalid @enderror" value="{{$postOperasi['dataUmum']->jenis_anastesi}}">
                                    @error('jenis_anastesi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Dokter Anestesi</label>
                                    <select name="dokter_anastesi[]" class="form-control @error('dokter_anastesi') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Ahli Anastesi--</option>
                                        @foreach ($spesialisAnastesi as $anastesi)
                                            <option value="{{$anastesi->kode_dokter}}" {{(in_array($anastesi->kode_dokter,$ahliAnastesiArray)) ? 'selected' : ''}}>{{$anastesi->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('dokter_anestesi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Asisten Anestesi</label>
                                    <select name="asisten_anastesi[]" class="form-control @error('asisten_anastesi') is-invalid @enderror select2" multiple>
                                        <option value="" disabled>--Pilih Penata Anastesi--</option>
                                        @foreach ($penataAnastesi as $penataAnastesi)
                                            <option value="{{$penataAnastesi->kode_dokter}}" {{(in_array($penataAnastesi->kode_dokter,$anastesiArray)) ? 'selected' : ''}}>{{$penataAnastesi->nama_asisten}}</option>
                                        @endforeach
                                    </select>
                                    @error('asisten_anestesi')
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
                 {{-- Serah Terima Post Operasi --}}
                 <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Serah Terima Post Operasi</h6>
                    </div>
                    <div class="card-body card-khusus-body">
                        <div class="table-responsive">
                            <table class="table-striped table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tindakan</th>
                                        <th scope="col">Isi</th>
                                        <th scope="col">Ya</th>
                                        <th scope="col">Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Status Pasien</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status_pasien" id="status_pasien1" value="1" {{ ($postOperasi['tindakan']->status_pasien =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status_pasien1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status_pasien" id="status_pasien2" value="0" {{ ($postOperasi['tindakan']->status_pasien =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status_pasien2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Catatan Anestesi / Sedasi</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="catatan_anestesi" id="catatan_anestesi1" value="1" {{ ($postOperasi['tindakan']->catatan_anestesi =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="catatan_anestesi1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="catatan_anestesi" id="catatan_anestesi2" value="0" {{ ($postOperasi['tindakan']->catatan_anestesi =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="catatan_anestesi2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Laporan Pembedahan</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="laporan_pembedahan" id="laporan_pembedahan1" value="1" {{ ($postOperasi['tindakan']->laporan_pembedahan =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="laporan_pembedahan1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="laporan_pembedahan" id="laporan_pembedahan2" value="0" {{ ($postOperasi['tindakan']->laporan_pembedahan =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="laporan_pembedahan2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Perencanaan Medis Pasca Bedah</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="perencanaan_pasca_medis" id="perencanaan_pasca_medis1" value="1" {{ ($postOperasi['tindakan']->perencanaan_pasca_medis =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perencanaan_pasca_medis1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="perencanaan_pasca_medis" id="perencanaan_pasca_medis2" value="0" {{ ($postOperasi['tindakan']->perencanaan_pasca_medis =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="perencanaan_pasca_medis2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Cheklist Keselamatan pasien dikamar bedah</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="checklist_keselamatan_pasien" id="checklist_keselamatan_pasien1" value="1" {{ ($postOperasi['tindakan']->checklist_keselamatan_pasien =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checklist_keselamatan_pasien1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="checklist_keselamatan_pasien" id="checklist_keselamatan_pasien2" value="0" {{ ($postOperasi['tindakan']->checklist_keselamatan_pasien =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checklist_keselamatan_pasien2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Cheklist Monitoring alat/bahan/jarum kamar bedah</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="checklist_monitoring" id="checklist_monitoring1" value="1" {{ ($postOperasi['tindakan']->checklist_monitoring =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checklist_monitoring1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="checklist_monitoring" id="checklist_monitoring2" value="0" {{ ($postOperasi['tindakan']->checklist_monitoring =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checklist_monitoring2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Askep Perioperatif</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="askep_perioperatif" id="askep_perioperatif1" value="1" {{ ($postOperasi['tindakan']->askep_perioperatif =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="askep_perioperatif1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="askep_perioperatif" id="askep_perioperatif2" value="0" {{ ($postOperasi['tindakan']->askep_perioperatif =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="askep_perioperatif2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Lembar pemantauan pembedahan dengan anestesi lokal</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lembar_pemantauan" id="lembar_pemantauan1" value="1" {{ ($postOperasi['tindakan']->lembar_pemantauan =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lembar_pemantauan1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lembar_pemantauan" id="lembar_pemantauan2" value="0" {{ ($postOperasi['tindakan']->lembar_pemantauan =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lembar_pemantauan2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Formulir Pemeriksaan</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="formulir_pemeriksaan" id="formulir_pemeriksaan1" value="1" {{ ($postOperasi['tindakan']->formulir_pemeriksaan =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="formulir_pemeriksaan1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="formulir_pemeriksaan" id="formulir_pemeriksaan2" value="0" {{ ($postOperasi['tindakan']->formulir_pemeriksaan =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="formulir_pemeriksaan2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Bahan atau sampel pemeriksaan</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sampel_pemeriksaan" id="sampel_pemeriksaan1" value="1" {{ ($postOperasi['tindakan']->sampel_pemeriksaan =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="sampel_pemeriksaan1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="sampel_pemeriksaan" id="sampel_pemeriksaan2" value="0" {{ ($postOperasi['tindakan']->sampel_pemeriksaan =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="sampel_pemeriksaan2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Foto Rontgen</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="foto_rontgen" id="foto_rontgen1" value="1" {{ ($postOperasi['tindakan']->foto_rontgen =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="foto_rontgen1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="foto_rontgen" id="foto_rontgen2" value="0" {{ ($postOperasi['tindakan']->foto_rontgen =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="foto_rontgen2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Resep</td>
                                        <td></td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="resep" id="resep1" value="1" {{ ($postOperasi['tindakan']->resep =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="resep1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="resep" id="resep2" value="0" {{ ($postOperasi['tindakan']->resep =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="resep2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Lain-lain</td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="deskripsi_lainnya" class="form-control" value="{{ $postOperasi['tindakan']->deskripsi_lainnya ?? '' }}" placeholder="Lainnya...">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lainnya" id="lainnya1" value="1" {{ ($postOperasi['tindakan']->lainnya =='1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lainnya1">Ya</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="lainnya" id="lainnya2" value="0" {{ ($postOperasi['tindakan']->lainnya =='0') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="lainnya2">Tidak</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Pemeriksaan Fisik --}}
                <div class="card mb-3">
                    <div class="card-header card-khusus-header">
                        <h6 class="card-khusus-title">Pemeriksaan Fisik & Alat</h6>
                    </div>
                    <!-- include form -->
                    <div class="card-body card-khusus-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alat - Alat :</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ngt" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->ngt ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    NGT
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="drain" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->drain ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Drain
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tampon_hidung" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->tampon_hidung ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tampon Hidung
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tampon_gigi" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->tampon_gigi ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tampon Gigi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tampon_abdomen" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->tampon_abdomen ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tampon Abdomen
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="lainnya" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->lainnya ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Lain - lain
                                                </label>
                                                <input type="text" name="deskripsi_lainnya" placeholder="Deskripsi Lainnya" value="{{ $postOperasi['alat']->deskripsi_lainnya ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tampon_vagina" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->tampon_vagina ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tampon Vagina
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="tranfusi" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->tranfusi ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tranfusi
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ivfd" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->ivfd ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    IVFD
                                                </label>
                                                <input type="text" name="deskripsi_ivfd" value="{{ $postOperasi['alat']->deskripsi_ivfd ?? '' }}">tts/menit
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="kompres_luka" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->kompres_luka ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Kompres Luka
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="dc" id="flexCheckDefault" value="1" {{ $postOperasi['alat'] && $postOperasi['alat']->dc ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    DC
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keadaan Umum</label>
                                    <select name="keadaan_umum" id="" class="form-control select2 @error('keadaan_umum') is-invalid  
                                        @enderror">
                                        <option value="" disabled>-- pilih --</option>
                                        <option value="1" {{ ($postOperasi['ttv']->keadaan_umum=='1') ? 'selected' : ''}}>Baik</option>
                                        <option value="2" {{ ($postOperasi['ttv']->keadaan_umum=='2') ? 'selected' : ''}}>Sedang</option>
                                        <option value="3" {{ ($postOperasi['ttv']->keadaan_umum=='3') ? 'selected' : ''}}>Buruk</option>
                                    </select>
                                    @error('keadaan_umum')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kesadaran</label>
                                    <select name="kesadaran" id="kesadaran" class="form-control select2 @error('kesadaran') is-invalid @enderror">
                                        <option value="" disabled>-- pilih --</option>
                                        <option value="1" {{ ($postOperasi['ttv']->kesadaran=='1') ? 'selected' : ''}}>Baik</option>
                                        <option value="2" {{ ($postOperasi['ttv']->kesadaran=='2') ? 'selected' : ''}}>Sedang</option>
                                        <option value="3" {{ ($postOperasi['ttv']->kesadaran=='3') ? 'selected' : ''}}>Buruk</option>
                                    </select>
                                    @error('kesadaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>P</label>
                                    <div class="input-group">
                                        <input type="text" name="pernafasan" id="pernafasan" value="{{ $postOperasi['ttv']->pernafasan ?? '' }}" placeholder="masukkan hanya angka" class="form-control @error('pernafasan') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>x/menit</b>
                                            </div>
                                        </div>
                                        @error('pernafasan')
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
                                        <input type="text" name="nadi" id="nadi" value="{{ $postOperasi['ttv']->nadi ?? '' }}" placeholder="masukkan hanya angka" class="form-control @error('nadi') is-invalid  
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
                                    <label>Tekanan Darah</label><code> (contoh : 110/90)</code>
                                    <div class="input-group">
                                        <input type="text" name="tekanan_darah" id="tekanan_darah" value="{{ $postOperasi['ttv']->tekanan_darah ?? '' }}"  placeholder="masukkan hanya angka" class="form-control @error('tekanan_darah') is-invalid  
                                        @enderror">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <b>mmHg</b>
                                            </div>
                                        </div>
                                        @error('tekanan_darah')
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
                                        <input type="text" name="suhu" id="suhu" value="{{ $postOperasi['ttv']->suhu ?? '' }}" placeholder="masukkan hanya angka"  class="form-control @error('suhu') is-invalid  
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Instruksi dokter bedah via lisan</label>
                                    <textarea name="instruksi_dokter" class="form-control" id="instruksi_dokter" style="height: 100px;" rows="3">{{ $postOperasi['ttv']->instruksi_dokter ?? '' }}</textarea>
                                    @error('instruksi_dokter')
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
    document.getElementById('tekanan_darah').addEventListener('keypress', function(event) {
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
    document.getElementById('pernafasan').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

@endpush