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
                <div class="breadcrumb-item">Fisioterapi Berkas Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="alkes" data-toggle="tab" href="#alkes2" role="tab" aria-controls="alkes2" aria-selected="true">Alat Kesehatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="hargaAlkes" data-toggle="tab" href="#hargaAlkes2" role="tab" aria-controls="hargaAlkes2" aria-selected="false">Harga Alat Kesehatan</a>
                        </li>

                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                        <!-- Tab 1 alkes -->
                        <div class="tab-pane fade show active" id="alkes2" role="tabpanel" aria-labelledby="alkes">
                            <div class="card-header">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-alkes">
                                    <i class="fas fa-plus"></i> Alkes
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table table-bordered" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alat Kesehatan</th>
                                            <th>Create By</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($masterAlkes as $alkes)            
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$alkes->nama_alat}}</td>
                                            <td>{{$alkes->created_by}}</td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-master-alkes{{ $alkes->id }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>

                                                <form id="delete-form-{{$alkes->id}}" action="{{ route('masterAlkes.destroy', $alkes->id) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-danger btn-sm" confirm-delete="true" data-menuId="{{$alkes->id}}" href="#"><i class="fas fa-trash"></i> Hapus</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
            
                        <!-- Tab 2 fisioterapi -->
                        <div class="tab-pane fade" id="hargaAlkes2" role="tabpanel" aria-labelledby="hargaAlkes">
                            <div class="card-header">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-harga-alkes">
                                    <i class="fas fa-plus"></i> Harga Alkes
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table table-bordered" id="table-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Alat</th>
                                            <th>Ukuran</th>
                                            <th>Harga</th>
                                            <th>Create By</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($masterHargaAlkes as $row)
                                        <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>{{$row->nama_alat}}</td>
                                              <td>{{$row->ukuran}}</td>
                                              <td>Rp. {{$row->harga}}</td>
                                              <td>{{$row->created_by}}</td>
                                              <td>
                                                <a href="#" data-toggle="modal" data-target="#modal-edit-harga-alkes{{ $row->id }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>

                                                <form id="delete-form-harga-alkes-{{$row->id}}" action="{{ route('masterHargaAlkes.destroy', $row->id) }}" method="POST" style="display: none;">
                                                    @method('delete')
                                                    @csrf
                                                </form>
                                                <a class="btn btn-danger btn-sm" confirm-delete="true" data-menuId="{{$row->id}}" href="#"><i class="fas fa-trash"></i> Hapus</a>
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
    </section>
</div>

<!-- modal edit alkes -->
@foreach ($masterAlkes as $alkes)
<div class="modal fade" id="modal-edit-master-alkes{{$alkes->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Alat Kesehatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('masterAlkes.update', $alkes->id) }}" method="POST">
                    @csrf
                    @method('put')
                    
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Alat Kesehatan</label>
                            <input type="text" name="nama_alat" class="form-control @error('nama_alat')  is-invalid @enderror" value="{{$alkes->nama_alat}}">
                            @error('nama_alat')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
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


<!-- modal add alkes -->
<div class="modal fade" id="modal-add-alkes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alat Kesehatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('masterAlkes.store') }}" method="POST">
            @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Alat Kesehatan</label>
                            <input type="text" name="nama_alat" class="form-control @error('nama_alat')  is-invalid @enderror">
                            @error('nama_alat')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
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


<!-- modal edit harga alkes -->
@foreach ($masterHargaAlkes as $row)
<div class="modal fade" id="modal-edit-harga-alkes{{$row->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Harga Alkes</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('masterHargaAlkes.update', $row->id) }}" method="POST">
                    @csrf
                    @method('put')
                    
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" name="ukuran" class="form-control @error('ukuran')  is-invalid @enderror" value="{{$row->ukuran}}">
                            @error('ukuran')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="harga" value="{{$row->harga}}" id="harga" placeholder="Masukkan hanya angka">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                            </div>
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


<!-- modal add harga -->
<div class="modal fade" id="modal-add-harga-alkes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Harga Alat Kesehatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="{{ route('masterHargaAlkes.store') }}" method="POST">
            @csrf
                <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama Alat Kesehatan</label>
                            <select name="id_alkes" id="id_alkes" class="form control select2 @error('nama_diagnosis_fungsi')  is-invalid @enderror">
                            <option value="" disabled selected>Pilih Alat</option>
                                @foreach ($masterAlkes as $row)   
                                <option value="{{$row->id}}">{{$row->nama_alat}}</option>
                                @endforeach

                            </select>
                            @error('nama_diagnosis_fungsi')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" name="ukuran" id="ukuran" class="form-control">
                            @error('ukuran')
                            <span class="text-danger" style="font-size: 12px;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="harga" value="" id="harga" placeholder="Masukkan hanya angka">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                </div>
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

@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('berkas.fisio') }}";
    }
</script>



<script>
    $(document).ready(function() {
    // Persist selected tab
    var selectedTab = localStorage.getItem('selectedTab') || '#spkfr2';
    $('#myTab2 a[href="' + selectedTab + '"]').tab('show');

    $('#myTab2 a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr('href');
        localStorage.setItem('selectedTab', target);
        
        // Initialize DataTables for table-3 when the tab is shown
        if (target === '#alkes2' && !$.fn.DataTable.isDataTable('#table-3')) {
            $('#table-3').DataTable();
        }
    });

    // Initialize DataTables
    $('#table-1').DataTable();
    $('#table-2').DataTable();
});
</script>

<script>

    $(document).ready(function() {
        $('#formAlkes input').on('keypress', function(event) {
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

<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        var table = $('#table-2').DataTable();
    
        // Event delegation untuk tombol delete
        $('#table-2').on('click', '[confirm-delete="true"]', function(event) {
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
                    var form = $('#delete-form-harga-alkes-' + menuId);
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