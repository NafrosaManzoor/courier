var app = angular.module('adminApp', []);

app.controller('AdminController', function($scope, $http) {
    // Active tab and form management
    $scope.activeTab = 'dashboard';
    $scope.activeForm = '';
    
    $scope.setActive = function(tab) {
        $scope.activeTab = tab;
        $scope.activeForm = '';
    };

    $scope.setActiveForm = function(form) {
        $scope.activeForm = form;
    };

    // Fetch branches from API
    $http.get('/api/branches').then(function(response) {
        $scope.branches = response.data;
    });

    // Add new branch
    $scope.newBranch = {};
    $scope.addBranch = function() {
        let newId = $scope.branches.length + 1;
        $scope.newBranch.id = newId;
        $scope.branches.push($scope.newBranch);
        $scope.newBranch = {}; // Reset form
    };
});

