@extends('layouts.app')

@section('title', $title)

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
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-tranksasi">
                                <i class="fas fa-plus"></i> Tambah Transaksi
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kode Transaksi</th>
                                            <th>No MR</th>
                                            <th width="15%">Jumlah Max Fisioterapi</th>
                                            <th width="15%">Fisioterapi yang sudah dilakukan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $transaksi)
                                        <tr>
                                            <input type="hidden" class="delete_id" value="{{ $transaksi->ID_TRANSAKSI }}">
                                            <input type="hidden" class="nama" value="{{ $transaksi->NO_MR_PASIEN }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$transaksi->CREATE_AT}}</td>
                                            <td>{{$transaksi->KODE_TRANSAKSI_FISIO}}</td>
                                            <td>{{$transaksi->NO_MR_PASIEN}}</td>
                                            <td>{{$transaksi->JUMLAH_TOTAL_FISIO}}</td>
                                            <td>{{$fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI)}}</td>
                                            <td>
                                                @if($fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI)>=$transaksi->JUMLAH_TOTAL_FISIO)
                                                <span class="badge badge-pill badge-success">Selesai</span>
                                                @else
                                                <span class="badge badge-pill badge-warning">Belum selesai</span>
                                                @endif

                                            </td>
                                            <td width="20%">
                                                @if($fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI) >= $transaksi->JUMLAH_TOTAL_FISIO && $fisioModel->cekLastCpptByKodeTr($transaksi->ID_TRANSAKSI)->JENIS_FISIO != '')

                                                @can('tambah cppt admin')
                                                <a href="{{ route('cppt.detail', [
                                                    'id' => $transaksi->ID_TRANSAKSI,
                                                    'no_mr' => $transaksi->NO_MR_PASIEN,'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO
                                                    ]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Tambah CPPT</a>
                                                @endcan

                                                @else
                                                <a href="{{ route('cppt.detail', [
                                            'id' => $transaksi->ID_TRANSAKSI,
                                            'no_mr' => $transaksi->NO_MR_PASIEN,'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO
                                            ]) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>Tambah CPPT</a>
                                                @endif

                                                <a href="{{ route('cppt.cetakCPPT', [
                                            'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO,
                                            'no_mr' => $transaksi->NO_MR_PASIEN
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fa fa-print"></i> CPPT</a>
                                                
                                                <a href="{{ route('cppt.buktiLayanan', [
                                            'kode_transaksi' => $transaksi->KODE_TRANSAKSI_FISIO,
                                            'no_mr' => $transaksi->NO_MR_PASIEN
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Bukti Pelayanan</a>
                                                @if($fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI) >= $transaksi->JUMLAH_TOTAL_FISIO)

                                                @else
                                                
                                                <button data-toggle="modal" data-target="#modal-edit-tranksasi18{{$transaksi->ID_TRANSAKSI}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</button>

                                                @if($fisioModel->countCpptByKodeTr($transaksi->ID_TRANSAKSI)>1)
                                   
                                                @else
                                                <form id="delete-form-{{$transaksi->ID_TRANSAKSI}}" action="{{ route('transaksi_fisio.delete', $transaksi->ID_TRANSAKSI) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-sm btn-danger" confirm-delete="true" data-menuId="{{$transaksi->ID_TRANSAKSI}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
                                                @endif
                                                
                                                @endif
                                                
                                                {{-- <a href="{{ route('form.dokter', ['no_mr' => $transaksi->NO_MR_PASIEN]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>CPPT Dokter</a> --}}
                                                
                                                {{-- <a href="{{ route('lembar.dokter', ['no_mr' => $transaksi->NO_MR_PASIEN]) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Lembar Dokter</a> --}}
                                                
                                                {{-- <a href="{{ route('cppt.cetakFormulir', [
                                            'no_mr' => $transaksi->NO_MR_PASIEN
                                            ]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-secondary"><i class="fa fa-print"></i> Formulir</a> --}}
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
<!-- Tambah Data -->
<div class="modal fade" id="modal-add-tranksasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transaksi_fisio.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>No MR Pasien </label>
                                <input type="hidden" name="NO_MR_PASIEN" class="form-control" value="{{ $biodatas->NO_MR}}">
                                <input type="text" name="NO_MR_PASIEN" class="form-control" value="{{ $biodatas->NO_MR}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jumlah Maksimal Fisio <code>jika tidak terapi isi dengan 0</code> </label>
                                <input type="number" name="JUMLAH_TOTAL_FISIO" class="form-control" placeholder="Di isi dengan angka" value="4">
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

<!-- Edit Data -->
@foreach ($transaksis as $transaksi)
<div class="modal fade" id="modal-edit-tranksasi18{{$transaksi->ID_TRANSAKSI}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Transaksi CPPT</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transaksi_fisio.update',$transaksi->ID_TRANSAKSI)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kode Transaksi </label>
                                <input type="hidden" name="ID_TRANSAKSI" class="form-control" value="{{ $transaksi->ID_TRANSAKSI }}" readonly>
                                <input type="text" name="KODE_TRANSAKSI_FISIO" class="form-control" value="{{ $transaksi->KODE_TRANSAKSI_FISIO }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>No MR Pasien </label>
                                <input type="text" name="NO_MR_PASIEN" class="form-control" value="{{ $transaksi->NO_MR_PASIEN }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jumlah Maksimal Fisio </label>
                                <input type="number" name="JUMLAH_TOTAL_FISIO" class="form-control" value="{{ $transaksi->JUMLAH_TOTAL_FISIO }}">
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
@endforeach

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<!-- Batasan inputan transaksi Fisioterapi -->


<!-- Delete Data -->
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#table-1').DataTable();

    // Event delegation untuk tombol delete
    $('#table-1').on('click', '[confirm-delete="true"]', function(event) {
        event.preventDefault();
        var menuId = $(this).data('menuid');
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777EF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('#delete-form-' + menuId);
                if (form.length) {
                    form.submit();
                } else {
                    console.error('Data will not be deleted!:', menuId);
                }
            }
        });
    });
});
</script>

@endpush