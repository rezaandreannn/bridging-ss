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
                                            <input type="text" name="NO_REG" class="form-control" value="{{$biodatas->No_Reg}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="TANGGAL_FISIO" class="form-control" value="" >
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="time" name="JAM_FISIO" class="form-control" id="jam_keperawatan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cara Pasien Datang</label>
                                           
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="CARA_DATANG" value="Sendiri" id="CARA_DATANG1">
                                                <label class="form-check-label" for="CARA_DATANG1">
                                                Sendiri
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="CARA_DATANG" value="Diantar" id="CARA_DATANG2">
                                                <label class="form-check-label" for="CARA_DATANG2">
                                                Diantar
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="CARA_DATANG" value="Rujukan" id="CARA_DATANG3">
                                                <label class="form-check-label" for="CARA_DATANG3">
                                                Rujukan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Diantar Atau Rujukan Dari : <code>Di isi jika diantar/rujukan</code></label>
                                            <input type="text" class="form-control" name="DEKSRIPSI_CARA_DATANG">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="3" name="ANAMNESA" value="" placeholder="Masukan ..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-block">Keadaan Umum</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_UMUM" value="Baik" id="KEADAAN_UMUM1">
                                                <label class="form-check-label" for="KEADAAN_UMUM1">
                                                Baik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_UMUM" value="Sedang" id="KEADAAN_UMUM2">
                                                <label class="form-check-label" for="KEADAAN_UMUM2">
                                                Sedang
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_UMUM" value="Buruk" id="KEADAAN_UMUM3">
                                                <label class="form-check-label" for="KEADAAN_UMUM3">
                                                Buruk
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label class="d-block">Keadaan Umum</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_KESADARAN" value="GCS" id="KEADAAN_KESADARAN1">
                                                <label class="form-check-label" for="KEADAAN_KESADARAN1">
                                                GCS
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_KESADARAN" value="E" id="KEADAAN_KESADARAN2">
                                                <label class="form-check-label" for="KEADAAN_KESADARAN2">
                                                E
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_KESADARAN" value="M" id="KEADAAN_KESADARAN3">
                                                <label class="form-check-label" for="KEADAAN_KESADARAN3">
                                                M
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="KEADAAN_KESADARAN" value="V" id="KEADAAN_KESADARAN4">
                                                <label class="form-check-label" for="KEADAAN_KESADARAN4">
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
                                                <input type="text" name="TEKANAN_DARAH" class="form-control">
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
                                                <input type="text" name="NADI" class="form-control">
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
                                                <input type="text" name="RESPIRASI" class="form-control">
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
                                                <input type="text" name="RESPIRASI" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <b>K/menit</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Suhu</label>
                                            <div class="input-group">
                                                <input type="text" name="SUHU" class="form-control">
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
                                                <input type="text" name="BERAT_BADAN" class="form-control">
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
                                            <input type="text" name="PROTHESA" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Orthosis</label>
                                            <input type="text" name="ORTHOSIS" class="form-control">
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
                                            <select name="STATUS_PSIKOLOGI" id="" class="form-control">
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
                                            <select name="STATUS_MENTAL" id="" class="form-control">
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
                                            <textarea class="form-control" rows="3" name="DIAGNOSA_KLINIS" value="" placeholder="Masukan ..."></textarea>
                                        </div>
                                    </div>
                                <div class="card-header card-success">
                                    <h4 class="card-title">Perencanaan</h4>
                                </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Terapi <code>*</code></label>
                                            <select name="JENIS_TERAPI_FISIO[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jenis Fisio" data-dropdown-css-class="select2-purple" style="width: 100%;">
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
                                                            <input class="form-check-input" type="radio" name="RENCANA_TINDAKAN" value="Tidak Ada" id="RENCANA_TINDAKAN1">
                                                                <label class="form-check-label" for="RENCANA_TINDAKAN1">
                                                                    Tidak Ada
                                                                </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="RENCANA_TINDAKAN" value="Ya" id="RENCANA_TINDAKAN2">
                                                                <label class="form-check-label" for="RENCANA_TINDAKAN2">
                                                                    Ya
                                                                </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <input type="text" name="JENIS_TINDAKAN" class="form-control" placeholder="Isi jenis tindakan jika ya">
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
                                                            <input class="form-check-input" type="radio" name="RENCANA_RUJUK" value="Tidak Ada" id="RENCANA_RUJUK1">
                                                                <label class="form-check-label" for="RENCANA_RUJUK1">
                                                                    Tidak Ada
                                                                </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="RENCANA_RUJUK" value="Ya" id="RENCANA_RUJUK2">
                                                                <label class="form-check-label" for="RENCANA_RUJUK2">
                                                                    Ya
                                                                </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="DESKRIPSI_RUJUK" class="form-control" placeholder="Rujukan Ke">
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
                                                            <input class="form-check-input" type="radio" name="RENCANA_KONSUL" value="Tidak Ada" id="RENCANA_KONSUL1">
                                                                <label class="form-check-label" for="RENCANA_KONSUL1">
                                                                    Tidak Ada
                                                                </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="RENCANA_KONSUL" value="Ya" id="RENCANA_KONSUL2">
                                                                <label class="form-check-label" for="RENCANA_KONSUL2">
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
                                            <input type="text" name="DESKRIPSI_RENCANA_KONSUL" class="form-control" placeholder="Ke Bagian">
                                        </div>
                                    </div>
                    

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anjuran</label>
                                            <div class="input-group">
                                                <input type="number" name="ANJURAN" class="form-control">
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
                                                <input type="number" name="EVALUASI" class="form-control">
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