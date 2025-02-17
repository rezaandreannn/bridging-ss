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
                <div class="breadcrumb-item active"><a href="#">Riwayat Rekam Medis</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rm.bymr') }}">Berkas Rekam Medis</a></div>
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
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPasien as $pasien)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ date('Y-m-d', strtotime($pasien->Tanggal))}}</td>
                                    <td>{{$pasien->No_Reg}}</td>
                                    <td>{{$pasien->Nama_Dokter}}</td>
                                    <td>
                                        @if ($pasien->Medis == 'RAWAT JALAN')
                                        <div class="badge badge-primary">{{$pasien->Medis}}</div>
                                        @else
                                        <div class="badge badge-success">{{$pasien->Medis}}</div>
                                        @endif

                                        </td>
                                    <td><b>{{$pasien->Nama_Ruang}}</b></td>
                                    <td>
                                        @if($pasien->KodeRekanan == '032')
                                        <a href="#" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Verif</a>
                                        @endif
                                        
                                        @if($pasien->Medis == 'RAWAT JALAN')
                                        <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-download"></i> Scan</a>
                                            @switch($pasien->Nama_Dokter)
                                                @case('FISIOTERAPI')
                                                    {{-- No action needed, or add a message if required --}}
                                                    @break
                                            
                                                @case('SPESIALIS MATA')
                                                    <a href="{{ route('polimata.cetakRM', [$pasien->No_Reg]) }}" class="btn btn-sm btn-success">
                                                        <i class="fas fa-download"></i> RM
                                                    </a>
                                                    @break
                                                @default
                                                    <a href="{{ route('rj.rmDokter', ['noReg' => $pasien->No_Reg, 'noMR'=> $pasien->No_MR]) }}" class="btn btn-sm btn-warning">
                                                        <i class="fas fa-download"></i> RM
                                                    </a>
                                            @endswitch
                                        @else
                                       
                                        <a href="{{ route('rm.detail', $pasien->No_Reg) }}" class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i> Detail</a>
                                        @endif
                                        

                                        @if($pasien->Medis == 'RAWAT INAP')
                                            <a href="{{ route('rm.ranap', $pasien->No_Reg) }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i> Resume Ranap</a>
                                        @endif
                                        
                                        
                                        @if($pasien->Medis == 'RAWAT JALAN')
                                            <a href="{{ route('rm.rajal', $pasien->No_Reg) }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i> Resume Rajal</a>
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
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

@endpush