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
                            <h6 class="card-khusus-title">Form Dokter Fisioterapi</h6>
                        </div>
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('asesmenStore.dokter') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Registrasi Pendaftaran </label>
                                            <input type="text" name="no_registrasi" class="form-control" value="{{$biodatas->No_Reg}}" readonly>
                                            <input type="hidden" name="NO_MR" class="form-control" value="{{$biodatas->NO_MR}}" readonly>
                                            <input type="hidden" name="kode_transaksi_fisio" class="form-control" value="{{$kode_transaksi_fisio}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea name="anamnesa" class="form-control  @error('anamnesa') is-invalid  
                                                @enderror" rows="3" placeholder="Masukan ...">@if($asesmen_perawat !=null ) {{ $asesmen_perawat->FS_ANAMNESA}}  @else {{ old('anamnesa')}} @endif</textarea>
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
                                                @enderror" @if($ttv !=null ) value="{{ $ttv->FS_TD}}" @else value="{{ old('tekanan_darah')}}" @endif>
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
                                                @enderror" @if($ttv !=null ) value="{{ $ttv->FS_NADI}}" @else value="{{ old('nadi')}}" @endif>
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
                                                @enderror" @if($ttv !=null ) value="{{ $ttv->FS_R}}" @else value="{{ old('respirasi')}}" @endif>
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
                                                @enderror" @if($ttv !=null ) value="{{ $ttv->FS_SUHU}}" @else value="{{ old('suhu')}}" @endif>
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
                                                @enderror" @if($ttv !=null ) value="{{ $ttv->FS_BB}}" @else value="{{ old('berat_badan')}}" @endif>
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
                                                @enderror" value="{{ old('prothesa')}}">
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
                                            <input type="text" name="orthosis" class="form-control @error('orthosis') is-invalid  
                                                @enderror" value="{{ old('orthosis')}}">
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
                                            <select name="diagnosa_klinis" class="form-control select2" data-placeholder="Pilih Diagnosa" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" selected disabled>-- Pilih Diagnosa --</option>
                                                @foreach ($diagnosisMedis as $item)
                                                <option value="{{$item->id}}">{{$item->nama_diagnosis_medis}}</option>
                                                @endforeach
                                            </select>
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
                                                @enderror" rows="3" name="diagnosa_klinis" value="" placeholder="Masukan ...">{{ old('diagnosa_klinis')}}</textarea>
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
                                            <select name="jenis_terapi_fisio[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jenis Fisio" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Jenis Fisio --</option>
                                                @foreach ($jenisterapifisio as $terapi)
                                                <option value="{{ $terapi->ID_JENIS_FISIO }}" @if(old('jenis_terapi_fisio')==$terapi) selected @endif>{{ $terapi->NAMA_TERAPI }}</option>
                                                @endforeach
                                            </select>
                                            @error('jenis_terapi_fisio')
                                            <span class="text-danger" style="font-size: 12px;">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rencana Tindakan</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Tidak Ada" id="rencana_tindakan1" checked>
                                                            <label class="form-check-label" for="rencana_tindakan1">
                                                                Tidak Ada
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Ya" id="rencana_tindakan2">
                                                            <label class="form-check-label" for="rencana_tindakan2">
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" name="jenis_tindakan" class="form-control @error('jenis_tindakan') is-invalid  
                                                @enderror" value="{{old('jenis_tindakan')}}" placeholder="Isi jenis tindakan jika ya">
                                                </div>
                                                @error('jenis_tindakan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Rujuk</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_rujukan" value="Tidak Ada" id="rencana_rujukan1" checked>
                                                            <label class="form-check-label" for="rencana_rujukan1">
                                                                Tidak Ada
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_rujukan" value="Ya" id="rencana_rujukan2">
                                                            <label class="form-check-label" for="rencana_rujukan2">
                                                                Ya
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="deskripsi_rujukan" class="form-control @error('deskripsi_rujukan') is-invalid  
                                                @enderror" value="{{old('deskripsi_rujukan')}}" placeholder="Rujukan Ke">
                                                </div>
                                                @error('deskripsi_rujukan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Konsul</label>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rencana_konsul" value="Tidak Ada" id="rencana_konsul1">
                                                        <label class="form-check-label" for="rencana_konsul1">
                                                            Tidak Ada
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="rencana_konsul" value="Ya" id="rencana_konsul2" checked>
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
                                                @enderror" value="{{old('deskripsi_konsul')}}" placeholder="Ke Bagian">
                                        </div>
                                        @error('deskripsi_konsul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anjuran</label>
                                            <div class="input-group">
                                                <select name="anjuran_terapi" id="" class="form-control @error('anjuran_terapi')  is-invalid @enderror">
                                                    <option value="" disabled>--Pilih Anjuran--</option>
                                                    <option value="1">1</option>
                                                    <option value="2" selected>2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
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
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8" selected>8</option>
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
                    <div class="card">
                        <div class="card-body card-khusus-body">
                            <h4 style="text-align: center;color:black">History Kunjungan</h4>
                            <h5 style="text-align: center;color:black">* untuk melihat history kunjungan pilih tanggal di bawah ini</h5>
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
                                                    <a href="">Detail</a>
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