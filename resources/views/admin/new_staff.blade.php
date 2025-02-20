<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manage Staff</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
@extends('admin.layout')
@section('title', 'Add New Staff')
@section('content')
<body>
<div class="container mt-5">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form id="staffForm" action="{{ route('staff.save') }}" method="POST">
                @csrf
            
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg" class="alert" style="display: none;"></div>
            
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Staff Information</h4>
                                <div class="form-group">
                                    <label for="first_name">Staff Id</label>
                                    <input type="text" name="staff_id" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="branch_id">Branch</label>
                                    <select name="branch_id" class="form-control" required>
                                        <option value="">Select Branch</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <small class="form-text text-muted">Leave this blank if you don't want to change the password.</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer border-top border-info">
                            <div class="d-flex w-100 justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary">Save</button>&nbsp; &nbsp;
                                <a class="btn btn-secondary" href="{{ route('staff.index') }}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- jQuery script to handle form submission -->
<script>
    $(document).ready(function () {
        $('#staffForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from reloading the page

            let formData = $(this).serialize(); // Serialize form data
            let url = $(this).attr('action'); // Get form action URL

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function (response) {
                    $('#msg').removeClass('alert-danger').addClass('alert-success').html(response.message).show();
                    // Redirect or refresh the page after success
                    setTimeout(function () {
                        window.location.href = '{{ route('staff.index') }}'; // Redirect to staff listing page
                    }, 2000); // Optional delay before redirect
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;
                    let errorMsg = '';
                    $.each(errors, function (key, value) {
                        errorMsg += value[0] + '<br>';
                    });
                    $('#msg').removeClass('alert-success').addClass('alert-danger').html(errorMsg).show();
                }
            });
        });
    });
</script>

@endsection  

</body>
</html>
