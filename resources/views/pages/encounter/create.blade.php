@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? '' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('organization.index') }}">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organization</a></div>
                <div class="breadcrumb-item">Create Organization</div>
            </div>
        </div>

        <div class="section-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Encounter</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Registrasi<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="pasien_name" value="{{$result['kodeReg']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Patient Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="pasien_name" value="{{$result['patientName']}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Patient Ihs Number<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{$result['patientId']}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Practitioner Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{$result['practitionerName']}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Practitioner Ihs Number<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{$result['practitionerIhs']}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{$result['locationName']}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Organization ID<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" value="{{$result['organizationId']}}">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    {{-- <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location Name<code>*</code></label> --}}
                                    <div class="col-sm-12 col-md-7">
                                        <input type="hidden" class="form-control" name="name" value="{{$result['locationId']}}">
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
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
