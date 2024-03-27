@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('user.index') }}">Manage User</a></div>
                <div class="breadcrumb-item">User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('user.create')}}" class="btn btn-primary rounded-0">New Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>@if ($user->image)
                                        <img src="{{ asset('storage/images/'. $user->image ) }}" width="25%" alt="Gambar Pengguna">
                                        @else
                                        <img src="{{ asset('img/avatar/avatar-1.png') }}" width="25%" alt="Gambar Default">
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="badge border-0
                                             @if($user->roles->count() > 1)
                                                    badge-primary
                                                @elseif($user->roles->count() == 1)
                                                    badge-success
                                                @else
                                                    badge-danger
                                                @endif" data-toggle="modal" data-target="#changeRole{{ $user->roles->count() > 1 ? $user->id : ''}}">
                                            @if($user->roles->count() > 1)
                                            {{$user->roles->count()}} Role
                                            @elseif($user->roles->count() == 1)
                                            {{ $user->roles[0]->name }}
                                            @else
                                            Not Role
                                            @endif
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="badge border-0
                                             @if($user->permissions->count() > 1)
                                                    badge-primary
                                                @elseif($user->permissions->count() == 1)
                                                    badge-success
                                                @else
                                                    badge-danger
                                                @endif" data-toggle="modal" data-target="#changeRole{{ $user->permissions->count() > 1 ? $user->id : ''}}">
                                            @if($user->permissions->count() > 1)
                                            {{$user->permissions->count()}} Permission
                                            @elseif($user->permissions->count() == 1)
                                            {{ $user->permissions[0]->name }}
                                            @else
                                            Not Permission
                                            @endif
                                        </button>
                                    </td>
                                    <td width="15%">
                                        <a href="{{ route('user.edit', $user->id )}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <button id="delete" data-id="{{ $user->id }}" data-nama="{{ $user->name }}" data-bs-toggle="tooltip" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
<script>
    $(document).on('click', '#delete', function() {
        var user = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');

        swal({
                title: "Are You Sure?",
                text: "Data Will Be Deleted " + nama + " !!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "{{ route('user.delete', ['id' => ':id']) }}".replace(':id', user);
                    swal("Data successfully deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Data will not be deleted!");
                }
            });
    });
</script>


@endpush