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
                <div class="breadcrumb-item active"><a href="{{ route('list-pasien.index') }}">Fisioterapi</a></div>
                <div class="breadcrumb-item">Fisioterapi Berkas Pasien</div>
            </div>
        </div>

        <div class="section-body">
             
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-header">
                        <h4>Data Pasien Fisioterapi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="No_mr">No MR</label>
                                    <input type="number" class="form-control" id="no_mr" name="no_mr" value="{{request('no_mr')}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-2 filter-buttons">
                                <div class="form-group d-flex align-items-end">
                        
                                    <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Cari</button>
                                    <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-trash"></i> Reset</button>
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
                                    <th>Tanggal</th>
                                    <th>NO RM dan Nama</th>
                                    <th>Kode Reg</th>
                                    <th>Dokter</th>
                                    <th>Layanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($data as $pasien)
                                @php
                                $tanggal = date('d-m-Y', strtotime($pasien->Tanggal));
                                @endphp
                               <tr>
                                    <td>{{ $tanggal; }}</td>
                                    <td><color style="color: red">({{$pasien->No_MR}})</color> - {{$pasien->Nama_Pasien}} </td>
                                    <td>{{$pasien->No_Reg}}</td>
                                    <td>{{$pasien->Nama_Dokter}}</td>
                                    <td>{{$pasien->Medis}}</td>
                                    <td width="20%">  
                                        @if($pasien->Kode_Dokter == '151')
                                        @if($berkasfisio->cekAsesmenDokter($pasien->No_Reg) == true)
                                        <a href="{{ route('berkas.cetakRmFisio', ['no_reg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Asesmen Dokter</a>
                                        @endif
                                        @endif
                                        <a href="{{ route('berkas.cppt', ['no_mr' => $pasien->No_MR]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Cppt</a>
                                        {{-- <a href="{{ route('berkas.alat', ['no_mr' => $pasien->No_MR]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Pelayanan Alat</a> --}}
                                        {{-- <a href="{{ route('berkas.rujukan') }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Rujukan</a>
                                        <a href="{{ route('berkas.informed') }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Informed</a> --}}
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
        window.location.href = "{{ route('berkas.fisio') }}";
    }
</script>

@endpush