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
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.ruang.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Booking Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <form action="{{ isset($booking) ? route('operasi.booking.update', $booking->id) : route('operasi.booking.store') }}" method="POST">
                    {{-- <form action="{{ route('operasi.booking.store') }}" method="POST"> --}}
                    @csrf
                    @if(isset($booking))
                    @method('PUT')
                    @endif
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Pilih Pasien</label>
                                    <select name="kode_register" class="form-control select2 @error('kode_register') is-invalid @enderror">
                                        <option value="" selected disabled>--Pilih Pasien--</option>
                                        @foreach ($pasien as $data)
                                        <option value="{{ $data->kode_register }}" @if(old('kode_register', $booking->kode_register ?? '')==$data->kode_register) selected @endif>
                                            {{ $data->no_mr }} - {{ $data->nama_pasien }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kode_register')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Pilih Dokter</label>
                                    <select name="kode_dokter" class="form-control select2 @error('kode_dokter') is-invalid @enderror" id="">
                                        <option value="" selected disabled>--Pilih Dokter--</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{$dokter->Kode_Dokter}}" @if(old('kode_dokter', $booking->kode_dokter ?? '')==$dokter->Kode_Dokter) selected @endif>{{$dokter->Nama_Dokter}}</option>
                                        @endforeach
                                    </select>
                                    @error('kode_dokter')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" value="{{ old('tanggal', $booking->tanggal ?? '')}}" class="form-control @error('tanggal') is-invalid @enderror">
                                    @error('tanggal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Rencana Operasi</label>
                                    <input type="time" name="rencana_operasi" value="{{ isset($booking) && $booking->rencana_operasi ? date('H:i', strtotime($booking->rencana_operasi)) : '' }}" class="form-control @error('rencana_operasi') is-invalid @enderror">
                                    @error('rencana_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Ruang Asal</label><code> (Contoh : Poli/IGD/Ruangan : Firdaus)</code>
                                    <input type="text" name="asal_ruangan" value="{{ old('asal_ruangan', $booking->asal_ruangan ?? '')}}" class="form-control @error('asal_ruangan') is-invalid @enderror">
                                    @error('asal_ruangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-12 col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Jenis Operasi</label>
                                    <input type="text" name="jenis_operasi" value="{{ old('jenis_operasi', $booking->jenis_operasi ?? '')}}" class="form-control @error('jenis_operasi') is-invalid @enderror">
                                    @error('jenis_operasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ isset($booking) ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
                        <form id="filterForm" action="" method="GET">       
                        <div class="card-footer text-left">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Filter tanggal</label>
                                    @php
                                        $date = date('Y-m-d');
                                    @endphp
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="tanggal" {{(request('tanggal')==null) ?  $date : $date = request('tanggal') }} value="{{$date}}"  id="datefilter">
                                    </div>
                                </div>
                                 <!-- Only show doctor filter if the user is NOT a perawat bangsal -->
                                @if (auth()->user()->hasRole('perawat poli') || auth()->user()->hasRole('perawat poli mata') || auth()->user()->hasRole('perawat igd'))
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pilih Dokter</label>
                                        <select name="kode_dokter" class="form-control select2 @error('kode_dokter') is-invalid @enderror">
                                            <option value="" selected disabled>--Pilih Dokter--</option>
                                            @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->Kode_Dokter }}" 
                                                    @if(request('kode_dokter') == $dokter->Kode_Dokter) selected @endif>
                                                    {{ $dokter->Nama_Dokter }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kode_dokter')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-primary mr-2" style="margin-top: 5px;">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                        <button type="button" class="btn btn-danger" style="margin-top: 5px;" onclick="resetForm()">
                                            <i class="fas fa-sync"></i> Reset
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table-striped table" id="table-1">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Register</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Pasien</th>
                                        <th scope="col">No MR</th>
                                        <th scope="col">Nama Dokter</th>
                                        <th scope="col">Asal Ruangan</th>
                                        <th scope="col">Status Kunjungan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="booking-table-body">
                                    @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$booking->kode_register}}</td>
                                        <td>{{$booking->tanggal}}</td>
                                        <td>{{ ucwords(strtolower(trim($booking->nama_pasien))) }}</td>
                                        <td>{{$booking->no_mr}}</td>
                                        <td>{{$booking->nama_dokter}}</td>
                                        <td>{{$booking->asal_ruangan}}</td>
                                        <td>
                                            @if(isset($statusPendaftaran[$booking->kode_register]) && $statusPendaftaran[$booking->kode_register] == 1)
                                            <span class="badge badge-success">Aktif</span>
                                            @else
                                            <span class="badge badge-danger">Closing</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($statusPendaftaran[$booking->kode_register]) && $statusPendaftaran[$booking->kode_register] == 1)
                                            <div class="dropdown d-inline">
                                                <a href="#" class="text-primary" id="dropdownMenuLink{{$booking->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    {{-- Detail Booking --}}
                                                    {{-- @if (isset($statusPenandaan[$booking->id]) && $statusPenandaan[$booking->id] == 'create')
                                                    @else    
                                                    <a class="dropdown-item has-icon" href="{{ route('operasi.booking.detail', ['id' => $statusPenandaan[$booking->id]]) }}">
                                                            <i class="fas fa-info"></i> Detail Booking
                                                        </a>
                                                    @endif --}}
                                                    {{-- Ubah Data --}}
                                                    <a class="dropdown-item has-icon" href="{{ route('operasi.booking.edit', $booking->id )}}"><i class="fas fa-pencil-alt"></i> Ubah Data</a>
                                                    {{-- Ubah Tanggal --}}
                                                    <a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#modal-edit-tanggal{{ $booking->id }}">
                                                        <i class="fas fa-calendar-check"></i> Ganti Tanggal
                                                    </a>
                                                    {{-- Ubah Ruangan --}}
                                                    <a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#modal-edit-ruang{{ $booking->id }}">
                                                        <i class="fas fa-person-booth"></i> Ganti Ruangan
                                                    </a>
                                                    <!-- Hidden form for deletion -->
                                                    <form id="delete-form-{{$booking->id}}" action="{{ route('operasi.booking.destroy', $booking->id) }}" method="POST" style="display: none;">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                    <!-- Delete link -->
                                                    <a class="dropdown-item has-icon" href="#" confirm-delete="true" data-menuId="{{$booking->id}}">
                                                        <i class="fas fa-trash"></i> Hapus / Batal
                                                    </a>
                                                </div>
                                            </div>
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
    </section>
</div>


@foreach ($bookings as $booking)
<div class="modal fade" id="modal-edit-tanggal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditTanggalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTanggalLabel{{ $booking->id }}">Edit Tanggal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operasi.tanggal.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTanggal{{ $booking->id }}">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $booking->tanggal ?? '')}}" class="form-control @error('tanggal') is-invalid @enderror">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<!-- Modals for Edit Room, adjusted to iterate through bookings -->
@foreach ($bookings as $booking)
<div class="modal fade" id="modal-edit-ruang{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditRuangLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditRuangLabel{{ $booking->id }}">Edit Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operasi.ruangan.update', $booking->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNamaRuang{{ $booking->id }}">Nama Ruang</label>
                       <input type="text" name="asal_ruangan"  class="form-control" value="{{ old('asal_ruangan', $booking->asal_ruangan ?? '')}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });

</script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#table-1').DataTable();

        // Event delegation untuk tombol delete
        $('#table-1').on('click', '[confirm-delete="true"]', function(event) {
            event.preventDefault();
            var menuId = $(this).data('menuid');
            Swal.fire({
                title: 'Apakah Kamu Yakin?'
                , text: "Semua data yang berkaitan dengan booking akan ikut terhapus!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#6777EF'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Hapus saja!'
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

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('operasi.booking.index') }}";
    }
</script>

@endpush
