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
                <div class="breadcrumb-data active"><a href="{{ route('list-pasien.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-data">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
               <!-- Detail Pasien -->
               @include('components.biodata-pasien-bynoreg')
               <!-- Tutup Detail Pasien -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header card-success card-khusus-header">
                            <h6 class="card-khusus-title">Edit Data Riwayat CPPT Fisioterapi</h6>
                        </div>
                        <div class="card-body card-khusus-body">
                            <form action="{{ route('cppt.updateRiwayatCppt', $data->ID_CPPT_FISIO) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Transaksi </label>
                                            <input type="hidden" class="form-control" value="{{ $data->ID_TRANSAKSI }}" name="ID_TRANSAKSI" readonly>
                                            <input type="hidden" name="NO_MR_PASIEN" class="form-control" value="{{ $data->NO_MR_PASIEN}}" readonly>
                                            <input type="hidden" name="Kode_Dokter" class="form-control" value="{{ $biodata->Kode_Dokter}}" readonly>
                                            <input type="text" name="KODE_TRANSAKSI_FISIO" class="form-control" value="{{ $data->KODE_TRANSAKSI_FISIO}}" readonly>
                                        </div>
                                    </div>
                                    @php
                                    $date=date('Y-m-d');
                                    @endphp

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="TANGGAL_FISIO" class="form-control" value="{{ $date }}" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="time" name="JAM_FISIO" class="form-control" id="jam_keperawatan" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="ANAMNESA">{{ $data->ANAMNESA}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diagnosa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="DIAGNOSA" value="" placeholder="Masukan ..." @if ((auth()->user()->roles->pluck('name')[0])!='dokter fisioterapi') readonly  @endif>{{ $data->DIAGNOSA}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tekanan Darah</label>
                                            <input type="text" name="TEKANAN_DARAH" id="tekananDarah" value="{{ $data->TEKANAN_DARAH}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nadi</label>
                                            <input type="text" name="NADI" id="nadi" value="{{ $data->NADI}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Suhu</label>
                                            <input type="text" name="SUHU" id="suhu" value="{{ $data->SUHU}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lain-lain</label>
                                            <textarea name="LAINNYA" style="height: 80px;"  class="form-control" rows="2">{{ $data->LAINNYA}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                              <h6 class="card-subtitle mb-2"> <span class="badge badge-pill badge-info"><i class="fas fa-info"></i></span> Terapi yang diberikan dokter</h6>
                                              <hr>
                                              <p>{{$terapiDokterLastFisio->terapi ?? ''}}</p>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Fisio</label>
                                            <select name="JENIS_FISIO[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jenis Fisio" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Jenis Fisio --</option>
                                                @foreach($jenisfisio as $jenis)
                                                <option value="{{ $jenis->NAMA_TERAPI}}" @if(in_array($jenis->NAMA_TERAPI,$jenis_fisio)) selected="selected" @endif> {{$jenis->NAMA_TERAPI}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cara Pulang </label>
                                            <select name="CARA_PULANG" id="" class="form-control select2">
                                                <option value="" disabled>--Pilih--</option>
                                                <option value="KONSULTASI" {{ $data->CARA_PULANG == 'KONSULTASI' ? 'selected' : '' }}>KONSULTASI</option>
                                                <option value="RUJUK" {{ $data->CARA_PULANG == 'RUJUK' ? 'selected' : '' }}>RUJUK</option>
                                            </select>
                                        </div>
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

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    // Mendapatkan elemen input waktu
    const inputWaktu = document.getElementById('jam_keperawatan');

    // Mengatur waktu awal
    updateTime();

    // Fungsi untuk memperbarui waktu pada input
    function updateTime() {
        const waktuSekarang = new Date();
        const jam = waktuSekarang.getHours();
        const menit = waktuSekarang.getMinutes();
        const detik = waktuSekarang.getSeconds();
        const waktuDefault = jam.toString().padStart(2, '0') + ':' + menit.toString().padStart(2, '0');
        inputWaktu.value = waktuDefault;
    }

    // Memperbarui waktu setiap menit
    setInterval(updateTime, 1000);
</script>

<!-- Membatasi inputan huruf -->
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
</script>

@endpush