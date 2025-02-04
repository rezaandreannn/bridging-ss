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

<style>

</style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('operasi.penandaan.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Penandaan Operasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" action="" method="GET">       
                        <div class="card-footer text-left">
                            <div class="row">
                                @if (auth()->user()->hasRole('dokter umum') || auth()->user()->hasRole('perawat poli mata'))
                                <div class="col-md-4">
                                    <label for="">Filter tanggal</label>
                                    @php
                                        $date = date('Y-m-d');
                                    @endphp
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="tanggal" {{(request('tanggal')==null) ?  $date : $date = request('tanggal') }} value="{{$date}}"  id="datefilter">
                                    </div>
                                </div>
                                @endif
                                @if (auth()->user()->hasRole('perawat poli mata'))
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
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penandaans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="font-weight-bold">{{ $data->no_mr }}</span></td>
                                    <td>{{ ucwords(strtolower(trim($data->nama_pasien))) }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->nama_dokter }}</td>
                                    <td>
                                        @if (isset($statusPenandaan[$data->id]) && $statusPenandaan[$data->id] == 'create')
                                        <span class="badge badge-danger">Create</span>
                                        @else
                                        <span class="badge badge-success">Update</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($statusGambar[$data->id]))
                                        <a href="#" data-toggle="modal" data-target="#gambarModal{{ $data->kode_register }}" class="badge badge-success">
                                            Detail
                                        </a>
                                        @else
                                        <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown d-inline">
                                            <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item has-icon" href="{{ isset($statusPenandaan[$data->id]) && $statusPenandaan[$data->id] == 'create' ? route('operasi.penandaan.create', ['noReg' => $data->kode_register]) : route('operasi.penandaan.edit', ['id' => $statusPenandaan[$data->id]]) }}">
                                                    <i class="fas fa-marker"></i> {{ isset($statusPenandaan[$data->id]) && $statusPenandaan[$data->id] == 'create' ? 'Tanda Lokasi' : 'Edit Tanda Lokasi' }}
                                                </a>

                                                @if(isset($statusTandaTangan[$data->id]) && $statusTandaTangan[$data->id] == 'create')
                                                <a class="dropdown-item has-icon" href="{{ route('ttd-ok.penandaan.create', ['kode_register' => $data->kode_register]) }}">
                                                    <i class="fas fa-signature"></i> Ajukan Tanda Tangan
                                                </a>
                                                @endif

                                                {{-- jika sudah diinput bisa diunduh --}}
                                                @if (isset($statusPenandaan[$data->id]) && $statusPenandaan[$data->id] != 'create')
                                                <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('operasi.penandaan.cetak', $data->kode_register) }}"><i class="fas fa-file-download"></i> Unduh</a>
                                                @endif


                                                {{-- Hapus --}}
                                                <form id="delete-form-{{$data->kode_register}}" action="{{ route('operasi.penandaan.destroy', $data->kode_register) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <!-- Delete link -->
                                                <a class="dropdown-item has-icon" href="#" confirm-delete="true" data-menuId="{{$data->kode_register}}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </div>
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


@foreach ($penandaan as $p)
<div class="modal fade" id="gambarModal{{ $p->kode_register ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="gambarModalLabel{{ $p->kode_register ?? '' }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $p->nama_pasien }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Jenis Operasi: {{ $p->jenis_operasi }}</p>
                <img id="gambarZoom{{ $p->id ?? '' }}" src="{{ asset('storage/operasi/penandaan-pasien/image/' . $p->gambar) }}" class="img-fluid" alt="Gambar Pengguna" style="transition: transform 0.3s ease; cursor: zoom-in;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
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
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

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
                , text: "Anda tidak akan dapat mengembalikan ini!"
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
        window.location.href = "{{ route('operasi.penandaan.index') }}";
    }
</script>

@endpush
