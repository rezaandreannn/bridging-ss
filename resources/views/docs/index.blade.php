@extends('layouts.app')

@section('title', 'doc')

@push('style')
<!-- CSS Libraries -->

@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? '' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('location.index') }}">Master Data</a></div>
                <div class="breadcrumb-item"><a href="{{ route('location.index') }}">Location</a></div>
                <div class="breadcrumb-item">Create Location</div>
            </div>
        </div>

        <div class="section-body">
            <iframe src="" style="width: 800px; height: 600px;" frameborder="0"></iframe>
        </div>
    </section>
</div>


@endsection

@push('scripts')
<!-- JS Libraies -->

<!-- Page Specific JS File -->

@endpush
