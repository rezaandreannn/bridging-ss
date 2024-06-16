@extends('layouts.app')

@section('title', 'Pasien')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Indeks Pasien Utama</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Master Data</a></div>
                <div class="breadcrumb-item">Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form id="filterForm" action="" method="get">
                        <div class="row">
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="No_mr">No MR</label>
                                    <input type="text" class="form-control" id="No_mr" name="no_mr" value="{{ request('no_mr') }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" value="{{ request('nik') }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="bpjs">BPJS</label>
                                    <input type="text" class="form-control" id="bpjs" name="no_bpjs" value="{{ request('no_bpjs') }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ request('nama') }}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;">Cari</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"> Hapus</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="" class="btn btn-primary rounded-0">Data Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No MR</th>
                                    <th>Nama</th>
                                    <th>BPJS</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="badge badge-success">{{ $item->no_mr }}</div>
                                    </td>
                                    <td width="30%">{{ $item->nama_pasien }}</td>
                                    <td>{{ $item->no_bpjs }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>
                                        @if ($item->jenis_kelamin == 'L')
                                        <div>L</div>
                                        @else
                                        <div>P</div>
                                        @endif
                                    </td>
                                    <td width="15%">
                                        <a href="{{ route('patient.show', $item->no_mr)}}" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
                                        <a href="http://" class="btn btn-primary">sync</a>
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('patient.index') }}";
    }
</script>

<!-- Page Specific JS File -->
@endpush