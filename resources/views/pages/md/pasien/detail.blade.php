@extends('layouts.app')

@section('title', 'Detail Pasien')

@push('style')
<!-- CSS Libraries -->


@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Pasien</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
                <div class="breadcrumb-item"><a href="#">Patient</a></div>
                <div class="breadcrumb-item">Detail Patient</div>
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
                                                Pasien ID
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['data']['no_mr'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Name
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['no_mr'] ?? ''}}

                                            </div>
                                            <div class="col-md-4">
                                                BPJS
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['no_bpjs'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                NIK
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['nik'] ?? ''}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="row">
                                            <div class="col-md-4">
                                                No HP
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['no_hp'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Tanggal Lahir
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['tanggal_lahir'] ?? ''}}

                                            </div>
                                            <div class="col-md-4">
                                                Jenis Kelamin
                                            </div>
                                            <div class="col-md-8">
                                                : {{ $request['jenis_kelamin'] ?? ''}}
                                            </div>
                                            <div class="col-md-4">
                                                Postal code
                                            </div>
                                            <div class="col-md-8">
                                                :
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
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->


<!-- Page Specific JS File -->




@endpush