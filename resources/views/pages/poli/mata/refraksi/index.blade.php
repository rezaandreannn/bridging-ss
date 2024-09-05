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
                <div class="breadcrumb-item active"><a href="{{ route('rj.dokter') }}">Pemeriksaan Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.dokter') }}">Poli</a></div>
                <div class="breadcrumb-item">Mata</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                {{-- <form id="filterForm" action="{{ route('transaksi_fisio.fisio') }}" method="get"> --}}
                <form id="filterForm" action="" method="get">
                    <div class="card-header">
                        <h4>Poli Mata</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="section-title">Pilih Dokter</div>
                                <div class="input-group">
                                    <select class="form-control select2" name="kode_dokter" >
                                        <option value="" selected disabled>-- Pilih Dokter --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->Kode_Dokter }}" {{ request('kode_dokter') == $dokter->Kode_Dokter ? 'selected' : '' }}>{{ $dokter->Nama_Dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                        <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No Antrian</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $data)
                                <tr>
                                    <td>
                                        <span class="badge badge-pill badge-success">{{ $data->nomor_antrean }}</span>
                                    </td>
                                    <td>{{$data->no_mr}}</td>
                                    <td>{{$data->nama_pasien}}</td>
                                    <td>{{$data->Alamat}}</td>
                                    <td>@if($data->FS_STATUS == '')
                                        <span class="badge badge-pill badge-warning">Perawat</span>
                                        @elseif($data->FS_STATUS == 1)
                                        <span class="badge badge-pill badge-danger">Dokter</span>
                                        @elseif($data->FS_STATUS == 2)
                                        @if($data->FS_TERAPI == '' or $data->FS_TERAPI == '-')
                                        <span class="badge badge-pill badge-primary">Farmasi</span>
                                        @else
                                        <span class="badge badge-pill badge-success">Selesai</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td width="20%">
                                        @if($data->FS_STATUS == 1)
                                            @if($poliMata->cekRefraksi($data->No_Reg) == true)
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-edit{{$data->No_Reg}}">
                                                <i class="fas fa-plus"></i> Edit
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add-refraksi">
                                                <i class="fas fa-plus"></i> Entry
                                            </button>
                                            @endif
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
<!-- Tambah Data -->
<div class="modal fade" id="modal-add-refraksi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('poliMata.refraksiStore') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Visus</label>
                                <input type="hidden" name="NO_REG" class="form-control" value="{{ $biodata->No_Reg ??''}}" readonly>
                                <div class="col-md-12">
                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="VISUS_VOD" class="mr-2 mt-2">
                                                OD
                                            </label>
                                            <input type="text" placeholder="Inputan Mata Kanan" class="form-control" name="VISUS_OD" id="VISUS_OD">                                          
                                        </div>
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="VISUS_VOS" class="mr-2 mt-2">
                                                OS
                                            </label>
                                            <input type="text" placeholder="Inputan Mata Kiri" class="form-control" name="VISUS_OS" id="VISUS_OS">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NCT</label>
                                <div class="col-md-12">
                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="NCT_TOD" class="mr-2 mt-2">
                                                TOD
                                            </label>
                                            <input type="text" placeholder="Inputan Mata Kanan" class="form-control" name="NCT_TOD" id="NCT_TOD">
                                        </div>
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="NCT_TOS" class="mr-2 mt-2">
                                                TOS
                                            </label>
                                            <input type="text" placeholder="Inputan Mata Kiri" class="form-control" name="NCT_TOS" id="NCT_TOS">
                                        </div>
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

{{-- Edit Data --}}
@foreach ($refraksi as $data)
<div class="modal fade" id="modal-edit{{$data->NO_REG}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('poliMata.refraksiUpdate', $data->NO_REG) }}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Visus</label>
                                <div class="col-md-12">
                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="VISUS_OD" class="mr-2 mt-2">
                                                OD
                                            </label>
                                            <input type="text" placeholder="Inputan Mata Kanan" value="{{$data->VISUS_OD}}" class="form-control" name="VISUS_OD"  id="VISUS_OD">
                                        </div>
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="VISUS_OS" class="mr-2 mt-2">
                                                OS
                                            </label>
                                            <input type="text" placeholder="Inputan Mata Kiri"  value="{{$data->VISUS_OS}}" class="form-control" name="VISUS_OS" id="VISUS_OS" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>NCT</label>
                                <div class="col-md-12">
                                    <div class="form-group" style="display: flex; flex-direction: row;">
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="NCT_TOD" class="mr-2 mt-2">
                                                TOD
                                            </label>
                                            <input type="text" id="NCT_TOD" placeholder="Inputan Mata Kanan"  value="{{$data->NCT_TOD}}" class="form-control" name="NCT_TOD">
                                        </div>
                                        <div class="input-group" style="margin-right: 10px;">
                                            <label for="NCT_TOS" class="mr-2 mt-2">
                                                TOS
                                            </label>
                                            <input type="text" id="NCT_TOS" placeholder="Inputan Mata Kiri" value="{{$data->NCT_TOS}}" class="form-control" name="NCT_TOS">
                                        </div>
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

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('poliMata.index') }}";
    }
</script>

<script>
    document.getElementById('VISUS_OS').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('VISUS_OD').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('NCT_TOD').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('NCT_TOS').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

@endpush