<!DOCTYPE html>
<html lang="en" ng-app="reportApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Parcel Report</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
@extends('admin.layout')
@section('title', 'Parcel Report')
@section('content')
<body ng-controller="ReportController">
<div class="container mt-5">
    <div class="col-lg-12">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                    <label for="status" class="mx-1">Status</label>
                    <select id="status" ng-model="selectedStatus" class="custom-select custom-select-sm col-sm-3">
                        <option value="all" ng-selected="selectedStatus === 'all'">All</option>
                        <option ng-repeat="status in statusArr" ng-value="$index" ng-selected="selectedStatus === $index">@{{ status }}</option>
                    </select>
                    <label for="date_from" class="mx-1">From</label>
                    <input type="date" id="date_from" ng-model="dateFrom" class="form-control form-control-sm col-sm-3">
                    <label for="date_to" class="mx-1">To</label>
                    <input type="date" id="date_to" ng-model="dateTo" class="form-control form-control-sm col-sm-3">
                    <button class="btn btn-sm btn-primary mx-1 bg-gradient-primary" type="button" ng-click="loadReport()">View Report</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-success float-right" ng-show="printVisible" id="print" ng-click="printReport()"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>
                        <table class="table table-bordered" id="report-list">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Date</th>
                                    <th>Sender</th>
                                    <th>Recipient</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in reportList">
                                    <td>@{{ $index + 1 }}</td>
                                    <td>@{{ item.date_created }}</td>
                                    <td>@{{ item.sender_name }}</td>
                                    <td>@{{ item.recipient_name }}</td>
                                    <td>@{{ item.price }}</td>
                                    <td>@{{ item.status }}</td>
                                </tr>
                                <tr ng-if="!reportList.length">
                                    <th class="text-center" colspan="6">No result.</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="details d-none">
        <p><b>Date Range:</b> <span class="drange"></span></p>
        <p><b>Status:</b> <span class="status-field">All</span></p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script>
    var app = angular.module('reportApp', []);
    app.controller('ReportController', function($scope, $http) {
        $scope.statusArr = [
            "Item Accepted by Courier",
            "Collected",
            "Shipped",
            "In-Transit",
            "Arrived At Destination",
            "Out for Delivery",
            "Ready to Pickup",
            "Delivered",
            "Picked-up",
            "Unsuccessful Delivery Attempt"
        ];
        $scope.selectedStatus = 'all';
        $scope.dateFrom = '';
        $scope.dateTo = '';
        $scope.reportList = [];
        $scope.printVisible = false;

        
        // Load report data
$scope.loadReport = function() {
    if (!$scope.dateFrom || !$scope.dateTo) {
        alert("Please select dates first.");
        return;
    }

    let requestData = {
        status: $scope.selectedStatus,
        date_from: $scope.dateFrom,
        date_to: $scope.dateTo
    };

    // Log the request data
    console.log("Requesting report with:", requestData);

    // Updated URL to the Laravel route
    $http.post('{{ route("generate.report") }}', requestData)
        .then(function(response) {
            $scope.reportList = response.data;
            $scope.printVisible = $scope.reportList.length > 0;
            if (!$scope.reportList.length) {
                alert("No results found.");
            }
        })
        .catch(function(error) {
            // Log detailed error information
            console.error('Error response:', error);
            alert("An error occurred while loading the report.");
        });
};

        // Print report
        $scope.printReport = function() {
            var printWindow = window.open('', '', 'height=700,width=900');
            var content = `
                <h3 class="text-center"><b>Report</b></h3>
                <p><b>Date Range:</b> ${$scope.dateFrom} to ${$scope.dateTo}</p>
                <p><b>Status:</b> ${$scope.selectedStatus > -1 ? $scope.statusArr[$scope.selectedStatus] : 'All'}</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Sender</th>
                            <th>Recipient</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${$scope.reportList.map((item, index) => `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.date_created}</td>
                                <td>${item.sender_name}</td>
                                <td>${item.recipient_name}</td>
                                <td>${item.price}</td>
                                <td>${item.status}</td>
                            </tr>
                        `).join('')}
                        ${$scope.reportList.length === 0 ? `
                            <tr>
                                <th class="text-center" colspan="6">No result.</th>
                            </tr>
                        ` : ''}
                    </tbody>
                </table>
            `;
            printWindow.document.write(content);
            printWindow.document.close();
            printWindow.print();
        };
    });
</script>

@endsection

</body>
</html>
