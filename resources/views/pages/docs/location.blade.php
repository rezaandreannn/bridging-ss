@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Documentation</a></div>
                <div class="breadcrumb-item">Location</div>
            </div>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Location</h4>
                    </div>
                    <div class="card-body">
                        <div id="accordion">
                            <!-- 2.1 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                    <h4>2.1 Location.identifier[i].use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center w-25">Code System</th>
                                                    <th class="text-center">Location.identifier[i].use</th>
                                                    <th class="text-center w-50">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_identifier as $identifier)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $identifier['code_system']}}</td>
                                                    <td class="text-center">{{ $identifier['identifier_use']}}</td>
                                                    <td>{{ $identifier['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 2.2 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                    <h4>2.2 Location.status</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center w-25">Code System</th>
                                                    <th class="text-center w-25">Location.status</th>
                                                    <th class="text-center w-50">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_status as $status)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $status['code_system']}}</td>
                                                    <td class="text-center">{{ $status['location_status']}}</td>
                                                    <td class="text-center">{{ $status['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 2.3 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                                    <h4>2.3 Location.operationalStatus</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center w-25">Location.operationalStatus.system</th>
                                                    <th class="text-center w-25">Location.operationalStatus.code</th>
                                                    <th class="text-center w-25">Location.operationalStatus.display</th>
                                                    <th class="text-center w-50">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_operational as $operational)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $operational['code_system']}}</td>
                                                    <td class="text-center">{{ $operational['Status_code']}}</td>
                                                    <td class="text-center">{{ $operational['Status_display']}}</td>
                                                    <td class="text-center">{{ $operational['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 2.4 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-4">
                                    <h4>2.4 Location.mode</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-4" data-parent="#accordion">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Location.mode</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($l_modes as $modes)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $modes['code_system']}}</td>
                                                <td class="text-center">{{ $modes['mode']}}</td>
                                                <td class="text-center">{{ $modes['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 2.5 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-5">
                                    <h4>2.5 Location.telecom[i].system</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-5" data-parent="#accordion">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Location.telecom[i].system</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($l_system as $system)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $system['coding_system']}}</td>
                                                <td>{{ $system['telecom_system']}}</td>
                                                <td>{{ $system['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 2.6 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-6">
                                    <h4>2.6 Location.telecom[i].use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-6" data-parent="#accordion">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Location.telecom[i].use</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($l_use as $use)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $use['coding_system']}}</td>
                                                <td>{{ $use['telecom_use']}}</td>
                                                <td>{{ $use['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 2.7 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-7">
                                    <h4>2.7 Location.address.use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-7" data-parent="#accordion">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Location.telecom.use</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($l_addressUse as $addressUse)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $addressUse['coding_system']}}</td>
                                                <td>{{ $addressUse['telecom_use']}}</td>
                                                <td>{{ $addressUse['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 2.8 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-8">
                                    <h4>2.8 Location.address.type</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-8" data-parent="#accordion">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Location.address.type</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($l_addressType as $addressType)
                                            <tr>
                                                <td> {{ $loop->iteration }}</td>
                                                <td>{{ $addressType['coding_system']}}</td>
                                                <td>{{ $addressType['address_type']}}</td>
                                                <td>{{ $addressType['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 2.9 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-9">
                                    <h4>2.9 Location.physicalType</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-9" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center">Location.physicalType.coding.system</th>
                                                    <th class="text-center">Location.physicalType.coding.code</th>
                                                    <th class="text-center">Location.physicalType.coding.display</th>
                                                    <th class="text-centerw-50">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_physical as $physical)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $physical['coding_system']}}</td>
                                                    <td class="text-center">{{ $physical['coding_code']}}</td>
                                                    <td class="text-center">{{ $physical['coding_display']}}</td>
                                                    <td>{{ $physical['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 2.10 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-10">
                                    <h4>2.10 Location.hoursOfOperation[i].daysOfWeek</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-10" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center">Code System</th>
                                                    <th class="text-center">Location.hoursOfOperation[i].daysOfWeek</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_daysofweek as $daysofweek)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $daysofweek['coding_system']}}</td>
                                                    <td class="text-center">{{ $daysofweek['days_of_week']}}</td>
                                                    <td>{{ $daysofweek['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 2.11 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-11">
                                    <h4>2.11 Location.extension.serviceClass</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-11" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center">Location.extension.serviceClass.system</th>
                                                    <th class="text-center">Location.extension.serviceClass.code</th>
                                                    <th class="text-center">Location.extension.serviceClass.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_serviceClass as $serviceClass)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $serviceClass['serviceClass_system']}}</td>
                                                    <td class="text-center">{{ $serviceClass['serviceClass_code']}}</td>
                                                    <td class="text-center">{{ $serviceClass['serviceClass_display']}}</td>
                                                    <td class="text-center">{{ $serviceClass['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 2.12 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-12">
                                    <h4>2.12 Location.type</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-12" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th class="text-center">Location.type.system</th>
                                                    <th class="text-center">Location.type.code</th>
                                                    <th class="text-center">Location.type.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($l_type as $type)
                                                <tr>
                                                    <td> {{ $loop->iteration }}</td>
                                                    <td>{{ $type['type_system']}}</td>
                                                    <td>{{ $type['type_code']}}</td>
                                                    <td>{{ $type['type_display']}}</td>
                                                    <td>{{ $type['keterangan']}}</td>
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
            </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>


@endpush