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
                <div class="breadcrumb-item">Encounter</div>
            </div>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Encounter</h4>
                    </div>
                    <div class="card-body">
                        <div id="accordion">
                            <!-- 3.1 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                    <h4>3.1 Encounter.identifier[i].use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">Code System</th>
                                                    <th class="text-center" width="5%">Encounter.identifier[i].use</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_identifier as $identifier)
                                                <tr>
                                                    <td class="text-center" width="5%">{{ $identifier['code_system']}}</td>
                                                    <td class="text-center" width="5%">{{ $identifier['identifier_use']}}</td>
                                                    <td>{{ $identifier['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.2 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                    <h4>3.2 Encounter.status</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">Code System</th>
                                                    <th class="text-center" width="5%">Encounter.status</th>
                                                    <th class="text-center" width="5%">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_status as $status)
                                                <tr>
                                                    <td>{{ $status['code_system']}}</td>
                                                    <td>{{ $status['encounter_status']}}</td>
                                                    <td>{{ $status['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.3 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                                    <h4>3.3 Encounter.statusHistory[i].status</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Encounter.statusHistory[i].status</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($e_statusHistory as $statusHistory)
                                            <tr>
                                                <td>{{ $statusHistory['code_system']}}</td>
                                                <td>{{ $statusHistory['encounter_status']}}</td>
                                                <td>{{ $statusHistory['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 3.4 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-4">
                                    <h4>3.4 Encounter.class</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-4" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Encounter.class.system</th>
                                                <th class="text-center">Encounter.class.code</th>
                                                <th class="text-center">Encounter.class.display</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($e_class as $class)
                                            <tr>
                                                <td>{{ $class['class_system']}}</td>
                                                <td>{{ $class['class_code']}}</td>
                                                <td>{{ $class['class_display']}}</td>
                                                <td>{{ $class['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 3.5 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-5">
                                    <h4>3.5 Encounter.classHistory[i].class</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-5" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Encounter.classHistory[i].class.system</th>
                                                <th class="text-center">Encounter.classHistory[i].class.code</th>
                                                <th class="text-center">Encounter.classHistory[i].class.display</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($e_classHistory as $classHistory)
                                            <tr>
                                                <td>{{ $class['class_system']}}</td>
                                                <td>{{ $class['class_code']}}</td>
                                                <td>{{ $class['class_display']}}</td>
                                                <td>{{ $class['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 3.6 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-6">
                                    <h4>3.6 Encounter.priority</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-6" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Encounter.priority.coding.system</th>
                                                <th class="text-center">Encounter.priority.coding.code</th>
                                                <th class="text-center">Encounter.priority.coding.display</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($e_priority as $priority)
                                            <tr>
                                                <td>{{ $priority['coding_system']}}</td>
                                                <td>{{ $priority['coding_code']}}</td>
                                                <td>{{ $priority['coding_display']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 3.7 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-7">
                                    <h4>3.7 Encounter.participant[i].type</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-7" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.participant[i].type.coding.system</th>
                                                    <th class="text-center">Encounter.participant[i].type.coding.code</th>
                                                    <th class="text-center">Encounter.participant[i].type.coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_participant as $participant)
                                                <tr>
                                                    <td>{{ $participant['coding_system']}}</td>
                                                    <td>{{ $participant['coding_code']}}</td>
                                                    <td>{{ $participant['coding_display']}}</td>
                                                    <td>{{ $participant['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.8 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-8">
                                    <h4>3.8 Encounter.hospitalization.admitSource</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-8" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.hospitalization.admitSource.coding.system</th>
                                                    <th class="text-center">Encounter.hospitalization.admitSource.coding.code</th>
                                                    <th class="text-center">Encounter.hospitalization.admitSource.coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_admit as $admit)
                                                <tr>
                                                    <td>{{ $admit['coding_system']}}</td>
                                                    <td>{{ $admit['coding_code']}}</td>
                                                    <td>{{ $admit['coding_display']}}</td>
                                                    <td>{{ $admit['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.9 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-9">
                                    <h4>3.9 Encounter.hospitalization.reAdmission</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-9" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.hospitalization.admitSource.coding.system</th>
                                                    <th class="text-center">Encounter.hospitalization.admitSource.coding.code</th>
                                                    <th class="text-center">Encounter.hospitalization.admitSource.coding.display</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_admission as $admission)
                                                <tr>
                                                    <td>{{ $admission['coding_system']}}</td>
                                                    <td>{{ $admission['coding_code']}}</td>
                                                    <td>{{ $admission['coding_display']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.10 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-10">
                                    <h4>3.10 Encounter.hospitalization.dietPreference</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-10" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.hospitalization.dietPreference[i].coding.system</th>
                                                    <th class="text-center">Encounter.hospitalization.dietPreference[i].coding.code</th>
                                                    <th class="text-center">Encounter.hospitalization.dietPreference[i].coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_diet as $diet)
                                                <tr>
                                                    <td>{{ $diet['coding_system']}}</td>
                                                    <td>{{ $diet['coding_code']}}</td>
                                                    <td>{{ $diet['coding_display']}}</td>
                                                    <td>{{ $diet['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.11 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-11">
                                    <h4>3.11 Encounter.hospitalization.specialArrangement</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-11" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.hospitalization.specialArrangement[i].coding.system</th>
                                                    <th class="text-center">Encounter.hospitalization.specialArrangement[i].coding.code</th>
                                                    <th class="text-center">Encounter.hospitalization.specialArrangement[i].coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_arrangement as $arrangement)
                                                <tr>
                                                    <td>{{ $arrangement['coding_system']}}</td>
                                                    <td>{{ $arrangement['coding_code']}}</td>
                                                    <td>{{ $arrangement['coding_display']}}</td>
                                                    <td>{{ $arrangement['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.12 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-12">
                                    <h4>3.12 Encounter.hospitalization.dischargeDisposition</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-12" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.hospitalization.dischargeDisposition.coding.system</th>
                                                    <th class="text-center">Encounter.hospitalization.dischargeDisposition.coding.code</th>
                                                    <th class="text-center">Encounter.hospitalization.dischargeDisposition.coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_dispotion as $dispotion)
                                                <tr>
                                                    <td>{{ $dispotion['coding_system']}}</td>
                                                    <td>{{ $dispotion['coding_code']}}</td>
                                                    <td>{{ $dispotion['coding_display']}}</td>
                                                    <td>{{ $dispotion['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.13 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-13">
                                    <h4>3.13 Encounter.location.extension:serviceClass.value</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-13" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.location.extension:serviceClass.value.valueCodeableConcept.coding.system</th>
                                                    <th class="text-center">Encounter.location.extension:serviceClass.value.valueCodeableConcept.coding.code</th>
                                                    <th class="text-center">Encounter.location.extension:serviceClass.value.valueCodeableConcept.coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_service as $service)
                                                <tr>
                                                    <td>{{ $service['coding_system']}}</td>
                                                    <td>{{ $service['coding_code']}}</td>
                                                    <td>{{ $service['coding_display']}}</td>
                                                    <td>{{ $service['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 3.14 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-14">
                                    <h4>3.14 Encounter.location.extension:serviceClass.upgradeClassIndicator</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-14" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table table-width">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Encounter.location.extension:serviceClass.upgradeClassIndicator.valueCodeableConcept.coding.system</th>
                                                    <th class="text-center">Encounter.location.extension:serviceClass.upgradeClassIndicator.valueCodeableConcept.coding.code</th>
                                                    <th class="text-center">Encounter.location.extension:serviceClass.upgradeClassIndicator.valueCodeableConcept.coding.display</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($e_indicator as $indicator)
                                                <tr>
                                                    <td class="text-center">{{ $indicator['coding_system']}}</td>
                                                    <td class="text-center">{{ $indicator['coding_code']}}</td>
                                                    <td class="text-center">{{ $indicator['coding_display']}}</td>
                                                    <td class="text-center">{{ $indicator['keterangan']}}</td>
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
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
<script>
    $(document).on('click', '#delete', function() {
        var user = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
                title: "Are You Sure?",
                text: "Data Will Be Deleted " + nama + " !!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "{{ route('user.delete', ['id' => ':id']) }}".replace(':id', user);
                    swal("Data successfully deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Data will not be deleted!");
                }
            });
    });
</script>


@endpush