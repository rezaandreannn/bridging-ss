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
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

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
                <div class="breadcrumb-item active"><a href="{{ route('operasi.template.index') }}">Laporan Operasi</a></div>
                <div class="breadcrumb-item">List</div>
            </div>
        </div>

        <div class="section-body">
            {{-- menampilkan detail dokter --}}

            <div class="card">
                <div class="card-header">
                    <h4>Detail Dokter</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            {{-- Foto Dokter --}}
                            <img src="{{ $doctor->photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($findDoctor->Spesialis ?? 'Dokter') . '&background=random&size=150' }}" alt="Foto Dokter" class="rounded-circle img-fluid" style="width: 150px; height: 150px;">
                        </div>
                        <div class="col-md-8">
                            {{-- Informasi Dokter --}}
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Nama:</div>
                                <div class="col-sm-8">{{ $findDoctor->Nama_Dokter ?? '-' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Spesialisasi:</div>
                                <div class="col-sm-8">{{ $findDoctor->Spesialis ?? '-' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Kode:</div>
                                <div class="col-sm-8">{{ $findDoctor->Kode_Dokter ?? '-' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">No. Telepon:</div>
                                <div class="col-sm-8">{{ $findDoctor->HP1 ?? '-' }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-4 font-weight-bold">Email:</div>
                                <div class="col-sm-8">{{ $findDoctor->Email ?? '-' }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Template Laporan Operasi</h4>
                    <a href="#" class="btn btn-primary btn-icon icon-left" data-toggle="modal" data-target="#modal-add-template">
                        <i class="fas fa-plus"></i> Tambah Template
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table table-bordered" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama / Macam Tindakan</th>
                                    <th scope="col">Template Laporan Operasi</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($TemplateByCodeDoctor as $template)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $template->macam_operasi }}</td>
                                    <td>{!! $template->laporan_operasi !!}</td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-edit-template{{ $template->id }}">
                                            <i class="fas fa-pencil-alt m-2"></i>
                                        </a>
                                        <form id="delete-form-{{$template->id}}" action="{{ route('operasi.template.destroy', $template->id) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <!-- Delete link -->
                                        <a href="#" confirm-delete="true" data-menuId="{{$template->id}}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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


<div class="modal fade" id="modal-add-template">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Template</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('operasi.template.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <input type="hidden" name="kode_dokter" value="{{ $findDoctor->Kode_Dokter}}" />
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama / Macam Operasi</label>
                                <input type="text" name="macam_operasi" value="{{ old('macam_operasi')}}" class="form-control @error('macam_operasi') is-invalid @enderror">
                            </div>
                            @error('macam_operasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Template Laporan Operasi</label>
                                <textarea name="laporan_operasi" class="form-control summernote"></textarea>
                            </div>
                            @error('laporan_operasi')
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


@foreach ($TemplateByCodeDoctor as $template)
<div class="modal fade" id="modal-edit-template{{ $template->id }}" tabindex="-1" role="dialog" aria-labelledby="edit-template-label{{ $template->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('operasi.template.update', $template->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-template-label{{ $template->id }}">Edit Template Operasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kode_dokter" value="{{ $findDoctor->Kode_Dokter }}">
                    
                    <div class="form-group">
                        <label for="macam-operasi-{{ $template->id }}">Nama / Macam Operasi</label>
                        <input type="text" id="macam-operasi-{{ $template->id }}" name="macam_operasi" 
                               class="form-control @error('macam_operasi') is-invalid @enderror" 
                               value="{{ $template->macam_operasi }}">
                        @error('macam_operasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="laporan-operasi-{{ $template->id }}">Template Laporan Operasi</label>
                        <textarea name="laporan_operasi" class="form-control summernote @error('laporan_operasi') is-invalid @enderror">{{ $template->laporan_operasi }}</textarea>
                        @error('laporan_operasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300
            , minHeight: null
            , maxHeight: null
            , focus: true
            , placeholder: 'Tulis sesuatu di sini...'
            , toolbar: [
                ['font', ['bold', 'italic', 'underline']]
                , ['color', ['color']]
                , ['height', ['height']]
                , ['view', ['fullscreen', 'help']]
            ]
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
                , text: "Menghapus data ini!"
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
