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
                <div class="breadcrumb-item active"><a href="{{ route('poliMata.indexDokter') }}">Poli</a></div>
                <div class="breadcrumb-item"><a href="{{ route('poliMata.indexDokter') }}">Mata</a></div>
                <div class="breadcrumb-item">Dokter</div>
            </div>
        </div>

        <div class="section-body">
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
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $data)
                                <tr>
                                    <td>
                                        <span class="badge badge-pill badge-success">{{ $loop->iteration }}</span>
                                    </td>
                                    <td>{{$data->NO_MR}}</td>
                                    <td>{{$data->NAMA_PASIEN}}</td>
                                    <td>{{$data->ALAMAT}}</td>
                                    <td width="20%">
                                        @if($surat->cekSurat($data->NO_REG) == true)
                                        <a href="{{ route('edit.suratSakit',['noReg'=> $data->NO_REG]) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil"></i> Edit Surat Sakit</a> 
                                        <a href="{{ route('cetak.suratSakit', [$data->NO_REG]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Cetak Surat</a>
                                        @else
                                        <a href="{{ route('add.suratSakit',['noReg'=> $data->NO_REG]) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil"></i> Surat Sakit</a>
                                        @endif
                                        
                                        @if($surat->cekSkd($data->NO_REG) == true)
                                            <a href="{{ route('edit.SKD',['noReg'=> $data->NO_REG]) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil"></i>Edit SKD</a>
                                            <a href="{{ route('cetak.SKD', [$data->NO_REG]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Cetak SKD</a>
                                        @else
                                            <a href="{{ route('add.SKD',['noReg'=> $data->NO_REG]) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil"></i> SKD</a>
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
        window.location.href = "{{ route('poliMata.index') }}";
    }
</script>

@endpush