@extends('layouts.app')

@section('title', 'Default Layout')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Antrean</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kunjungan</a></div>
                <div class="breadcrumb-item">Antrean</div>
            </div>
        </div>

        <div class="section-body">
            <form id="filterForm" action="" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kode_dokter">Pilih Dokter</label>
                            <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                <option value="" selected disabled>-- silahkan pillih --</option>
                                <option value="">ds</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tanggal">Tanggal <small>(kosongkan jika filter tanggal saat ini)</small></label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="">
                        </div>
                    </div>
                    <div class="col-md-4 filter-buttons">
                        <div class="form-group d-flex align-items-end">
                            <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-filter"></i> Filter</button>
                            <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">
                    <h4>Antrean</h4>
                </div>
                <div class="card-body">
                    <table class="table-striped table" id="table-1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Reg</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">NIK</th>
                                <th scope="col">No MR</th>
                                <th scope="col">Medis</th>
                                <th scope="col">Jenis Pasien</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            ?>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->No_Reg }}</td>
                                <td>{{ $item->Nama_Pasien }}</td>
                                <td>{{ $item->HP2 }}</td>
                                <td>{{ $item->No_MR }}</td>
                                <td>
                                    @if ($item->Medis == 'RAWAT JALAN')
                                    <div class="badge badge-success">RJ</div>
                                    @else
                                    <div class="badge badge-info">RI</div>
                                    @endif
                                </td>
                                <td>{{ $item->KODEREKANAN }}</td>
                                <td width="10%">
                                    <a href="http://" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"></i></a>
                                    <a href="http://" class="btn btn-sm btn-outline-primary">sync</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<!-- Page Specific JS File -->
@endpush