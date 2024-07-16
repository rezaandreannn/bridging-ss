@extends('layouts.app')

@section('title', $title ?? '')

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
            <h1>{{ $title ?? ''}}</h1>
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
                        <div class="section-title">Masukkan No Rekam Medis</div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="nomr" placeholder="" aria-label="">
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                                <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                              </div>
                            </div>
                          </div>

                    </div>
                </form>
            </div>
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <a href="#">tes</a>
                    </div>
                    <div class="author-box-job"><b></div>
                    <div class="author-box-description">
                        <div class="row">
                            <div class="col-md-12">
               
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">No RM</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : 18
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">NIK</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : 18
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Tanggal Lahir</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Jenis Kelamin</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : laki
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">No Hp</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : 08
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : 
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-sm-none"></div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Kode Reg</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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
        window.location.href = "{{ route('rj.index') }}";
    }
</script>

@endpush