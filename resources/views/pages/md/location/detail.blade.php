@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
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
                    <div class="card">
                        <div class="card-header">
                            <h4>Show/Hide</h4>
                            <div class="card-header-action">
                                <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                            </div>
                        </div>
                        <div class="collapse show" id="mycard-collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Location ID
                                            </div>
                                            <div class="col-md-8">
                                                {{ $dataById['id'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Name
                                            </div>
                                            <div class="col-md-8">
                                                {{ $dataById['name'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Status
                                            </div>
                                            <div class="col-md-8">
                                                @if(isset($dataById['active']) == true)
                                                <b>Active</b>(true)
                                                @else
                                                <b>Inactive</b>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                Organization ID
                                            </div>
                                            <div class="col-md-8">
                                                {{$dataById['partOf']['reference'] ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Country
                                            </div>
                                            <div class="col-md-8">
                                                {{ isset($dataById['address'][0]['country']) && $dataById['address'][0]['country'] == 'ID' ? 'Indonesia' : (isset($dataById['address'][0]['country']) ? $dataById['address'][0]['country'] : '') }}

                                            </div>
                                            <div class="col-md-4">
                                                City
                                            </div>
                                            <div class="col-md-8">
                                                {{ $dataById['address'][0]['city'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Address
                                            </div>
                                            <div class="col-md-8">
                                                {{ $dataById['address'][0]['line'][0] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Postal code
                                            </div>
                                            <div class="col-md-8">
                                                {{$dataById['address'][0]['postalCode'] ?? ''}}
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
                            <h4>Location By Organization </h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-primary">New Location</a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-mp">
                                    <tr>
                                        <th>Location ID</th>
                                        <th>Name</th>
                                        <th>Active</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Irwansyah Saputra</td>
                                        <td>
                                            <div class="badge badge-success">1</div>
                                        </td>
                                        <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination-2 mb-0">
                                    <li class="page-item-2 disabled">
                                        <a class="page-link-2" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item-2 active"><a class="page-link-2" href="#">1 <span class="sr-only">(current)</span></a></li>
                                    <li class="page-item-2">
                                        <a class="page-link-2" href="#">2</a>
                                    </li>
                                    <li class="page-item-2"><a class="page-link-2" href="#">3</a></li>
                                    <li class="page-item-2">
                                        <a class="page-link-2" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal create organization -->
{{-- <div class="modal fade" id="newOrganization" tabindex="-1" aria-labelledby="newOrganizationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newOrganizationLabel">Create By Part Of {{ $dataById['name'] ?? '' }} </h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ route('organization.store')}}" method="post">
    @csrf
    <div class="modal-body">
        <input type="hidden" class="form-control" id="" name="modal" value="modal">
        <div class="form-group">
            <label for="name">Organization Name<code>*</code></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="input your organization name">
        </div>
        <div class="form-group">
            <label for="part_of">Part Of</label>
            <input type="text" class="form-control" id="part_of" name="part_of" value="{{ $dataById['id'] ?? '' }}" readonly>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="active" checked>
            <label class="form-check-label" for="active">Active</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
</div>
</div>
</div> --}}
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>

@endpush
