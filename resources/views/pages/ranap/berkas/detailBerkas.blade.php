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
                <div class="breadcrumb-item active"><a href="{{ route('rj.dokter') }}">Medical Record</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.dokter') }}">Rawat Inap</a></div>
                <div class="breadcrumb-item">Berkas</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('components.biodata-pasien-bynoreg')
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Nama Berkas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Asesmen Awal Medis Rawat Inap</td>
                                            <td>
                                                @if ($medis != null)
                                                    @if($medis->mdd != '')
                                                        <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Asesmen Awal Keperawatan Rawat Inap</td>
                                            <td>
                                                @if ($perawat != null)
                                                    @if($perawat->mdd != '')
                                                    <a href="{{ route('ri.cetakKeperawatanRanap', ['noReg' => $perawat->FS_KD_REG]) }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Asesmen Awal Kebidanan Rawat Inap</td>
                                            <td>
                                                @if ($bidan != null)
                                                    @if($bidan->mdd != '')
                                                    <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Keperawatan</td>
                                            <td>
                                                <a href="{{ route('ri.detailRencana', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tindakan Keperawatan</td>
                                            <td>
                                                <a href="{{ route('ri.detailTindakan', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Catatan Pemberian Obat</td>
                                            <td>
                                                <a href="{{ route('ri.detailObat', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>CPPT</td>
                                      
                                            <td>
                                                <a href="{{ route('rm.cppt', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Catatan Edukasi</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EWS</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-primary"><i class="fas fa-download"></i> Detail</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Asesmen Jatuh</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rencana Pulang Pasien</td>
                                            <td>
                                                @if ($rencana != null)
                                                    @if($rencana->MDD != '')
                                                    <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hasil Laboratorium dan Radiologi</td>
                                            <td>
                                                <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Resume Pasien Pulang</td>
                                            <td>
                                                @if ($resume != null)
                                                    @if($resume->mdd_update != '')
                                                    <a href="" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Cetak</a>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>    
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">File Scan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal Uploud</th>
                                            <th>Kode Reg</th>
                                            <th>Jenis Berkas</th>
                                            <th>Nama Berkas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>22-08-2024</td>
                                            <td>24-0000002</td>
                                            <td>Ranap</td>
                                            <td>Ranap</td>
                                            <td><a href="" class="btn btn-sm btn-info"><i class="fas fa-edit"></i>Detail</a></td>
                                        </tr>
                                    </tbody>    
                                </table>
                            </div>
                        </div>
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

@endpush