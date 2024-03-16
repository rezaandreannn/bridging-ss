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
                <div class="breadcrumb-item active"><a href="{{ route('mapping.encounter.index') }}">Mappings</a></div>
                <div class="breadcrumb-item"><a href="{{ route('mapping.encounter.index') }}">Encounter</a></div>
                <div class="breadcrumb-item">Edit Mapping Encounter</div>
            </div>
        </div>

        <div class="section-body">

            <form action="{{ route('mapping.encounter.update', $encounter->id)}}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Create</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Docter Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="doctor" class="form-control select2" id="doctor">
                                            @foreach($dokters->getSelect() as $dokter)
                                            <option value="{{ $dokter['kode_dokter']}}" @if($encounter->kode_dokter == $dokter['kode_dokter']) selected @endif>{{ $dokter['nama_dokter']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="location" class="form-control selectric" id="location">
                                            @foreach($locations as $location)
                                            <option value="{{ $location->id }}" @if($encounter->location_id == $location->id) selected @endif>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Encounter Type<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="encounter_type" class="form-control selectric" id="encounter_type">
                                            @foreach($encounterTypes as $type)
                                            <option value="{{ $type }}" @if($encounter->encounter_type == $type) selected @endif>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="status" name="status" @if($encounter->status) checked @endif>
                                            <label class="form-check-label" for="status">Status</label>
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