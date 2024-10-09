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
                        <div class="section-title">masukkan no mr</div>
                        <div class="form-group col-md-12">
                            <div class="input-group mb-3">
                                <div class="col-md-3">
                                   <input type="text" name="no_mr" class="form-control" placeholder="masukkan no mr" @if (request('no_mr')==null) value="" @else value="{{request('no_mr')}}" @endif>
                                </div>
                                {{-- <div class="col-md-3">

                                    <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                        <option value="" selected disabled>--  pilih Dokter--</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">

                                    <input type="date" class="form-control" name="tanggal" @if (request('tanggal')==null) value="{{date('Y-m-d')}}" @else value="{{request('tanggal')}}" @endif placeholder="" aria-label="">
                            
                                </div> --}}
                              <div class="col-md-3">
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
                                    <th scope="col">Tanggal Kunjungan</th>
                                    <th scope="col">Nama_pasien</th>
                                    <th scope="col">Dokter</th>
                                    <th scope="col">Layanan</th>
                                    <th scope="col">Catatan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $dokterModel = new App\Models\RajalDokter();
                                @endphp
                                @foreach ($history as $data)
                                    @php
                                        $tanggal = date('d-m-Y', strtotime($data->TANGGAL));
                                    @endphp
                                <tr>
                                    <td>{{ $tanggal; }}</td>
                                    <td>{{$data->NAMA_PASIEN}}</td>
                                    <td>{{$data->NAMA_DOKTER}}</td>
                                    <td>{{$data->SPESIALIS}}</td>
                                    <td>
                                        @if ($dokterModel->getDataResep($data->NO_REG) == true)
                                            <a href="{{ route('rj.dokterResep', [$data->NO_REG])  }}">Resep</a>
                                        @endif
                                        @if ($dokterModel->getDataLab($data->NO_REG) == true)
                                            <a href="{{ route('rj.dokterLab', [$data->NO_REG])  }}">Hasil Lab</a>
                                        @endif
                                    </td>
                                   <td>
                                        @if($data->KODE_RUANG == '')
                                            <span class="badge badge-pill badge-primary">Rawat Jalan</span>
                                        @elseif($data->KODE_RUANG != '')
                                            <span class="badge badge-pill badge-success">Rawat Inap</span>
                                        @endif
                                    </td>
                                    <td width="20%">

                                        {{-- @if($data->SPESIALIS == 'SPESIALIS REHABILITASI MEDIK')
                                        @if ($cekAsesmenFisio->cekAsesmenFisio($data->NO_REG)==true)
                                        <a href="{{ route('fisio.copyRiwayat', ['noRegBaru'=>$biodatas->NO_REG,'noRegLama' => $data->NO_REG, 'noMr'=> $data->NO_MR]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Copy Riwayat</a>
                                        @endif
                                        @endif   --}}

                                        @if($data->KODE_RUANG == '')

                                        @if($data->SPESIALIS == 'SPESIALIS REHABILITASI MEDIK')
                                        <a href="{{ route('berkas.cetakRmFisio', ['no_reg' => $data->NO_REG]) }}" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-download"></i> RM SPKFR</a>
                                        @elseif ($data->SPESIALIS == 'FISIOTERAPI')
                                        <a href="{{ route('cppt.cetakCpptRiwayat', [
                                    'no_reg' => $data->NO_REG,
                                    'no_mr' => $data->NO_MR]) }}" class="btn btn-sm btn-warning" target="_blank"><i class="fas fa-download"></i>Lihat CPPT</a>

                                        @else
                                        <a href="{{ route('rj.rmDokter', ['noReg' => $data->NO_REG, 'noMR'=> $data->NO_MR]) }}" class="btn btn-sm btn-success" target="_blank"><i class="fas fa-download"></i> RM</a>

                                        @endif

                                        @elseif($data->KODE_RUANG != '')
                                            <a href="">Detail</a>
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
        window.location.href = "{{ route('riwayatPemeriksaanPasien.dokter') }}";
    }
</script>

@endpush