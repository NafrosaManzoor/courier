<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Parcel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>
@extends('admin.layout')
@section('title', 'Edit Parcel')
@section('content')
<body>
<div class="container mt-5">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form id="parcelForm" action="{{ $parcel ? route('parcels.update', $parcel->id) : route('parcels.store') }}" method="POST">
                @csrf
    @if($parcel)
        @method('PUT') <!-- Specify update request -->
    @endif
            
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg" class="alert" style="display: none;"></div>

                        <div class="row">
                            
                            <div class="col-md-4">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="item_accepted" {{ $parcel && $parcel->type === 'item_accepted' ? 'selected' : '' }}>Item Accepted</option>
                                    <option value="collected" {{ $parcel && $parcel->type === 'collected' ? 'selected' : '' }}>Collected</option>
                                    <option value="shipped" {{ $parcel && $parcel->type === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="in_transit" {{ $parcel && $parcel->type === 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                    <option value="arrived_at_destination" {{ $parcel && $parcel->type === 'arrived_at_destination' ? 'selected' : '' }}>Arrived At Destination</option>
                                    <option value="out_for_delivery" {{ $parcel && $parcel->type === 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                    <option value="ready_to_pickup" {{ $parcel && $parcel->type === 'ready_to_pickup' ? 'selected' : '' }}>Ready to Pickup</option>
                                    <option value="delivered" {{ $parcel && $parcel->type === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="picked_up" {{ $parcel && $parcel->type === 'picked_up' ? 'selected' : '' }}>Picked-up</option>
                                    <option value="unsuccessful_delivery" {{ $parcel && $parcel->type === 'unsuccessful_delivery' ? 'selected' : '' }}>Unsuccessful Delivery</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="branch_id">Branch</label>
                                <select name="branch_id" class="form-control" required>
                                    <option value="">Select Branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" 
                                            {{ isset($parcel) && $parcel->branch_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="staff_id">Staff</label>
                                <select name="staff_id" class="form-control" required>
                                    <option value="">Select Staff</option>
                                    @foreach($staff as $staffMember)
                                        <option value="{{ $staffMember->id }}" 
                                            {{ isset($parcel) && $parcel->staff_id == $staffMember->id ? 'selected' : '' }}>
                                            {{ $staffMember->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr>

                        <h4>Parcel Information</h4>
                        <div class="row">
                            @foreach(['weight', 'height', 'length', 'width', 'price'] as $field)
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="{{ $field }}">{{ ucfirst($field) }}</label>
                                        <input type="text" name="{{ $field }}" id="{{ $field }}" class="form-control"
                                               value="{{ old($field, $parcel->$field ?? '') }}" required>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <input type="text" name="weight" id="weight" class="form-control" value="{{ old('weight', $parcel->weight ?? '') }}" required>
                                <input type="text" name="height" id="height" class="form-control" value="{{ old('height', $parcel->height ?? '') }}" required>
                                <input type="text" name="length" id="length" class="form-control" value="{{ old('length', $parcel->length ?? '') }}" required>
                                <input type="text" name="width" id="width" class="form-control" value="{{ old('width', $parcel->width ?? '') }}" required>
                                <input type="text" name="price" id="price" class="form-control" value="{{ old('price', $parcel->price ?? '') }}" required> --}}

                        <div class="card-footer border-top border-info">
                            <div class="d-flex w-100 justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary">Update</button>&nbsp; &nbsp;
                                <a class="btn btn-secondary" href="{{ route('parcels.index') }}">Cancel</a>
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
        $('#parcelForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from reloading the page
            console.log("Form submitted"); // Debug log

            let formData = $(this).serialize(); // Serialize form data
            let url = $(this).attr('action'); // Get form action URL

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#msg').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                    setTimeout(function () {
                        window.location.href = "{{ route('parcels.index') }}"; // Redirect to list page after success
                    }, 2000);
                },
                error: function (xhr) {
                    $('#msg').removeClass('alert-success').addClass('alert-danger').text('Error occurred while updating parcel.').show();
                    // Display validation errors if present
                    if (xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#msg').append('<div>' + value[0] + '</div>');
                        });
                    }
                }
            });
        });
    });
</script>
@endsection
</body>
</html>

