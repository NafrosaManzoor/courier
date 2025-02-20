<!DOCTYPE html>
<html lang="en" ng-app="parcelApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Parcel Tracking</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
@extends('admin.layout')
@section('title', 'Parcel Tracking')
@section('content')
<body ng-controller="ParcelController">
<div class="container mt-5">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                <label for="">Enter Tracking Number</label>
                <div class="input-group col-sm-5">
                    <input type="search" id="ref_no" ng-model="trackingNumber" class="form-control form-control-sm" placeholder="Type the tracking number here">
                    <div class="input-group-append">
                        <button type="button" ng-click="trackParcel()" class="btn btn-sm btn-primary btn-gradient-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="timeline" id="parcel_history">
                <div class="iitem" ng-repeat="item in parcelHistory">
                    <i class="fas fa-box bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> <span class="dtime">@{{ item.date_created }}</span></span>
                        <div class="timeline-body">
                            @{{ item.status }}
                        </div>
                    </div>
                </div>
                <div ng-if="msg" class="alert alert-@{{ msgType }}">
                    @{{ msg }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script>
    var app = angular.module('parcelApp', []);
    app.controller('ParcelController', function($scope, $http) {
        $scope.trackingNumber = '';
        $scope.parcelHistory = [];
        $scope.msg = '';
        $scope.msgType = '';

        // Track parcel by tracking number
        $scope.trackParcel = function() {
            if (!$scope.trackingNumber) {
                $scope.parcelHistory = [];
                return;
            }

            $http.post('ajax.php?action=get_parcel_history', { ref_no: $scope.trackingNumber })
            .then(function(response) {
                if (Array.isArray(response.data)) {
                    $scope.parcelHistory = response.data;
                    $scope.msg = '';
                } else if (response.data == 2) {
                    $scope.msg = 'Unknown Tracking Number.';
                    $scope.msgType = 'danger';
                    $scope.parcelHistory = [];
                }
            })
            .catch(function(error) {
                console.error(error);
                $scope.msg = 'An error occurred while tracking the parcel.';
                $scope.msgType = 'danger';
                $scope.parcelHistory = [];
            });
        };
    });
</script>
@endsection  

</body>
</html>
