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
                <div class="breadcrumb-item active"><a href="{{ route('prabedah.assesmen-prabedah.index') }}">Laporan Operasi</a></div>
                <div class="breadcrumb-item">List</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" action="" method="GET">       
                        <div class="card-footer text-left">
                            <label for="">Filter tanggal</label>
                            <div class="row">
                                @php
                                    $date = date('Y-m-d');
                                @endphp
                                <div class="form-group col-md-4">
                                    <input type="date" class="form-control" name="tanggal" {{(request('tanggal')==null) ?  $date : $date = request('tanggal') }} value="{{$date}}"  id="datefilter">
                                </div>
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-primary mr-2" style="margin-top: 5px;"><i class="fas fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 5px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered" id="table-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Register</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Nama Pasien</th>
                                            <th scope="col">No MR</th>
                                            <th scope="col">Nama Dokter</th>
                                            <th scope="col">Status Laporan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laporans as $laporan)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$laporan->kode_register}}</td>
                                            <td>{{$laporan->tanggal}}</td>
                                            <td>{{ ucwords(strtolower(trim($laporan->nama_pasien))) }}</td>
                                            <td>{{$laporan->no_mr}}</td>
                                            <td>{{$laporan->nama_dokter}}</td>

                                            <td>
                                                @if (isset($statusLaporanOperasi[$laporan->id]) && $statusLaporanOperasi[$laporan->id] == 'create')
                                                <span class="badge badge-danger">Create</span>
                                                 @else
                                                <span class="badge badge-success">Update</span>
                                                @endif
                                            </td>
                             
                                            <td>  

                                                <div class="dropdown d-inline">
                                                    <a href="#" class="text-primary" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu">
                                                        {{-- Input --}}
                                                        <a class="dropdown-item has-icon" href="{{ isset($statusLaporanOperasi[$laporan->id]) && $statusLaporanOperasi[$laporan->id] == 'create' ? route('laporan.operasi.create', $laporan->kode_register ) : route('laporan.operasi.edit', $laporan->kode_register )}}"> 
                                                            <i class="fas fa-pencil-alt"></i> {{isset($statusLaporanOperasi[$laporan->id]) && $statusLaporanOperasi[$laporan->id] == 'create' ? 'Entry' : 'Edit'}}
                                                        </a>

                                                        {{-- <a class="dropdown-item has-icon" href="{{ route('laporan.operasi.cetak', $laporan->kode_register) }}"> 
                                                            <i class="fas fa-download"></i> Download
                                                        </a> --}}

                                                        @if (isset($statusLaporanOperasi[$laporan->id]) && $statusLaporanOperasi[$laporan->id] != 'create')
                                                        <a class="dropdown-item has-icon" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" href="{{ route('laporan.operasi.cetak', $laporan->kode_register) }}">
                                                                <i class="fas fa-download"></i> Download
                                                            </a>
                                                        @endif

                                                        @if (isset($statusLaporanOperasi[$laporan->id]) && $statusLaporanOperasi[$laporan->id] != 'create')
                                                            <form id="delete-form-{{$laporan->kode_register}}" action="{{ route('laporan.operasi.destroy', $laporan->kode_register )}}" method="POST" style="display: none;">
                                                                @method('delete')
                                                                @csrf
                                                            </form>
                                                            <a class="dropdown-item has-icon" href="#" confirm-delete="true" data-menuId="{{$laporan->kode_register}}"> 
                                                                <i class="fas fa-trash"></i>Hapus
                                                            </a>
                                                        @endif
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

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const images = document.querySelectorAll('img[id^="gambarZoom"]'); // Pilih semua gambar dengan ID yang sesuai

        images.forEach((img) => {
            let scale = 1; // Tingkat zoom awal
            let maxScale = 3; // Zoom maksimal
            let minScale = 1; // Zoom minimal
            let translateX = 0, translateY = 0; // Posisi translasi
            let isDragging = false; // Status drag
            let startX = 0, startY = 0; // Posisi awal drag

            // Zoom dengan scroll
            img.addEventListener('wheel', (e) => {
                e.preventDefault(); // Cegah scroll default

                const zoomDelta = 0.1; // Tingkat perubahan zoom
                if (e.deltaY < 0 && scale < maxScale) {
                    scale += zoomDelta; // Zoom in
                } else if (e.deltaY > 0 && scale > minScale) {
                    scale -= zoomDelta; // Zoom out
                }

                // Terapkan transformasi
                img.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            });

            // Double click untuk zoom in/out
            img.addEventListener('dblclick', () => {
                if (scale === 1) {
                    scale = 2; // Zoom in ke skala tertentu
                    img.style.cursor = 'grab';
                } else {
                    scale = 1; // Reset zoom
                    translateX = 0;
                    translateY = 0;
                    img.style.cursor = 'default';
                }

                // Terapkan transformasi
                img.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
            });

            // Mulai drag
            img.addEventListener('mousedown', (e) => {
                if (scale > 1) {
                    isDragging = true;
                    startX = e.clientX - translateX;
                    startY = e.clientY - translateY;
                    img.style.cursor = 'grabbing';
                }
            });

            // Drag gambar
            img.addEventListener('mousemove', (e) => {
                if (isDragging && scale > 1) {
                    translateX = e.clientX - startX;
                    translateY = e.clientY - startY;

                    // Batasan agar gambar tidak terlalu jauh
                    const maxTranslateX = (img.offsetWidth * (scale - 1)) / 2;
                    const maxTranslateY = (img.offsetHeight * (scale - 1)) / 2;
                    translateX = Math.max(-maxTranslateX, Math.min(maxTranslateX, translateX));
                    translateY = Math.max(-maxTranslateY, Math.min(maxTranslateY, translateY));

                    // Terapkan transformasi
                    img.style.transform = `scale(${scale}) translate(${translateX}px, ${translateY}px)`;
                }
            });

            // Akhiri drag
            img.addEventListener('mouseup', () => {
                if (scale > 1) {
                    isDragging = false;
                    img.style.cursor = 'grab';
                }
            });

            // Hentikan drag jika kursor keluar
            img.addEventListener('mouseleave', () => {
                if (scale > 1) {
                    isDragging = false;
                    img.style.cursor = 'grab';
                }
            });
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
        window.location.href = "{{ route('laporan.operasi.index') }}";
    }
</script>


@endpush
