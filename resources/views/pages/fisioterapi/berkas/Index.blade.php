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
                <div class="breadcrumb-item">Berkas Harian Fisioterapi</div>
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
                                    <input type="number" class="form-control" id="no_mr" name="no_mr">
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
{{-- 
            @if ($data != null)

            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <a href="#">{{ $biodatas->NAMA_PASIEN}} - ({{ $biodatas->NO_MR}})</a>
                    </div>
                    <div class="author-box-job"><b></div>
                    <div class="author-box-description">
                        <div class="row">
                            <div class="col-md-12">
               
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">NIK</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : {{ $biodatas->HP2}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Tanggal Lahir</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : {{ date('d-m-Y', strtotime($biodatas->TGL_LAHIR))}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Jenis Kelamin</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : @if ($biodatas->JENIS_KELAMIN == 'L')
                                        Laki-Laki
                                        @else
                                        Perempuan
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">No Hp</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : {{ $biodatas->HP1}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : {{ $biodatas->ALAMAT}}
                                    </div>
                                </div>
                           
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-sm-none"></div>
            </div>
            @else
            @endif --}}

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
                                    <td>  <a href="" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Entry</a></td>
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