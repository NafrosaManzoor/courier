<!DOCTYPE html>
<html lang="en" ng-app="branchApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Parcels</title>

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
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="card-tools">
                    <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="{{ route('parcels.create') }}">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered" id="list">
                    <thead>
                        <tr>
                            <th class="text-center">Id</th>
                            <th>Branch ID</th>
                            <th>Staff ID</th>
                            <th>Reference Number</th>
                            <th>Sender Name</th>
                            <th>Recipient Name</th>
                            <th>Weight</th>
                            <th>Height</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $parcels = DB::table('new_parcels')->orderBy('created_at', 'desc')->get();
                        @endphp
                        @foreach($parcels as $row)
                            @php
                                $branch = $branches->firstWhere('id', $row->branch_id);
                                $staffMember = $staff->firstWhere('id', $row->staff_id);
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td><b>{{ $branch ? $branch->branch_id : 'N/A' }}</b></td>
                                <td><b>{{ $staffMember ? $staffMember->staff_id : 'N/A' }}</b></td>
                                <td><b>{{ $row->reference_number }}</b></td>
                                <td><b>{{ ucwords($row->sender_name) }}</b></td>
                                <td><b>{{ ucwords($row->recipient_name) }}</b></td>
                                <td><b>{{ $row->weight }}</b></td>
                                <td><b>{{ $row->height }}</b></td>
                                <td><b>{{ $row->length }}</b></td>
                                <td><b>{{ $row->width }}</b></td>
                                <td><b>{{ $row->price }}</b></td>
                                <td class="text-center">
                                    <span>{{ ucwords(str_replace('_', ' ', $row->type)) }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        {{-- <button type="button" class="btn btn-info btn-flat view_parcel" data-id="{{ $row->id }}">
                                            <i class="fas fa-eye"></i> --}}
                                        </button>
                                        <a href="{{ route('parcels.edit', $row->id) }}" class="btn btn-primary btn-flat">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-flat delete_parcel" data-id="{{ $row->id }}">
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

    <script>
        $(document).ready(function() {
            $('#list').DataTable();

            $('.view_parcel').click(function() {
                uni_modal("Parcel's Details", "view_parcel.php?id=" + $(this).attr('data-id'), "large");
            });

            $('.delete_parcel').click(function() { 
                const id = $(this).data('id');
                if (confirm("Are you sure you want to delete this parcel?")) {
                    $.ajax({
                        url: '{{ route("parcels.destroy", ":id") }}'.replace(':id', id),
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(resp) {
                            if (resp.status === 'success') {
                                alert("Data successfully deleted.");
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
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
