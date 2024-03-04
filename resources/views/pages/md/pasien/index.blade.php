@extends('layouts.app')

@section('title', 'Default Layout')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Master Patient Index (MPI)</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item">Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <form id="filterForm" action="" method="get">
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="No_mr">No MR</label>
                            <input type="text" class="form-control" id="No_mr" name="no_mr" value="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <div class="form-group">
                            <label for="bpjs">BPJS</label>
                            <input type="text" class="form-control" id="bpjs" name="no_bpjs" value="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 filter-buttons">
                        <div class="form-group d-flex align-items-end">
                            <button type="submit" class="btn btn-sm btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-filter"></i> Filter</button>
                            <button type="button" class="btn btn-sm btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header">
                    <h4>Master Patient Index (MPI)</h4>
                </div>
                <div class="card-body">
                    <table class="table-striped table" id="table-1">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">No MR</th>
                                <th scope="col" width="30%">Nama Pasien</th>
                                <th scope="col">BPJS</th>
                                <th scope="col">Nik</th>
                                <th scope="col">No Hp</th>
                                <th scope="col">Tanggal Lahir</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            ?>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class="badge badge-success">{{ $item['no_mr'] }}</td>
                                <td width="30%">{{ $item['nama_pasien'] }}</td>
                                <td>{{ $item['no_bpjs'] }}</td>
                                <td>{{ $item['nik'] }}</td>
                                <td>{{ $item['no_hp'] }}</td>
                                <td>{{ date('d-m-Y', strtotime($item['tanggal_lahir'])) }}</td>
                                <td>
                                    @if ($item['jenis_kelamin'] == 'L')
                                    <div>L</div>
                                    @else
                                    <div>P</div>
                                    @endif
                                </td>
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

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('pasien.index') }}";
    }
</script>
<!-- <script>
    function submitForm() {
        var formData = $('#filterForm').serialize(); // Ambil data formulir
        var url = '/md/pasien'; // Ganti URL sesuai kebutuhan Anda

        // Hanya kirim permintaan jika ada nilai yang dimasukkan
        if (formData !== '') {
            window.location.href = url + '?' + formData; // Kirim permintaan GET
        }
    }
</script> -->

<!-- Page Specific JS File -->
@endpush