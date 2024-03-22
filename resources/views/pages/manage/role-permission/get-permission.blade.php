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
                <div class="breadcrumb-item active"><a href="#">Manage User</a></div>
                <div class="breadcrumb-item"><a href="#">Role Permission</a></div>
                <div class="breadcrumb-item">Edit Role Permission</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-group">
                        <button type="button" class="list-group-item list-group-item-action active">
                            {{ $title ?? ''}}
                        </button>
                        @foreach($permissions as $permission)
                        @php $Selected = false; @endphp
                        @foreach ($rolePermissions as $rolePermission)
                        @if ($permission->name == $rolePermission->name)
                        @php $Selected = true; @endphp
                        @break
                        @endif
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ ucwords($permission->name)}}
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input permission" data-role="<?= $role->id ?>" data-permission="<?= $permission->id ?>" id="checkbox-<?= $permission->id ?>" {{ $Selected ? 'checked' : '' }}>
                                <label for="checkbox-<?= $permission->id ?>" class="custom-control-label">&nbsp;</label>
                            </div>
                        </li>
                        @endforeach
                    </ul>
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
    $(document).ready(function() {
        $(".permission").click(function() {
            var roleId = $(this).data('role');
            var permissionId = $(this).data('permission');
            var status = $(this).is(':checked');
            var action = ""


            if (status) {
                action = "insert"
            } else {
                action = "delete"
            }

            $.ajax({
                url: "{{ route('rolepermission.postPermission')}}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    permissionId: permissionId,
                    roleId: roleId,
                    action: action
                },
                success: function(data) {
                    let toast_success = data.toast_success;
                    if (toast_success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: toast_success
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing your request.'
                        });
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.'
                    });
                }
            });
        });
    });
</script>
@endpush