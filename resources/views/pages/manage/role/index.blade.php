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
                <div class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Manage User</a></div>
                <div class="breadcrumb-item">Role</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('roles.create')}}" class="btn btn-primary rounded-0">New Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Role Name</th>
                                    <th>Guard Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->guard_name}}</td>
                                    <td>
                                        <button type="button" class="badge border-0
                                             @if($role->permissions->count() > 1)
                                                    badge-primary
                                                @elseif($role->permissions->count() == 1)
                                                    badge-success
                                                @else
                                                    badge-danger
                                                @endif" data-toggle="modal" data-target="#changePermission{{ $role->permissions->count() > 1 ? $role->id : ''}}">
                                            @if($role->permissions->count() > 1)
                                            {{$role->permissions->count()}} Permission
                                            @elseif($role->permissions->count() == 1)
                                            {{ $role->permissions[0]->name }}
                                            @else
                                            Not Permissions
                                            @endif
                                        </button>
                                    </td>
                                    <td width="15%">
                                        <a href="{{ route('roles.edit', $role->id )}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <button id="delete" data-id="{{ $role->id }}" data-nama="{{ $role->name }}" data-bs-toggle="tooltip" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
        var role = $(this).attr('data-id');
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
                    window.location = "{{ route('roles.delete', ['id' => ':id']) }}".replace(':id', role);
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