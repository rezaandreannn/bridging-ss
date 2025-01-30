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
                <div class="breadcrumb-item active"><a href="{{ route('poliMata.index') }}">Poli</a></div>
                <div class="breadcrumb-item"><a href="{{ route('poliMata.index') }}">Mata</a></div>
                <div class="breadcrumb-item">Perawat</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card card-primary">
                {{-- <form id="filterForm" action="{{ route('transaksi_fisio.fisio') }}" method="get"> --}}
                <form id="filterForm" action="" method="get">
                    <div class="card-header">
                        <h4>Poli Mata</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="section-title">Pilih Dokter</div>
                                <div class="input-group">
                                    <select class="form-control select2" name="kode_dokter" >
                                        <option value="" selected disabled>-- Pilih Dokter --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->Kode_Dokter }}" {{ request('kode_dokter') == $dokter->Kode_Dokter ? 'selected' : '' }}>{{ $dokter->Nama_Dokter }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="section-title">Tanggal</div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" name="tanggal" @if (request('tanggal')==null) value="{{date('Y-m-d')}}" @else value="{{request('tanggal')}}" @endif placeholder="" aria-label="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                        <button type="button" class="btn btn-danger" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th scope="col">No Antrian</th>
                                    <th scope="col">No MR</th>
                                    <th scope="col">Nama Pasien</th>
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
                                        @if($data->FS_STATUS != '')
                                        <a href="{{ route('poliMata.assesmenKeperawatanEdit', ['noReg' => $data->No_Reg]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Edit</a>
                                        @else
                                        <a href="{{ route('poliMata.assesmenKeperawatanAdd', ['noReg' => $data->No_Reg]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pencil"></i> Entry</a>
                                        @endif
                                        {{-- Resep --}}
                                        @if($data->FS_TERAPI != '')
                                        <a href="{{ route('polimata.resep', [$data->No_Reg, $data->FS_KD_TRS])  }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Resep</a>
                                        @endif
                                        {{-- Cetak RM --}}
                                        @if($poliMata->cekDokter($data->No_Reg) == true)
                                            <a href="{{ route('polimata.cetakRM', [$data->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> RM</a>
                                        @endif
                                        {{-- Cetak Resume --}}
                                        @if($poliMata->cekDokter($data->No_Reg) == true)
                                            <a href="{{ route('polimata.cetakResume', [$data->No_Reg]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Resume</a>
                                        @endif
                                        {{-- --------------- --}}

                                        <!-- pasien kontrol -->
                                        @if($data->FS_CARA_PULANG == 2)
                                        <a href="{{ route('polimata.cetakSKDP', [$data->No_Reg, $data->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> SKDP</a>

                                        <a href="{{ route('kondisiPulang.EditSkdpRS', $data->No_Reg) }}" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Edit SKDP</a>
                                        <!-- pasien rujuk luar rs -->
                                        @elseif ($data->FS_CARA_PULANG == 4)
                                        <a href="{{ route('polimata.cetakRujukanRS', [$data->No_Reg, $data->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan RS</a>
                                        <!-- pasien dengan rujuk internal -->
                                        @elseif ($data->FS_CARA_PULANG == 6)
                                        <a href="{{ route('polimata.cetakRujukanInternal', [$data->No_Reg, $data->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Rujukan Internal</a>
                                        <!-- pasien dikembalikan ke faskes primer -->
                                        @elseif ($data->FS_CARA_PULANG == 7)
                                        <a href="{{ route('rj.faskes', [$data->No_Reg, $data->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> Faskes</a>
                                        @elseif ($data->FS_CARA_PULANG == 8)
                                        <a href="{{ route('rj.prb', [$data->No_Reg, $data->FS_KD_TRS]) }}" onclick="window.open(this.href,'_blank', 'location=yes,toolbar=yes,width=800,height=600'); return false;" class="btn btn-sm btn-info"><i class="fas fa-download"></i> PRB</a>
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