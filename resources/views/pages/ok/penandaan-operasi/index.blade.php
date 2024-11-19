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
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Tindakan</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Ruangan</th>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penandaans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="font-weight-bold">{{ $data->no_mr }}</span></td>
                                    <td>{{$data->nama_pasien}}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->nama_tindakan }}</td>
                                    <td>{{ $data->nama_dokter }}</td>
                                    <td>{{ $data->ruang_operasi}}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#gambarModal{{ $data->id }}" class="badge badge-success">Detail</a>
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
                                                {{-- <a class="dropdown-item has-icon" href="{{ route('operasi.penandaan.edit', ['id' => $data->id] )}}"><i class="fas fa-pencil-alt"></i>Edit Tandai Lokasi </a> --}}
                                                {{-- jika sudah diinput bisa diunduh --}}
                                                <a class="dropdown-item has-icon" href=""><i class="fas fa-file-download"></i> Unduh</a>
                                                {{-- Hapus --}}
                                                <form id="delete-form-{{$data->id}}" action="{{ route('operasi.booking.destroy', $data->id) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <!-- Delete link -->
                                                <a class="dropdown-item has-icon" href="#" confirm-delete="true" data-menuId="{{$data->id}}">
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

@foreach ($penandaans as $data)
<div class="modal fade" id="gambarModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $data->nama_pasien }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Tindakan: {{ $data->nama_tindakan }}</p>
                <img id="gambarZoom{{ $data->id }}" src="{{ asset('storage/operasi/' . $data->gambar) }}" class="img-fluid" alt="Gambar Pengguna"  style="transition: transform 0.3s ease; cursor: zoom-in;">
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

@endpush
