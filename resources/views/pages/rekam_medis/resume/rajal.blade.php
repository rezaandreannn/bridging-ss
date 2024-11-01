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
                <div class="breadcrumb-item active"><a href="{{ route('rm.resumeRajal') }}">Berkas Klaim</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rm.resumeRajal') }}">Resume Rawat Jalan</a></div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="section-title">Pilih Dokter dan Tanggal</div>
                        <div class="form-group col-md-12">
                            <div class="input-group mb-3">
                                <div class="col-md-6">
                                    <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                        <option value="" selected disabled>-- silahkan pillih --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="tanggal" @if (request('tanggal')==null) value="{{date('Y-m-d')}}" @else value="{{request('tanggal')}}" @endif placeholder="" aria-label="">
                                </div>
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                                      <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
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
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPasien as $pasien)   
                                <tr>
                                    <td width="5%">
                                        <div class="badge badge-success">{{$pasien->Nomor}}</div>
                                    </td>
                                    <td width="20%">{{$pasien->Nama_Pasien}}</td>
                                    <td width="25%">{{$pasien->Alamat}}</td>
                                    <td width="10%">
                                        @if ($pasien->Medis == 'RAWAT JALAN')
                                        <div class="badge badge-primary">{{$pasien->Medis}}</div>
                                        @else
                                        <div class="badge badge-success">{{$pasien->Medis}}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pasien->Medis == 'RAWAT INAP')
                                            <a href="{{ route('rm.ranap', $pasien->No_Reg) }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i> Resume Ranap</a>
                                        @endif
                                        @if($pasien->SPESIALIS == 'SPESIALIS MATA')
                                            @if($poliMata->cekDokter($pasien->No_Reg) == true)
                                                <a href="{{ route('polimata.cetakResume', [$pasien->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Resume</a>
                                            @endif
                                        @else
                                            @if($pasien->Medis == 'RAWAT JALAN')
                                                <a href="{{ route('rm.rajal', $pasien->No_Reg) }}" class="btn btn-sm btn-success"><i class="fas fa-info-circle"></i> Resume Rajal</a>
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
        window.location.href = "{{ route('rm.harian') }}";
    }
</script>

@endpush