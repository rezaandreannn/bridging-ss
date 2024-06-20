@extends('layouts.app')

@section('title', 'Dokter')

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
            <h1>Indeks Dokter Utama</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dokter.index') }}">Master Data</a></div>
                <div class="breadcrumb-item">Dokter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Dokter</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kode Dokter</th>
                                    <th scope="col">Profesi</th>
                                    <th scope="col">Spesialis</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="badge badge-success"> {{ $item->kode_dokter }}</div>
                                    </td>
                                    <td>{{ $item->jenis_profesi }}</td>
                                    <td>{{ $item->spesialis }}</td>
                                    <td>{{ $item->nama_dokter }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td width="15%">
                                        <button class="btn btn-warning" disabled><i class="far fa-edit"></i></button>
                                        <!-- <a href="javascript: void(0)" class="btn btn-warning"><i class="far fa-edit"></i></a> -->
                                        <a href="{{ route('dokter.show', $item->kode_dokter )}}" class="btn btn-info"><i class="fas fa-info-circle"></i></a>
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

<!-- Page Specific JS File -->
<script>
    function disableLink() {
        // Mengakses elemen tautan menggunakan ID
        var link = document.getElementById("myLink");
        // Menghapus atribut 'href' untuk menonaktifkan tautan
        link.removeAttribute("href");
    }
</script>
@endpush