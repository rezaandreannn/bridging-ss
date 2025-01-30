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
                    <form id="filterForm" action="" method="get">
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="section-title">Pilih Tanggal</div>
                                <div class="input-group">
                                    <input type="date" class="form-control" name="tanggal" @if (request('tanggal')==null) value="{{date('Y-m-d')}}" @else value="{{request('tanggal')}}" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                            <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No Antrian</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasie</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pasien as $data)
                                <tr>
                                    <td>
                                        <span class="badge badge-pill badge-success">{{ $data->Nomor }}</span>
                                    </td>
                                    <td>{{$data->No_MR}}</td>
                                    <td>{{$data->Nama_Pasien}}</td>
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
                                            @if($poliMata->cekDokter($data->No_Reg) == true)
                                            <a href="{{ route('poliMata.assesmenAwalEdit', ['noReg'=> $data->No_Reg]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Edit</a>
                                            @else
                                                @if($poliMata->cekRefraksi($data->No_Reg) == true)
                                                <a href="{{ route('poliMata.assesmenAwal', ['noReg'=> $data->No_Reg, 'NoMr' => $data->No_MR]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Entry</a>
                                                @endif
                                            @endif
                                            @if($poliMata->cekDokter($data->No_Reg) == true)
                                            <a href="{{ route('polimata.cetakRM', ['noReg'=>$data->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> RM</a>
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