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
                <div class="breadcrumb-item">Organization</div>
            </div>
        </div>

        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Organization</h4>
                    </div>
                    <div class="card-body">
                        <div id="accordion">
                            <!-- 1.1 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                    <h4>1.1 Organization.identifier[i].use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">Code System</th>
                                                    <th class="text-center" width="5%">Organization.identifier[i].use</th>
                                                    <th class="text-center">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($o_identifier as $identifier)
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
                            <!-- 1.2 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                    <h4>1.2 Organization.type</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                    <div class="table-responsive">
                                        <table class="table-striped table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">Organization.type[i].coding.system</th>
                                                    <th class="text-center" width="5%">Organization.type[i].coding.code</th>
                                                    <th class="text-center" width="5%">Organization.type[i].coding.display</th>
                                                    <th class="text-center" width="5%">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($o_type as $type)
                                                <tr>
                                                    <td>{{ $type['coding_system']}}</td>
                                                    <td>{{ $type['coding_code']}}</td>
                                                    <td>{{ $type['coding_display']}}</td>
                                                    <td>{{ $type['keterangan']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- 1.3 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                                    <h4>1.3 Organization.telecom[i].systems</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Organization.telecom[i].system</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($o_system as $system)
                                            <tr>
                                                <td>{{ $system['coding_system']}}</td>
                                                <td>{{ $system['telecom_system']}}</td>
                                                <td>{{ $system['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 1.4 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-4">
                                    <h4>1.4 Organization.telecom[i].use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-4" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Organization.telecom[i].use</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($o_use as $use)
                                            <tr>
                                                <td>{{ $use['coding_system']}}</td>
                                                <td>{{ $use['telecom_use']}}</td>
                                                <td>{{ $use['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 1.5 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-5">
                                    <h4>1.5 Organization.address[i].use</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-5" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Organization.address[i].use</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($o_addressUse as $addressUse)
                                            <tr>
                                                <td>{{ $addressUse['coding_system']}}</td>
                                                <td>{{ $addressUse['address_use']}}</td>
                                                <td>{{ $addressUse['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 1.6 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-6">
                                    <h4>1.6 Organization.address[i].type</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-6" data-parent="#accordion">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code System</th>
                                                <th class="text-center">Organization.address[i].type</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($o_addressType as $addressType)
                                            <tr>
                                                <td>{{ $addressType['coding_system']}}</td>
                                                <td>{{ $addressType['address_type']}}</td>
                                                <td>{{ $addressType['keterangan']}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 1.7 -->
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-7">
                                    <h4>1.7 Organization.contact[i].purpose</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-7" data-parent="#accordion">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Organization.contact[i].purpose.coding.system</th>
                                                <th class="text-center">Organization.contact[i].purpose.coding.code</th>
                                                <th class="text-center">Organization.contact[i].purpose.coding.display</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($o_contact as $contact)
                                            <tr>
                                                <td>{{ $contact['purpose_coding_system']}}</td>
                                                <td>{{ $contact['purpose_coding_code']}}</td>
                                                <td>{{ $contact['purpose_coding_display']}}</td>
                                                <td>{{ $contact['keterangan']}}</td>
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