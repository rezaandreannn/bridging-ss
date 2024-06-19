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
                    <div class="card-header card-success">
                            <h4 class="card-title">Form Dokter Fisioterapi</h4>
                        </div>
                    </div>
                    <div class="card card-primary">
                  
                        <div class="card-body">
                            <form action="#" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Registrasi Pendaftaran </label>
                                            <input type="text" name="no_registrasi" class="form-control" value="{{$biodatas->No_Reg}}" readonly>
                                            <input type="hidden" name="kode_transaksi_fisio" class="form-control" value="{{$kode_transaksi_fisio}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal" class="form-control" value="" >
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="time" name="jam" class="form-control" id="jam_keperawatan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cara Pasien Datang</label>
                                           
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cara_datang" value="Sendiri" id="cara_datang1">
                                                <label class="form-check-label" for="cara_datang1">
                                                Sendiri
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cara_datang" value="Diantar" id="cara_datang2">
                                                <label class="form-check-label" for="cara_datang2">
                                                Diantar
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cara_datang" value="Rujukan" id="cara_datang3">
                                                <label class="form-check-label" for="cara_datang3">
                                                Rujukan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diantar Atau Rujukan Dari : <code>Di isi jika diantar/rujukan</code></label>
                                            <input type="text" class="form-control" name="deskripsi_cara_datang">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="3" name="anamnesa" value="" placeholder="Masukan ..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-block">Keadaan Umum</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="keadaan_umum" value="Baik" id="keadaan_umum1">
                                                <label class="form-check-label" for="keadaan_umum1">
                                                Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="keadaan_umum" value="Sedang" id="keadaan_umum2">
                                                <label class="form-check-label" for="keadaan_umum2">
                                                Sedang
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="keadaan_umum" value="Buruk" id="keadaan_umum3">
                                                <label class="form-check-label" for="keadaan_umum3">
                                                Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="d-block">Keadaan Kesadaran</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="GCS" id="kesadaran1">
                                                <label class="form-check-label" for="kesadaran1">
                                                GCS
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="E" id="kesadaran2">
                                                <label class="form-check-label" for="kesadaran2">
                                                E
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="M" id="kesadaran3">
                                                <label class="form-check-label" for="kesadaran3">
                                                M
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kesadaran" value="V" id="kesadaran4">
                                                <label class="form-check-label" for="kesadaran4">
                                                V
                                                </label>
                                            </div>
                                            </div>
                
                                    </div>
                                <div class="card-header card-success">
                                    <h4 class="card-title">Pemeriksaan Fisik</h4>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tekanan Darah</label>
                                            <div class="input-group">
                                                <input type="text" name="tekanan_darah" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>mmHG</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nadi</label>
                                            <div class="input-group">
                                                <input type="text" name="nadi" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>x/menit</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Respirasi</label>
                                            <div class="input-group">
                                                <input type="text" name="respirasi" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>x/menit</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Suhu</label>
                                            <div class="input-group">
                                                <input type="text" name="suhu" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>C</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat Badan</label>
                                            <div class="input-group">
                                                <input type="text" name="berat_badan" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>Kg</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Prothesa</label>
                                            <input type="text" name="prothesa" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Orthosis</label>
                                            <input type="text" name="orthosis" class="form-control">
                                        </div>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Psikologi</label>
                                            <select name="status_psikologi" id="" class="form-control">
                                                <option value="" selected disabled>--Pilih Status Psikologi--</option>
                                                <option value="Tenang">Tenang</option>
                                                <option value="Cemas">Cemas</option>
                                                <option value="Marah">Marah</option>
                                                <option value="Depresi">Depresi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status Mental</label>
                                            <select name="status_mental" id="" class="form-control">
                                                <option value="" selected disabled>--Pilih Status Mental--</option>
                                                <option value="Kooperatif">Kooperatif</option>
                                                <option value="Tidak Kooperatif">Tidak Kooperatif</option>
                                                <option value="Gelisah/Delirium/Berontak">Gelisah/Delirium/Berontak</option>
                                                <option value="Ketidak Mampuan Dalam Mengikuti Perintah">Ketidak Mampuan Dalam Mengikuti Perintah</option>
                                            </select>
                                        </div>
                                    </div>
                                <div class="card-header card-success">
                                    <h4 class="card-title">Analisa</h4>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Diagnosa Klinis <code>*</code></label>
                                            <textarea class="form-control" rows="3" name="diagnosa_klinis" value="" placeholder="Masukan ..."></textarea>
                                        </div>
                                    </div>
                                <div class="card-header card-success">
                                    <h4 class="card-title">Perencanaan</h4>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Terapi <code>*</code></label>
                                            <select name="jenis_terapi_fisio[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jenis Fisio" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Jenis Fisio --</option>
                                                @foreach ($jenisterapifisio as $terapi)
                                                <option value="{{ $terapi->NAMA_TERAPI }}">{{ $terapi->NAMA_TERAPI }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label>Rencana Tindakan</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="rencana_tindakan" value="Tidak Ada" id="rencana_tindakan1">
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
                                                    <input type="text" name="jenis_tindakan" class="form-control" placeholder="Isi jenis tindakan jika ya">
                                                </div>
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
                                                            <input class="form-check-input" type="radio" name="rencana_rujukan" value="Tidak Ada" id="rencana_rujukan1">
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
                                                    <input type="text" name="deskripsi_rujukan" class="form-control" placeholder="Rujukan Ke">
                                                </div>
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
                                                            <input class="form-check-input" type="radio" name="rencana_konsul" value="Ya" id="rencana_konsul2">
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
                                            <input type="text" name="deskripsi_konsul" class="form-control" placeholder="Ke Bagian">
                                        </div>
                                    </div>
                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anjuran</label>
                                            <div class="input-group">
                                                <input type="number" name="anjuran_terapi" class="form-control">
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
                                                <input type="number" name="evaluasi_terapi" class="form-control">
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
                        <div class="card-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                <!-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> -->
                                <a href="{{ route('tindakan.dokter', ['no_mr' => $biodatas->NO_MR]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i> Simpan</a>
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
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<!-- Delete Data -->
<script>
    $(document).on('click', '#delete', function() {
        var cppt = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
                title: "Are You Sure?",
                text: "Data Will Be Deleted (" + nama + ") !!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "{{ route('cppt.deleteData', ['id' => ':id']) }}".replace(':id', cppt);
                } else {
                    swal("Data will not be deleted!");
                }
            });
    });
</script>

@endpush