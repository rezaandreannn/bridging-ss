@extends('layouts.app')

@section('title', 'Document')

@push('style')
<!-- CSS Libraries -->

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Documentation</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('antrean.index') }}">Documentation</a></div>
                <div class="breadcrumb-item">Docs</div>
            </div>
        </div>

        <div class="section-body">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Documentation</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="panduan-tab3" data-toggle="tab" href="#panduan" role="tab" aria-controls="home" aria-selected="true">Panduan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="location-tab3" data-toggle="tab" href="#location" role="tab" aria-controls="profile" aria-selected="false">Location</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="organization-tab3" data-toggle="tab" href="#organization" role="tab" aria-controls="contact" aria-selected="false">Organization</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="encounter-tab3" data-toggle="tab" href="#encounter" role="tab" aria-controls="contact" aria-selected="false">Encounter</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="panduan" role="tabpanel" aria-labelledby="panduan-tab3">
                                <iframe src="{{ asset('docs/Document-SatuSehat.pdf') }}" width="100%" height="600px"></iframe>
                            </div>
                            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab3">
                                <iframe src="{{ asset('docs/Location.pdf') }}" width="100%" height="600px"></iframe>
                            </div>
                            <div class="tab-pane fade" id="organization" role="tabpanel" aria-labelledby="organization-tab3">
                                <iframe src="{{ asset('docs/Organization.pdf') }}" width="100%" height="600px"></iframe>
                            </div>
                            <div class="tab-pane fade" id="encounter" role="tabpanel" aria-labelledby="encounter-tab3">
                                <iframe src="{{ asset('docs/Encounter.pdf') }}" width="100%" height="600px"></iframe>
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<!-- Page Specific JS File -->
@endpush