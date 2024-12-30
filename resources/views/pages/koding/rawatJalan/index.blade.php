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
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Rawat Jalan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Nurse Record</a></div>
                <div class="breadcrumb-item">Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_dokter">Pilih Dokter</label>
                                            <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                                <option value="" selected disabled>-- silahkan pillih --</option>
                                                @foreach ($dokters as $dokter)
                                                <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="kode_dokter">Pilih Dokter</label>
                                            <input type="date" name="tanggal" class="form-control" @if(request('tanggal')!=null) value="{{request('tanggal')}}" @endif placeholder="pilih tanggal">
                                        </div>
                                    </div>
                                </div>
                     
                            </div>
                            <div class="col-md-4 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status Diagnosa</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center" width="5%">
                                        <span class="badge badge-pill badge-success">{{ $item->nomor_antrean }}</span>
                                    </td>
                                    <td>{{ $item->no_mr }}</td>
                                    <td>{{ $item->nama_pasien }}</td>
                                    <td>{{ $item->Alamat }}</td>
                                    <td>
                                        @if ($item->kode_register!=null)
                                        <span class="badge badge-pill badge-success">Icd10 Terisi</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">Icd10 Kosong</span>
                                        @endif

                                    </td>
                                    <td width="25%">
                                        @if ($item->kode_register==null)
                                        <a href="{{ route('koding.add', [$item->No_Reg, $tanggal,$kode_dokter] )}}" class="btn btn-sm btn-warning"><i class="fas fa-notes-medical"></i> Entry Diagnosa</a>
                                        @else
                                        <a href="{{ route('koding.showEdit', $item->No_Reg )}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit Diagnosa</a>
                                        
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
        window.location.href = "{{ route('koding.index') }}";
    }
</script>

@endpush