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
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">{{ $biodatas['NAMA_PASIEN']}} - ({{ $biodatas['NO_MR']}})</a>
                            </div>
                            <div class="author-box-job"><b></div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">NIK</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas['HP2']}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Tanggal Lahir</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ date('d-m-Y', strtotime($biodatas['TGL_LAHIR']))}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Jenis Kelamin</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : @if ($biodatas['JENIS_KELAMIN'] == 'L')
                                                Laki-Laki
                                                @else
                                                Perempuan
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">No Hp</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas['HP1']}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Alamat</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $biodatas['ALAMAT']}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-100 d-sm-none"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header card-success">
                            <h4 class="card-title">Tambah Data CPPT Fisioterapi</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('cppt.tambahData') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Transaksi </label>
                                            <input type="hidden" name="NO_MR" class="form-control" value="{{ $cppt['NO_MR_PASIEN']}}" readonly>
                                            <input type="text" name="KD_TRANSAKSI_FISIO" class="form-control" value="{{ $cppt['KODE_TRANSAKSI_FISIO']}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal dan jam Terapi </label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="TANGGAL_FISIO" class="form-control" value="{{ $cppt['CREATE_AT']}}" readonly>
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
                                            <select name="JENIS_FISIO[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Jenis Fisio" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                                <option value="" disabled>-- Pilih Jenis Fisio --</option>
                                                @foreach ($jenisfisio as $jenis)
                                                <option value="{{ $jenis['NAMA_TERAPI'] }}">{{ $jenis['NAMA_TERAPI'] }}</option>
                                                @endforeach
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
                        <div class="card-body">
                            <label>*Bismillahirohmanirrohim, saya dengan sadar dan penuh tanggung jawab mengisikan formulir ini dengan data yang benar </label>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header card-success">
                            <a href="{{ route('transaksi_fisio.fisio', ['no_mr' => $biodatas['NO_MR']])}}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-rotate-back"></i> Kembali</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal & Jam</th>
                                            <th>Anamnesa & Pemeriksaaan</th>
                                            <th>Diagnosa</th>
                                            <th>Terapi</th>
                                            <th>Dokter</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $cppt)
                                        <tr>
                                            <td>{{$cppt['TANGGAL_FISIO']}} & {{ date('G:i', strtotime($cppt['JAM_FISIO']))}} WIB</td>
                                            <td>S = {{$cppt['ANAMNESA']}} <br>O = TD = {{$cppt['TEKANAN_DARAH']}}, N = {{$cppt['NADI']}}, T = {{$cppt['SUHU']}}</td>
                                            <td>{{$cppt['DIAGNOSA']}}</td>
                                            <td>{{$cppt['JENIS_FISIO']}}</td>
                                            <td>@if($cppt['KODE_DOKTER'] != '')
                                                {{ $dokter['Nama_Dokter'] }}
                                                @else

                                                @endif
                                            </td>
                                            <td width="20%">
                                                <a href="{{ route('cppt.edit', [
                                            'id' => $cppt['ID_CPPT_FISIO']
                                            ]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Edit</a>
                                                <button id="delete" data-id="{{ $cppt['ID_CPPT_FISIO'] }}" data-nama="{{ $cppt['NO_MR'] }}" data-bs-toggle="tooltip" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
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