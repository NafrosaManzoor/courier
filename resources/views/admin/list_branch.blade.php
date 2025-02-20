<!DOCTYPE html> 
<html lang="en" ng-app="branchApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Branch</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    @extends('admin.layout')

    @section('content')
    @csrf
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{ route('branches.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Branch Code</th>
                            <th>Street/Building</th>
                            <th>City/Division</th>
                            <th>State/District</th>
                            <th>Zip Code</th>
                            <th>Country</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($branches as $key => $branch)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td><b>{{ ($branch->branch_id) }}</b></td>
                            <td><b>{{ ucwords($branch->street) }}</b></td>
                            <td><b>{{ ucwords($branch->city) }}</b></td>
                            <td><b>{{ ucwords($branch->state) }}</b></td>
                            <td><b>{{ $branch->zip_code }}</b></td>
                            <td><b>{{ ucwords($branch->country) }}</b></td>
                            <td><b>{{ $branch->contact }}</b></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-primary btn-flat">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-flat delete_branch" data-id="{{ $branch->id }}">
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
            $('.delete_branch').click(function() {
            const id = $(this).data('id');
            if (confirm("Are you sure you want to delete this branch?")) {
                $.ajax({
                    url: '{{ route("branches.destroy", ":id") }}'.replace(':id', id),
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(resp) {
                        if (resp.status === 'success') {
                            alert("Branch successfully deleted.");
                            location.reload();
                        } else {
                            alert(resp.message);
                        }
                    },
                    error: function(xhr) {
                        alert("Error occurred: " + xhr.responseText);
                    }
                });
            }
        });

        });
    </script>
    @endsection
</body>
</html>
