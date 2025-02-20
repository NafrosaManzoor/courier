<!DOCTYPE html>
<html lang="en" ng-app="branchApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manage Staff</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    @extends('admin.layout')

    @section('content')
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{ route('staff.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Branch</th>
                            <th>Staff Id</th>
                            <th>Staff</th>
                            <th>Email</th>
                            <th>Branch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staffs as $key => $member)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <!-- Fetch branch ID from the member's related branch -->
                            <td><b>{{ $member->branch->branch_id ?? 'N/A' }}</b></td>
                            <td><b>{{ $member->staff_id }}</b></td>
                            <td><b>{{ ucwords($member->first_name . ' ' . $member->last_name) }}</b></td>
                            <td><b>{{ $member->email }}</b></td>
                            <td>
                                <b>
                                    {{ ucwords(($member->branch->street ?? '') . ', ' . 
                                               ($member->branch->city ?? '') . ', ' . 
                                               ($member->branch->state ?? '') . ', ' . 
                                               ($member->branch->zip_code ?? '') . ', ' . 
                                               ($member->branch->country ?? '')) }}
                                </b>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-primary btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_staff" data-id="{{ $member->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>

    <style>
        table td {
            vertical-align: middle !important;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#list').dataTable();

            // Handle delete action with CSRF token
            $('.delete_staff').click(function() {
                const id = $(this).data('id');
                if (confirm("Are you sure you want to delete this staff member?")) {
                    $.ajax({
                        url: '{{ route("staff.destroy", ":id") }}'.replace(':id', id),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(resp) {
                            if (resp.status === 'success') {
                                alert("Staff member successfully deleted.");
                                location.reload();
                            } else {
                                alert(resp.message);
                            }
                        }
                    });
                }
            });
        });
    </script>
    @endsection
</body>
</html>
