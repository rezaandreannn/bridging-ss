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
                <div class="breadcrumb-item active"><a href="">Master Data</a></div>
                <div class="breadcrumb-item"><a href="">Organization</a></div>
                <div class="breadcrumb-item">Create Organization</div>
            </div>
        </div>

        <div class="section-body">

            <form action="{{ route('mapping.encounter.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Create</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Dokter Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control select2" name="kode_dokter">
                                            <option>-- Select item --</option>
                                            @foreach($dokters->getSelect() as $dokter)
                                            <option value="{{ $dokter['kode_dokter']}}">{{ $dokter['nama_dokter']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Organization Name<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="part_of">
                                            <option>-- Select item --</option>
                                            @foreach($organizations as $id => $name)
                                            <option value="{{ $id}}">{{ $name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location Name<code>*</code></label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="location_id">
                                    <option>-- Select item --</option>
                                    @foreach($locations as $location)
                                    <option value="{{ $location->location_id }}">{{ $location->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Encounter Type<code>*</code></label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="type">
                                    <option>-- Select item --</option>
                                    @foreach($encounterTypes as $type)
                                    <option value="{{ $type}}">{{ $type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="status" name="status">
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
