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
                <div class="breadcrumb-item">Verifikasi Pra Bedah</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm2" action="" method="GET">       
                        <div class="card-footer text-left">
                            <div class="row">
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
                                @endif
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
                                    <th scope="col">Dokter Operator</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($verifikasis as $verifikasi)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$verifikasi->no_mr}}</td>
                                    <td>{{ ucwords(strtolower(trim($verifikasi->nama_pasien))) }}</td>
                                    <td>{{$verifikasi->tanggal}}</td>
                                    <td>{{$verifikasi->nama_dokter}}</td>
                                    <td>
                                    @if (isset($statusBerkas[$verifikasi->id]))
                                        <div class="row">
                                            <ul>
                                                @if ($statusBerkas[$verifikasi->id]['status_pasien'] == 1)
                                                    <li class="text-success">Status Pasien</li>
                                                @endif
                                        
                                                @if ($statusBerkas[$verifikasi->id]['assesmen_pra_bedah'] == 1)
                                                    <li class="text-success">Assesmen Pra Bedah</li>
                                                @endif
                                        
                                                @if ($statusBerkas[$verifikasi->id]['penandaan_lokasi'] == 1)
                                                    <li class="text-success">Penandaan Lokasi</li>
                                                @endif
                                        
                                                @if ($statusBerkas[$verifikasi->id]['informed_consent_bedah'] == 1)
                                                    <li class="text-success">Informed Consent Bedah</li>
                                                @endif
                                            </ul>
                                            <ul>
                                                @if ($statusBerkas[$verifikasi->id]['informed_consent_anastesi'] == 1)
                                                    <li class="text-success">Informed Consent Anestesi</li>
                                                @endif
                                        
                                                @if ($statusBerkas[$verifikasi->id]['assesmen_pra_anastesi_sedasi'] == 1)
                                                    <li class="text-success">Assesmen Pra Anastesi Sedasi</li>
                                                @endif
                                                @if ($statusBerkas[$verifikasi->id]['edukasi_anastesi'] == 1)
                                                    <li class="text-success">Edukasi Anastesi</li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                    </td>
                                    <td>  
                                        @if($verifikasi->tanggal == now()->format('Y-m-d'))
                                        <div class="dropdown d-inline">
                                            <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu">
                                                {{-- Input --}}
                                               
                                                    @if (isset($statusVerifikasi[$verifikasi->kode_register]) && 
                                                        array_filter($statusVerifikasi[$verifikasi->kode_register]))
                                                        <a class="dropdown-item has-icon" href="{{ route('prabedah.verifikasi-prabedah.edit', $verifikasi->kode_register) }}">
                                                            <i class="fas fa-edit"></i> Edit
                                                        </a>
                                                    @else
                                                        <a class="dropdown-item has-icon" href="{{ route('prabedah.verifikasi-prabedah.create', $verifikasi->kode_register) }}">
                                                            <i class="fas fa-plus"></i> Tambah
                                                        </a>
                                                    @endif

                                               
                                                {{-- <a class="dropdown-item has-icon" href="{{ route('prabedah.verifikasi-prabedah.create',$verifikasi->kode_register)}}"> <i class="fas fa-plus"></i> Tambah</a>
                                                <a class="dropdown-item has-icon" href="{{ route('prabedah.verifikasi-prabedah.edit',$verifikasi->kode_register)}}"> <i class="fas fa-plus"></i> Edit</a> --}}
                                                {{-- @if (!$statusTtd)
                                                <a class="dropdown-item has-icon" href="{{ route('ttd-perawat.create') }}"> 
                                                    <i class="fas fa-signature"></i> Tanda Tangan
                                                </a>
                                                @endif --}}
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
