@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
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
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('layanan.assesmenPerawat') }}">Layanan IGD</a></div>
                <div class="breadcrumb-item">Triase</div>
            </div>
        </div>

        <div class="section-body">

            <div class="card card-primary">
              
                    <div class="card-body card-khusus-body">
                        <div class="section-title">Pasien Sudah Mendaftar</div>
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-check pl-5">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Sudah" id="rencana_tindakan1" onclick="click_kondisi_pulang(this)">
                                        <label class="form-check-label" for="rencana_tindakan1">
                                            Sudah
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Belum" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Belum
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-khusus-body">
                            <div class="row">
                                <div class="col-md-12" id="form1" style="display: none">
                                    <div class="form-group">
                                        <div class=" col-md-6">
                                            <label>Pilih Pasien</label>
                                            <select name="pasien" id="" class="form-control select2">
                                                <option value="">pilih pasien</option>
                                                @foreach ($pasiens as $pasien)
                                                    
                                                <option value="{{$pasien->No_Reg}}">{{$pasien->Nama_Pasien}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="form2" style="display: none">
                                    <div class="form-group">
                                        <div class=" col-md-6">
                                            <label>Nama Pasien</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12" id="form3" style="display: none">
                                    <div class="form-group">
                                        <div class=" col-md-6">
                                            <label>Alamat</label>
                                            <input type="text" name="" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>

            <div class="card card-primary">
                <div class="card-header card-success card-khusus-header">
                    <h6 class="card-khusus-title">Kontak Awal Dengan Pasien</h6>
                </div>
                <div class="card-body card-khusus-body">
                    <form action="{{ route('asesmenStore.dokterNew') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal dan jam </label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid  
                                        @enderror" value="{{ date('Y-m-d')}}">
                                            @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class=" col-md-6">
                                            <input type="time" name="jam" class="form-control" value="{{date('H:i:s')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Cara Masuk</label>
                                    <div class="row">
                                        <div class="form-check pl-5">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Jalan" id="rencana_tindakan1" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan1">
                                                Jalan
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Brandkar" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Brandkar
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Kursi Roda" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Kursi Roda
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Digendong" id="rencana_tindakan2" onclick="click_kondisi_pulang(this)">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Digendong
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                        <label for="">Sudah Terpasang</label>
                                        <input type="text" class="form-control">
                                </div>
                            </div>

                      

                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Alasan Kedatangan</label>
                                    <div class="row">
                                        <div class="form-check pl-5">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Datang Sendiri" id="rencana_tindakan1">
                                            <label class="form-check-label" for="rencana_tindakan1">
                                                Datang Sendiri
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Polisi" id="rencana_tindakan2">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Polisi
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Rujukan" id="rencana_tindakan2">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Rujukan
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Dijemput" id="rencana_tindakan2">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Dijemput
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kendaraan</label>
                                    <div class="row">
                                        <div class="form-check pl-5">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Ambulance" id="rencana_tindakan1">
                                            <label class="form-check-label" for="rencana_tindakan1">
                                                Ambulance
                                            </label>
                                        </div>
                                        <div class="form-check pl-4">
                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Lainnya" id="rencana_tindakan2">
                                            <label class="form-check-label" for="rencana_tindakan2">
                                                Lainnya
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                 

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kendaaraan Lainnya</label>
                                     <input type="text" name="rencana_tindakan" class="form-control" value="" id="rencana_tindakan2">
                                </div>
                            </div>
                            <div class="card-header card-success">
                                <h4 class="card-title">Identitas Pengantar</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nama</label>
                                            <input type="text" name="tanggal" class="form-control @error('tanggal') is-invalid  
                                            @enderror" >
                                            @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class=" col-md-6">
                                            <label>No Telpon</label>
                                            <input type="text" name="jam" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header card-success">
                                <h4 class="card-title">Mekanisme Trauma</h4>
                            </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-check pl-5">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="KLL Tunggal" id="rencana_tindakan1">
                                        <label class="form-check-label" for="rencana_tindakan1">
                                            KLL Tunggal
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="KLL Ganda" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            KLL Ganda
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Jatuh dari ketinggian" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Jatuh dari ketinggian
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Luka Bakar" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Luka Bakar
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Trauma listrik" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Trauma listrik
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Trauma zat kimia" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Trauma zat kimia
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Lainnya" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="card-header card-success">
                            <h4 class="card-title">Keluhan Utama</h4>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        
                        <div class="card-header card-success">
                            <h4 class="card-title">LEVEL TRIAGE (PATIENT'S ACUITY CATEGORIZATION SCALE / PACS</h4>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-check col-md-3 pl-5">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="PACS 1" id="rencana_tindakan1">
                                        <label class="form-check-label" for="rencana_tindakan1">
                                            PACS 1
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="PACS 2" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            PACS 2
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="PACS 3" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            PACS 3
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="PACS 4" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            PACS 4
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-header card-success">
                            <h4 class="card-title">Vital Sign</h4>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Kesadaran</label>
                                <div class="row">
                                    <div class="form-check pl-5">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Sadar Penuh" id="rencana_tindakan1">
                                        <label class="form-check-label" for="rencana_tindakan1">
                                            Sadar Penuh
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Respon Suara" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Respon Suara
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Respon Nyeri" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Respon Nyeri
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Respon Suara" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Respon Suara
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tekanan Darah</label>
                                <div class="input-group">
                                    <input type="text" name="tekanan_darah" class="form-control @error('tekanan_darah') is-invalid  
                                    @enderror">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>mmHG</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
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
                                <label>Respirasi</label>
                                <div class="input-group">
                                    <input type="text" name="respirasi" class="form-control @error('respirasi') is-invalid  
                                    @enderror">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>x/menit</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
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
                                <label>Saturasi O2</label>
                                <div class="input-group">
                                    <input type="text" name="Saturasi O2" class="form-control @error('Saturasi O2') is-invalid  
                                    @enderror">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>x/menit</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
                                        </div>
                                    </div>
                                    @error('Saturasi O2')
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
                                    @enderror" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>x/menit</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
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
                                <label>Suhu</label>
                                <div class="input-group">
                                    <input type="text" name="suhu" class="form-control @error('suhu') is-invalid  
                                    @enderror" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>C</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
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
                                <label>Tinggi Badan</label>
                                <div class="input-group">
                                    <input type="text" name="berat_badan" class="form-control @error('berat_badan') is-invalid  
                                    @enderror" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>Cm</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
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
                                <label>Berat Badan</label>
                                <div class="input-group">
                                    <input type="text" name="berat_badan" class="form-control @error('berat_badan') is-invalid  
                                    @enderror" >
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>Kg</b>
                                        </div>
                                    </div>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <b>10</b>
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
                                <label>Total Skor</label>
                                <div class="input-group">
                                    <input type="text" name="berat_badan" readonly class="form-control @error('berat_badan') is-invalid  
                                    @enderror" >
                                    @error('berat_badan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Kesimpulan</label>
                                <div class="row">
                                    <div class="form-check pl-5">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Priorotas I (>5)" id="rencana_tindakan1">
                                        <label class="form-check-label" for="rencana_tindakan1">
                                            Priorotas I (>5)
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Prioritas II (2-4)" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Prioritas II (2-4)
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Prioritas III (0-1)" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Prioritas III (0-1)
                                        </label>
                                    </div>
                                    <div class="form-check pl-4">
                                        <input class="form-check-input" type="radio" name="rencana_tindakan" value="Death on Arrived" id="rencana_tindakan2">
                                        <label class="form-check-label" for="rencana_tindakan2">
                                            Death on Arrived
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Catatan Khusus</label>
                                <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Keputusan</label>
                                <input type="time" class="form-control" name="">
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

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

<script>
    function click_kondisi_pulang(selected) {
        var checkbox1 = selected.value;

        // Hide all forms initially
        $("#form1, #form2, #form3").hide();

        // Show the relevant forms based on selected value
        if (checkbox1 === "Sudah") {
            $("#form1").show();
        } else if (checkbox1 === "Belum") {
            $("#form2, #form3").show();
        }
    }
</script>

@endpush