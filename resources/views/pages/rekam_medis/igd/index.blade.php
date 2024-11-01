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
                <div class="breadcrumb-item"><a href="#">Riwayat Rekam Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rm.igd') }}">Rekam Medis IGD</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="section-title">Masukkan No Rekam Medis</div>
                        <div class="form-group col-md-6">
                            <div class="input-group mb-3">
                              <input type="number" class="form-control" name="nomr" value="{{request('nomr')}}" placeholder="" aria-label="">
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                                <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                              </div>
                            </div>
                          </div>
                    </div>
                </form>
            </div>
            @if($cek_mr != 'false')
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-name">
                        <a href="#">{{$biodatas->NAMA_PASIEN}}</a>
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
                                        : {{$biodatas->NO_MR}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">NIK</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : {{$biodatas->HP2}}
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
                                        : {{$biodatas->HP1}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-8">
                                        : {{$biodatas->ALAMAT}}
                                    </div>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-sm-none"></div>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Kode Reg</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Cara Masuk</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPasien as $pasien)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ date('d-M-Y', strtotime($pasien->Tanggal))}}</td>
                                    <td>{{$pasien->No_Reg}}</td>
                                    <td>{{$pasien->Nama_Dokter}}</td>
                                    <td><b>IGD</b></td>
                                    <td>
                                        {{$pasien->Medis}}
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('rm.berkasIgd', ['noReg' => $pasien->No_Reg]) }}" data-toggle="modal" data-target="#modal-edit{{$pasien->No_Reg}}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> download RM</a> --}}
                                        <a  data-toggle="modal" data-target="#modal-edit{{$pasien->No_Reg}}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> download RM</a>

                                        @if($pasien->D_PLANNING == 'Rujuk Internal')
                                        <a href="#" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujuk Internal</a>
                                        @endif
                                        
                                        @if($pasien->FS_TERAPI != '')
                                        <a href="{{ route('rm.cetakResepIGD', ['nomr' => $pasien->No_MR,'noReg'=> $pasien->No_Reg]) }}" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep</a>
                                        @endif

                                        @if($pasien->lab != '')
                                        <a href="{{ route('rm.cetakLabIGD', ['nomr' => $pasien->No_MR,'noReg'=> $pasien->No_Reg]) }}" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Lab</a>
                                        @endif
                                        
                                        @if($pasien->rad != '')
                                        <a href="{{ route('rm.cetakRadIGD', ['nomr' => $pasien->No_MR,'noReg'=> $pasien->No_Reg]) }}" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Radiologi</a>
                                        @endif

                                        <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-download"></i> Lembar Verif</a>
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

@foreach ($dataPasien as $pasien)
<div class="modal fade" id="modal-edit{{$pasien->No_Reg}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Download Berkas RM IGD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Triase</td>
                                    <td> <a href="{{ route('rm.triase', ['noReg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-warning"><i class="fas fa fa-edit"></i> Download</a></td>
                                </tr>
                                <tr>
                                    <td>Asesmen Medis IGD</td>
                                    <td> <a href="{{route('rm.asesmenMedisIgd',['noReg' => $pasien->No_Reg])}}" class="btn btn-sm btn-warning"><i class="fas fa fa-download"></i> download</a></td>
                                </tr>
                                <tr>
                                    <td>Asesmen Keperawatan</td>
                                    
                                    <td> <a href="{{route('rm.asesmenPerawatIgd',['noReg' => $pasien->No_Reg])}}" class="btn btn-sm btn-warning"><i class="fas fa fa-download"></i> download</a></td>
                                </tr>
                                <tr>
                                    <td>Asesmen Kebidanan</td>
                                    <td> <a href="" class="btn btn-sm btn-warning"><i class="fas fa fa-download"></i> download</a></td>
                                </tr>
                                <tr>
                                    <td>Asesmen Neonatus</td>
                                    <td> <a href="" class="btn btn-sm btn-warning"><i class="fas fa fa-download"></i> download</a></td>
                                </tr>
                                <tr>
                                    <td>Download Semua</td>
                                    <td> <a href="{{ route('rm.berkasIgd', ['noReg' => $pasien->No_Reg]) }}" class="btn btn-sm btn-warning"><i class="fas fa fa-download"></i> download</a></td>
                                </tr>
               
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="card-footer text-left">
                <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>
@endforeach
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
        window.location.href = "{{ route('rm.igd') }}";
    }
</script>

@endpush