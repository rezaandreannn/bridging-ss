@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('organization.index') }}">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organization</a></div>
                <div class="breadcrumb-item">Detail Organization</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mb-0">{{ $organization->name}}</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <b>{{ $organization->organization_id}}</b>
                            </div>
                            <div class="author-box-description">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Status</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : @if($organization->active == true)
                                                <b>Active</b> (true)
                                                @else
                                                <b>Inactive (false)</b>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Part Of</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{$organization->part_of ?? ''}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Country</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : Indonesia
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">City</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : Kota Metro
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Created By</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{ $organization->user_name ?? 'Seeder System'}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6 class="mb-0">Created Date</h6>
                                            </div>
                                            <div class="col-sm-8">
                                                : {{$organization->updated_at ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Part Detail </h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOrganization">
                                New Organization
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped table">

                                <tr>
                                    <th>Organization ID</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                </tr>

                                @foreach($organizationbyParts as $organizationPart)
                                <tr>
                                    <td>{{ $organizationPart->organization_id}}</td>
                                    <td>{{ $organizationPart->name}}</td>
                                    <td class="text-center">
                                        <input type="checkbox" class="form-check-input" {{ $organizationPart->active == true ? 'checked' : ''}}>

                                    </td>
                                </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Location By Organization </h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">New Location</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Location ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($locationByOrganization as $location)
                                <tr>
                                    <td>{{$location->location_id}}</td>
                                    <td>{{$location->name}}</td>
                                    <td>
                                        @if($location->status == 'active')
                                        <div class="badge badge-success">{{$location->status}}</div>
                                        @elseif($location->status == 'inactive')
                                        <div class="badge badge-danger">{{$location->status}}</div>
                                        @else
                                        <div class="badge badge-warning">{{$location->status}}</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<!-- Modal create organization -->
<div class="modal fade" id="newOrganization" tabindex="-1" aria-labelledby="newOrganizationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOrganizationLabel">Create By Part Of {{ $organization->name}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('organization.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="" name="modal" value="modal">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Identifier Value</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="identifier_value">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="type_code">
                                <option value="" disabled selected>-- Select item --</option>
                                @foreach($organizationType as $type)
                                <option value="{{ $type['coding_code']}}">{{ $type['coding_display']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Part Of</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="part_of" value="{{ $organization->organization_id}}" readonly>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="active" name="active">
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<!-- DataTable -->

<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->

<script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush