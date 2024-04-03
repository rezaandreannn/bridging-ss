@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pendaftaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('pendaftaran.index') }}">Kunjungan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('pendaftaran.index') }}">Pendaftaran</a></div>
                <div class="breadcrumb-item">Detail Pendaftaran</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $pendaftaran['nama_pasien'] ?? ''}} - ( {{ $pendaftaran['no_mr'] ?? ''}} )</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <h6 class="mb-0"><b>NIK : {{ $pendaftaran['nik'] ?? ''}}</b></h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">No Registrasi :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pendaftaran['no_registrasi'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Status Rawat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pendaftaran['status_rawat'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Rekanan :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pendaftaran['nama_rekanan'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Nama Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pendaftaran['nama_dokter'] ?? ''}}</div>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title mb-0">Kode Dokter :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1 badge badge-info"> {{ $pendaftaran['kode_dokter'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Daftar By :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pendaftaran['daftar_by'] ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Created By :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $pendaftaran['created_by'] ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Bridging</h4>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        <!-- 1.1 -->
                        @if($dataEncounter == 'RAWAT INAP')
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" aria-expanded="true">
                                <h4>Untuk saat ini Encounter Rawat Inap belum tersedia. 🙏</h4>
                            </div>
                        </div>
                        @elseif($dataEncounter == NULL)
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" aria-expanded="true">
                                <h4>Pasien Sudah datang data encounter belum ada? <a href="{{ route('case.encounter.create', $pendaftaran['no_registrasi'])}}" class=" btn btn-success text-white">Klik disini</a> Untuk mengirim data</h4>
                            </div>
                        </div>
                        @else
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                <h4>Detail Encounter</h4>
                            </div>
                            <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                                <ul>
                                    <li>ID: {{ $dataEncounter['id'] }}</li>
                                    <li>Status: {{ $dataEncounter['status'] }}</li>
                                    @php
                                    // Mengonversi waktu dari format UTC ke WIB
                                    $lastUpdateUTC = $dataEncounter['meta']['lastUpdated'];
                                    $lastUpdateWIB = \Carbon\Carbon::parse($lastUpdateUTC)->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s');
                                    @endphp
                                    <li>Last Update: {{ $lastUpdateWIB ?? '' }}</li>
                                    <li>Identifier:
                                        <ul>
                                            <li>System: {{ $dataEncounter['identifier'][0]['system'] }}</li>
                                            <li>Value: {{ $dataEncounter['identifier'][0]['value'] }}</li>
                                        </ul>
                                    </li>
                                    <li>Subject:
                                        <ul>
                                            <li>display: {{ $dataEncounter['subject']['display'] }}</li>
                                            <li>Reference: {{ $dataEncounter['subject']['reference'] }}</li>
                                        </ul>
                                    </li>
                                    <li>Class:
                                        <ul>
                                            <li>Code: {{ $dataEncounter['class']['code'] }}</li>
                                            <li>Display: {{ $dataEncounter['class']['display'] }}</li>
                                            <li>System: {{ $dataEncounter['class']['system'] }}</li>
                                        </ul>
                                    </li>
                                    <li>Location:
                                        <ul>
                                            <li>Display: {{ $dataEncounter['location'][0]['location']['display'] }}</li>
                                            <li>Reference: {{ $dataEncounter['location'][0]['location']['reference'] }}</li>
                                        </ul>
                                    </li>
                                    <li>Participant:
                                        <ul>
                                            @foreach ($dataEncounter['participant'] as $participant)
                                            <li>Individual:
                                                <ul>
                                                    <li>Display: {{ $participant['individual']['display'] }}</li>
                                                    <li>Reference: {{ $participant['individual']['reference'] }}</li>
                                                </ul>
                                            </li>
                                            <li>Type:
                                                <ul>
                                                    @foreach ($participant['type'] as $type)
                                                    @foreach ($type['coding'] as $coding)
                                                    <li>Code: {{ $coding['code'] }}</li>
                                                    <li>Display: {{ $coding['display'] }}</li>
                                                    <li>System: {{ $coding['system'] }}</li>
                                                    @endforeach
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>Period:
                                        <ul>
                                            <li>Start: {{ $dataEncounter['period']['start'] }}</li>
                                        </ul>
                                    </li>
                                    <li>Status History:
                                        <ul>
                                            @foreach ($dataEncounter['statusHistory'] as $status)
                                            <li>
                                                <ul>
                                                    <li>Status: {{ $status['status'] }}</li>
                                                    @if(isset($status['period']['start']))
                                                    <li>Start: {{ $status['period']['start'] }}</li>
                                                    @endif
                                                    @if(isset($status['period']['end']))
                                                    <li>End: {{ $status['period']['end'] }}</li>
                                                    @endif
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <!-- Add more details as needed -->
                                </ul>
                            </div>
                        </div>
                        @endif
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