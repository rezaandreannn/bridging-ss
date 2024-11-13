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
                <div class="breadcrumb-item">Ruang Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Pilih Pasien</label>
                                <select name="ruangan_id" class="form-control select2 @error('ruangan_id') is-invalid @enderror" id="">
                                    <option value="" selected disabled>--Pilih Ruangan Operasi--</option>
                                    @foreach ($ruanganOperasi as $ruangan)
                                    <option value="{{ $ruangan->id}}" @if(old('ruangan_id')==$ruangan->id ) selected @endif>{{$ruangan->nama_ruang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ruangan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Kode Register</label>
                                <input type="text" name="kode_register" value="{{ old('kode_register')}}" class="form-control @error('kode_register') is-invalid @enderror" readonly>
                            </div>
                            @error('kode_register')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Pilih Ruangan Operasi</label>
                                <select name="ruangan_id" class="form-control select2 @error('ruangan_id') is-invalid @enderror" id="">
                                    <option value="" selected disabled>--Pilih Ruangan Operasi--</option>
                                    @foreach ($ruanganOperasi as $ruangan)
                                    <option value="{{ $ruangan->id}}" @if(old('ruangan_id')==$ruangan->id ) selected @endif>{{$ruangan->nama_ruang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ruangan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Pilih Dokter</label>
                                <select name="ruangan_id" class="form-control select2 @error('ruangan_id') is-invalid @enderror" id="">
                                    <option value="" selected disabled>--Pilih Dokter--</option>
                                    @foreach ($dokters as $dokter)
                                    <option value="{{$dokter->Kode_Dokter}}" @if(old('kode_dokter')==$dokter->Kode_Dokter) selected @endif>{{$dokter->Nama_Dokter}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ruangan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal')}}" class="form-control @error('tanggal') is-invalid @enderror">
                            </div>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Jam Mulai(optional)</label>
                                <input type="time" name="tanggal" value="{{ old('tanggal')}}" class="form-control @error('tanggal') is-invalid @enderror">
                            </div>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-4 col-md-6">
                            <div class="form-group">
                                <label>Jam Selesai(optional)</label>
                                <input type="time" name="tanggal" value="{{ old('tanggal')}}" class="form-control @error('tanggal') is-invalid @enderror">
                            </div>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-body">
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
                                        <th scope="col">Nama Ruang Operasi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$booking->kode_register}}</td>
                                        <td>{{$booking->tanggal}}</td>
                                        <td>{{$booking->nama_pasien}}</td>
                                        <td>{{$booking->no_mr}}</td>
                                        <td>{{$booking->nama_dokter}}</td>
                                        <td>{{$booking->ruang_operasi}}</td>
                                        <td>
                                            <div class="dropdown d-inline">
                                                <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item has-icon" href=""><i class="fas fa-info"></i> Detail</a>
                                                    <a class="dropdown-item has-icon" href=""><i class="fas fa-pencil-alt"></i>Ubah Data</a>
                                                    <a class="dropdown-item has-icon" href=""><i class="fas fa-calendar-check"></i>Ganti Tanggal</a>
                                                    <a class="dropdown-item has-icon" href=""><i class="fas fa-person-booth"></i>Ganti Ruangan</a>
                                                    <a class="dropdown-item has-icon" href="{{ route('operasi.penandaan.create') }}"><i class="fas fa-marker"></i> Penandaan Operasi</a>
                                                    <a class="dropdown-item has-icon" href=""><i class="fas fa-trash"></i>Hapus / Batal</a>
                                                </div>
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


<div class="modal fade" id="modal-add-booking-operasi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operasi.ruang.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Pasien</label>
                                <input type="text" name="kode_register" value="{{ old('kode_register')}}" class="form-control @error('kode_register') is-invalid @enderror">
                            </div>
                            @error('kode_register')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Ruang Operasi</label>
                                <select name="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror" id="">
                                    <option value="">--Pilih Ruangan Operasi--</option>
                                    @foreach ($ruanganOperasi as $ruangan)
                                    <option value="{{$ruangan->id}}" @if(old('ruangan_id')==$ruangan->id) selected @endif>{{$ruangan->nama_ruang}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('ruangan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- Select Dokter --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Dokter</label>
                                <select name="kode_dokter" class="form-control select2 @error('kode_dokter') is-invalid @enderror" id="">
                                    <option value="">--Pilih Dokter--</option>
                                    @foreach ($dokters as $dokter)
                                    <option value="{{$dokter->Kode_Dokter}}" @if(old('kode_dokter')==$dokter->Kode_Dokter) selected @endif>{{$dokter->Nama_Dokter}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kode_dokter')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" value="{{ old('tanggal')}}" class="form-control @error('tanggal') is-invalid @enderror">
                            </div>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
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


{{-- @foreach ($bookings as $booking)
<div class="modal fade" id="modal-edit-ruang{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditRuangLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditRuangLabel">Edit Ruang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
  
                <form action="#" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Pasien</label>
                                    <input type="text" name="kode_register" value="{{$booking->kode_register}}" class="form-control @error('kode_register') is-invalid @enderror">
                                </div>
                                @error('kode_register')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>  
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Ruang Operasi</label>
                                    <select name="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror" id="">
                                        <option value="">--Pilih Ruangan Operasi--</option>
                                        @foreach ($ruanganOperasi as $ruangan)
                                        <option value="{{$ruangan->id}}" @if($booking->ruang_operasi== $ruangan->id) selected @endif>{{$ruangan->nama_ruang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ruangan_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Dokter</label>
                                    <select name="kode_dokter" class="form-control select2 @error('kode_dokter') is-invalid @enderror" id="">
                                        <option value="">--Pilih Dokter--</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{$dokter->Kode_Dokter}}" @if($booking->nama_dokter == $dokter->Kode_Dokter) selected @endif>{{$dokter->Nama_Dokter}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kode_dokter')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" name="tanggal" value="{{ $booking->tanggal}}" class="form-control @error('tanggal') is-invalid @enderror">
                                </div>
                                @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Simpan</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalEditRuangLabel">Edit Ruang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="kode_register" value="{{$booking->kode_register}}" class="form-control @error('kode_register') is-invalid @enderror">
                        </div>
                        @error('kode_register')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Ruang Operasi</label>
                            <select name="ruangan_id" class="form-control @error('ruangan_id') is-invalid @enderror" id="">
                                <option value="">--Pilih Ruangan Operasi--</option>
                                @foreach ($ruanganOperasi as $ruangan)
                                <option value="{{$ruangan->id}}" @if($booking->ruangan_id== $ruangan->id) selected @endif>{{$ruangan->nama_ruang}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('ruangan_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Dokter</label>
                            <select name="kode_dokter" class="form-control select2 @error('kode_dokter') is-invalid @enderror" id="">
                                <option value="">--Pilih Dokter--</option>
                                @foreach ($dokters as $dokter)
                                <option value="{{$dokter->Kode_Dokter}}" @if($booking->kode_dokter == $dokter->Kode_Dokter) selected @endif>{{$dokter->Nama_Dokter}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('kode_dokter')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $booking->tanggal}}" class="form-control @error('tanggal') is-invalid @enderror">
                        </div>
                        @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
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
@endforeach --}}

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
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

@endpush
