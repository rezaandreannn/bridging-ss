@extends('layouts.app')

@section('title', 'Default Layout')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Rujukan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Kunjungan</a></div>
                <div class="breadcrumb-item">Rujukan</div>
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
                    <h4>Rujukan</h4>
                </div>
                <div class="card-body">
                    <table class="table-striped table" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No MR</th>
                                <th scope="col">Nama Pasien</th>
                                <th scope="col">NIK</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">BPJS</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            ?>
                            @foreach ($data->data as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->No_MR }}</td>
                                <td>{{ $data->Nama_Pasien }}</td>
                                <td>{{ $data->HP2 }}</td>
                                <td>{{ $data->Tanggal }}</td>
                                <td>{{ $data->No_Identitas }}</td>
                                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
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

<!-- Page Specific JS File -->
@endpush