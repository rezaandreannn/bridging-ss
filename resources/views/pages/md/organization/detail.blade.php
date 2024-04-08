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
                <div class="breadcrumb-item"><a href="{{ route('organization.index') }}">Organisasi</a></div>
                <div class="breadcrumb-item">Detail Organisasi</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="author-box-name">
                                <a href="#">
                                    <h6 class="mt-1">{{ $organization->name}}</h6>
                                </a>
                            </div>
                            <div class="author-box-job">
                                <p class="text-font"><b>{{ $organization->organization_id}}</b></p>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-unstyled mb-0">
                                        <li class="media">
                                            <div class="media-title">Status :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1">@if($organization->active == true)
                                                    <b>Active</b> (true)
                                                    @else
                                                    <b>Inactive (false)</b>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Bagian dari :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{$organization->part_of ?? ''}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title">Negara :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> Indonesia</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Kota :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1">Kota Metro</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Dibuat Oleh :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{ $organization->user_name ?? 'Seeder System'}}</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="media-title mb-0">Tanggal Dibuat :</div>
                                            <div class="media-body">
                                                <div class="media-title ml-3 mb-1"> {{$organization->updated_at ?? ''}}</div>
                                            </div>
                                        </li>
                                    </ul>
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
                        <h4>Detai Bagian </h4>
                        <div class="card-header-action">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newOrganization">
                                Organisasi Baru
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped table">

                                <tr>
                                    <th>ID Organisasi</th>
                                    <th>Nama</th>
                                    <th>Aktif</th>
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
                        <h4>Lokasi Menurut Organisasi </h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-primary">Lokasi Baru</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>ID Lokasi</th>
                                    <th>Nama</th>
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
                <h5 class="modal-title" id="newOrganizationLabel">Buat Berdasarkan Bagian Dari {{ $organization->name}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('organization.store')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="" name="modal" value="modal">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nilai Pengidentifikasi</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="identifier_value">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tipe</label>
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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bagian dari</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="part_of" value="{{ $organization->organization_id}}" readonly>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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