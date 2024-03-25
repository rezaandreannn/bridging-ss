@extends('layouts.app')

@section('title', $title)

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
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('cppt.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">CPPT Fisioterapi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">FIKI Hidayat - ( 164820 )</a>
                            </div>
                            <div class="author-box-job"><b></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                NIK
                                            </div>
                                            <div class="col-md-8">
                                                : 1872022402020001
                                            </div>
                                            <div class="col-md-4">
                                                Email
                                            </div>
                                            <div class="col-md-8">
                                                : Fiki@gmail.com

                                            </div>
                                            <div class="col-md-4">
                                                Tanggal Lahir
                                            </div>
                                            <div class="col-md-8">
                                                : 24-02-2002
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Jenis Kelamin
                                            </div>
                                            <div class="col-md-8">
                                                : Laki-Laki
                                            </div>
                                            <div class="col-md-4">
                                                No Hp
                                            </div>
                                            <div class="col-md-8">
                                                :
                                            </div>
                                            <div class="col-md-4">
                                                Alamat
                                            </div>
                                            <div class="col-md-8">
                                                : 23A KARANGREJO 25/07 METRO UTARA
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 d-sm-none"></div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header card-success">
                            <h4 class="card-title">Tambah Data CPPT Fisioterapi</h4>
                        </div>
                        <form action="#" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="NO_MR" class="form-control" value="205967">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Transaksi </label>
                                            <input type="text" name="KD_TRANSAKSI_FISIO" class="form-control" value="FISIO-24-00008" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="TANGGAL_FISIO" class="form-control" value="2024-03-25" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="time" name="JAM_FISIO" class="form-control" id="jam_keperawatan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Anamnesa / Allow Anamnesa <code>*</code></label>
                                            <textarea class="form-control" rows="2" name="ANAMNESA" value="" placeholder="Masukan ..."></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tekanan Darah</label>
                                            <input type="text" name="TEKANAN_DARAH" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nadi</label>
                                            <input type="text" name="NADI" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Suhu</label>
                                            <input type="text" name="SUHU" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Fisio</label>
                                            <select name="JENIS_TERAPI[]" id="" class="form-control select2" multiple="multiple" data-placeholder="Select a Fisio" data-dropdown-css-class="select2-purple">
                                                <option value="" disabled>--Pilih--</option>
                                                <option value=" TENS">TENS</option>
                                                <option value="ES">ES</option>
                                                <option value="INFRARED">INFRARED</option>
                                                <option value="MWD">MWD</option>
                                                <option value="SWD">SWD</option>
                                                <option value="ULTRASOND">ULTRASOND</option>
                                                <option value="ICING">ICING</option>
                                                <option value="KINESIOTAPING">KINESIOTAPING</option>
                                                <option value="EXERCISE">EXERCISE</option>
                                                <option value="FASILITASI & STIMULASI">FASILITASI & STIMULASI</option>
                                                <option value="ROM EXERCISE">ROM EXERCISE</option>
                                                <option value="STRENGTHNING">STRENGTHNING</option>
                                                <option value="CHEST THERAPY">CHEST THERAPY</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cara Pulang </label>
                                            <select name="CARA_PULANG" id="" class="form-control select2">
                                                <option value="" selected disabled>--Pilih--</option>
                                                <option value="KONSULTASI">KONSULTASI</option>
                                                <option value="RUJUK">RUJUK</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal & Jam</th>
                                        <th width="15%">Anamnesa & Pemeriksaan</th>
                                        <th>Diagnosa</th>
                                        <th>Terapi</th>
                                        <th>Dokter</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>12-13-2024</td>
                                        <td>Gangguan Jiwa</td>
                                        <td>Minus</td>
                                        <td>Kosong</td>
                                        <td>Dr Yusuf</td>
                                        <td width="20%">
                                            <a href="{{ route('cppt.edit') }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"> Edit</i></a>
                                            <a href="" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa fa-trash"> Hapus</i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Tambah Data -->
<div class="modal fade" id="modal-add-tranksasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cetak CPPT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>No MR Pasien </label>
                                <input type="hidden" name="NO_MR_PASIEN" class="form-control" value="205967">
                                <input type="text" name="NO_MR_PASIEN" class="form-control" value="205967" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jumlah Maksimal Fisio <code>jika tidak terapi isi dengan 0</code> </label>
                                <input type="number" name="JUMLAH_TOTAL_FISIO" class="form-control" placeholder="Di isi dengan angka">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit-tranksasi18">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Transaksi CPPT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Transaksi </label>
                                <input type="hidden" name="ID_TRANSAKSI" class="form-control" value="18" readonly>
                                <input type="text" name="KODE_TRANSAKSI_FISIO" class="form-control" value="FISIO-24-00008" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>No MR Pasien </label>
                                <input type="text" name="NO_MR_PASIEN" class="form-control" value="205967" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jumlah Maksimal Fisio </label>
                                <input type="number" name="JUMLAH_TOTAL_FISIO" class="form-control" value="3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-left">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

@endpush