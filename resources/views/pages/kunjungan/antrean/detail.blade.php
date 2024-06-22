@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pasien</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('patient.index') }}">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('patient.index') }}">Pasien</a></div>
                <div class="breadcrumb-item">Detail Pasien</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h4>{{ $pasien->NAMA_PASIEN}} - ( {{ $pasien->NO_MR}} )</h4>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h5>NIK : {{ $pasien->HP2}}</h5>
                            </div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                No Registrasi
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasien->No_Reg}}
                                            </div>
                                            <div class="col-md-4">
                                                Jenis Kelamin
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasien->JENIS_KELAMIN}}
                                            </div>
                                            <div class="col-md-4">
                                                Tanggal Lahir
                                            </div>
                                            <div class="col-md-8">
                                                : {{ date('d-m-Y', strtotime($pasien->TGL_LAHIR)) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Alamat
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasien->ALAMAT}}
                                            </div>
                                            <div class="col-md-4">
                                                Nama Dokter
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasien->NAMA_DOKTER}}
                                            </div>
                                            <div class="col-md-4">
                                                Spesialis
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $pasien->SPESIALIS}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100 d-sm-none"></div>
                        </div>
                    </div>
                    <a href="{{ route('rj.cetak', $pasien->NO_MR )}}" class="btn btn-sm btn-primary mb-2"><i class="fas fa-download"></i> Download Berkas</a>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Dokter</th>
                                            <th>Uraian Klinis</th>
                                            <th>Dianogsa</th>
                                            <th>Hasil ECHO</th>
                                            <th>Rencana</th>
                                            <th>Terapi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td width="15%">{{ date('d-m-Y', strtotime($item->TANGGAL)) }}</td>
                                            <td width="20%">{{ $item->NAMA_DOKTER }}({{ $item->SPESIALIS }})
                                            </td>
                                            <td width="25%">TD: {{ str_replace("-", "", $item->FS_TD) }} mmHg
                                                keluhan: {{ str_replace("-", "", $item->FS_ANAMNESA) }}</td>
                                            <td>{{ $item->FS_DIAGNOSA }}</td>
                                            <td>{{ $item->HASIL_ECHO }}</td>
                                            <td>{{ $item->FS_PLANNING }}</td>
                                            <td width="40%">{{ $item->FS_TERAPI }}</td>
                                        </tr>
                                        @endforeach
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


<!-- Page Specific JS File -->




@endpush