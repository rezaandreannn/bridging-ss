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
                <div class="breadcrumb-item active"><a href="{{ route('prabedah.verifikasi-prabedah.index') }}">Operasi Kamar</a></div>
                <div class="breadcrumb-item">Perencanaan Pasca Bedah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm2" action="" method="GET">       
                        <div class="card-footer text-left">
                            <div class="row">
                                @can('menu filter by tanggal & dokter')
                                <div class="col-md-4">
                                    <label for="">Filter tanggal</label>
                                    @php
                                        $date = date('Y-m-d');
                                    @endphp
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="tanggal" {{(request('tanggal')==null) ?  $date : $date = request('tanggal') }} value="{{$date}}"  id="datefilter">
                                    </div>
                                </div>
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
                                @endcan
                            </div>
                        </div>
                        </form>
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Ruangan</th>
                                    <th scope="col">Dokter Operator</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pascaBedah as $verifikasi)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$verifikasi->no_mr}}</td>
                                    <td>{{ ucwords(strtolower(trim($verifikasi->nama_pasien))) }}</td>
                                    <td>{{$verifikasi->tanggal}}</td>
                                    <td>{{$verifikasi->nama_ruangan}}</td>
                                    <td>{{$verifikasi->nama_dokter}}</td>
                                    <td>  
                                        @if (isset($statusPascaBedah[$verifikasi->id]) && $statusPascaBedah[$verifikasi->id] != 'create')
                                        <a href="{{ route('pascabedah.perencanaan-pascabedah.show', $verifikasi->kode_register )}}" class="btn btn-info btn-sm"><i class="far fa-eye"></i> Lihat Detail</a>

                                        <a class="btn btn-primary btn-sm" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('pascabedah.perencanaan-pascabedah.cetak', $verifikasi->kode_register) }}"> 
                                            <i class="fas fa-download"></i> Unduh Pasca Bedah
                                        </a>
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

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
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
        document.getElementById("filterForm2").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('prabedah.verifikasi-prabedah.index') }}";
    }
</script>

@endpush
