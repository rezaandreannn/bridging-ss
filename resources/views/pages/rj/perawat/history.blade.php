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
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $pasien->NAMA_PASIEN ?? ''}} - ({{ $pasien->NO_MR ?? ''}})</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b></b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">Rekanan :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pasien->NAMAREKANAN ?? ''}}</div>
                                            </div>
                                        </li>
                        
                                        <li class="media">
                                            <div class="media-title">Jenis Kelamin :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> @if ($pasien->JENIS_KELAMIN == 'L')
                                                    Laki-Laki
                                                    @else
                                                    Perempuan
                                                    @endif  </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Lahir :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1">{{ date('d-m-Y', strtotime($pasien->TGL_LAHIR ?? '')) }}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Alamat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pasien->ALAMAT ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Nama Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pasien->NAMA_DOKTER ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                                            <th>Layanan</th>
                                            <th>Catatan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                        <tr>
                                            <td width="15%">{{ date('d-m-Y', strtotime($item->TANGGAL)) }}</td>
                                            <td width="20%">{{ $item->NAMA_DOKTER }}</td>
                                            <td width="20%">{{ $item->SPESIALIS }}</td>
                                            <td> - </td>
                                            <td>
                                                @if($item->KODE_RUANG == '')
                                                <div class="badge badge-primary">
                                                    Rawat Jalan
                                                </div>
                                                @elseif($item->KODE_RUANG !== '')
                                                <div class="badge badge-success">
                                                    Rawat Inap
                                                </div>
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
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->


<!-- Page Specific JS File -->




@endpush