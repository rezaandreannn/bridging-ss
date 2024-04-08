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
                <div class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organisasi</a></div>
                <div class="breadcrumb-item">Buat Organisasi</div>
            </div>
        </div>

        <div class="section-body">
            <form action="{{ route('organization.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form Create</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nilai Pengidentifikasi<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="identifier_value">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tipe<code>*</code></label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="type_code">
                                            <option value="" disabled selected>-- Pilih Tipe --</option>
                                            @foreach($organizationType as $type)
                                            <option value="{{ $type['coding_code']}}">{{ $type['coding_display']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bagian dari</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="part_of">
                                            <option disabled selected>-- Pilih Bagian --</option>
                                            @foreach($organizations as $organization)
                                            <option value="{{ $organization->organization_id }}">{{ $organization->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="active" name="active">
                                            <label class="form-check-label" for="active">Aktif</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
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