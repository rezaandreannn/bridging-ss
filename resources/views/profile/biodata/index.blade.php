@extends('layouts.app')

@section('title', $title ?? '')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->

<style>
    .profile-container {
        max-width: 100%; /* Mengubah menjadi 100% untuk responsivitas penuh */
        margin: auto;
        padding: 20px;
    }
    .profile-img {
        width: 100%; /* Mengubah ukuran gambar agar menyesuaikan dengan container */
        max-width: 150px; /* Batasi ukuran maksimal gambar */
        height: auto; /* Mempertahankan rasio aspek */
        object-fit: cover;
        border-radius: 50%;
    }
    .profile-container .row {
        display: flex;
        flex-wrap: wrap; /* Membantu dalam menyesuaikan elemen di perangkat kecil */
    }
    .profile-container .col-md-4,
    .profile-container .col-md-8 {
        flex: 1 1 100%; /* Mengatur flex item agar bisa mengisi 100% dari kontainer pada layar kecil */
    }

    @media (max-width: 768px) {
        .profile-img {
            width: 100px; /* Mengurangi ukuran gambar untuk perangkat kecil */
        }
        .profile-container {
            padding: 10px; /* Mengurangi padding pada perangkat kecil */
        }
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title ?? ''}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="">Profile</a></div>
                <div class="breadcrumb-item">User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                {{-- @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif --}}
                <div class="card-body">
                    <div class="container profile-container">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 text-center">
                                @if ($biodata->image)
                                <img src="{{ asset('storage/images/'. $biodata->image ) }}" alt="Profile Picture" class="profile-img mb-3">
                                @else
                                <img src="{{ asset('img/avatar/avatar-1.png') }}" width="25%" alt="Gambar Default">
                                @endif
                                <a href="" class="btn btn-primary">Edit Photo</a>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <h2>{{$biodata->name}}</h2>
                                <p><strong>Email: {{$biodata->email}}</strong> </p>
                                <a href="" class="btn btn-success me-2">Edit Biodata</a>
                                <a href="{{route('password.index')}}" class="btn btn-info">Edit Password</a>
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
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('rm.bymr') }}";
    }
</script>

@endpush