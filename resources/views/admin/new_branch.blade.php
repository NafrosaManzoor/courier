<!DOCTYPE html> 
<html lang="en" ng-app="branchApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Manage Branch</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</head>
@extends('admin.layout')

@section('content')
<body ng-controller="BranchController">
<div class="container mt-5">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <form name="branchForm" ng-submit="saveBranch()" action="{{ route('branches.store') }}" method="POST">
                @csrf
            
                <div class="row">
                    <div class="col-md-12">
                        <div id="msg" ng-if="msg" class="alert alert-@{{msgType}}">
                            @{{ msg }}
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="branch_id">Branch Code</label>
                                <input type="text" name="branch_id" ng-model="branch.branch_id" class="form-control" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="street">Street/Building</label>
                                <input name="street" ng-model="branch.street" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="city">City/Division</label>
                                <input name="city" ng-model="branch.city" class="form-control" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="state">State/District</label>
                                <input name="state" ng-model="branch.state" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="zip_code">Zip Code/Postal Code</label>
                                <input name="zip_code" ng-model="branch.zip_code" class="form-control" required></textarea>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="country">Country</label>
                                <input name="country" ng-model="branch.country" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="contact">Contact</label>
                                <input name="contact" ng-model="branch.contact" class="form-control" required></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer border-top border-info">
                    <div class="d-flex w-100 justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary center">Save</button>&nbsp; &nbsp;
                        <a class="btn btn-secondary" href="/admin.list_branch">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

<!-- AngularJS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

<script>
    var app = angular.module('branchApp', []);
    app.controller('BranchController', function($scope, $http) {
        $scope.branch = {};

        // Save branch data
        $scope.saveBranch = function() {
            $http.post('/branches', $scope.branch, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(function(response) {
                if (response.data.status === 'success') {
                    $scope.msg = response.data.message;
                    $scope.msgType = 'success';
                } else {
                    $scope.msg = response.data.message;
                    $scope.msgType = 'danger';
                }
            })
            .catch(function(error) {
                $scope.msg = 'An error occurred while saving the branch.';
                $scope.msgType = 'danger';
            });
        };
    });
</script>
@endsection  

</body>
</html>
