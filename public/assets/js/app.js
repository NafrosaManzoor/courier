// public/js/app.js
var app = angular.module('app', []);

app.controller('SidebarController', function($scope, $http) {
    // User session data (Mocking dynamic login types for demo)
    $scope.login_type = 1; // Change to 2 for staff view

    // Sidebar menu data fetched from a JSON source
    $scope.sidebarMenu = {
        dashboard: {
            name: 'Dashboard',
            icon: 'fas fa-tachometer-alt',
            link: './',
        },
        branches: {
            name: 'Branch',
            icon: 'fas fa-building',
            subMenu: [
                { name: 'Add New', link: './index.php?page=new_branch' },
                { name: 'List', link: './index.php?page=branch_list' }
            ]
        },
        staff: {
            name: 'Branch Staff',
            icon: 'fas fa-users',
            subMenu: [
                { name: 'Add New', link: './index.php?page=new_staff' },
                { name: 'List', link: './index.php?page=staff_list' }
            ]
        },
        parcels: {
            name: 'Parcels',
            icon: 'fas fa-boxes',
            subMenu: [
                { name: 'Add New', link: './index.php?page=new_parcel' },
                { name: 'List All', link: './index.php?page=parcel_list' },
            ]
        },
        tracking: {
            name: 'Track Parcel',
            icon: 'fas fa-search',
            link: './index.php?page=track',
        },
        reports: {
            name: 'Reports',
            icon: 'fas fa-file',
            link: './index.php?page=reports',
        }
    };

    // Statuses for parcels, fetched as dynamic JSON from a server (example data)
    $scope.parcelStatuses = [
        "Item Accepted by Courier", "Collected", "Shipped", "In-Transit", 
        "Arrived At Destination", "Out for Delivery", "Ready to Pickup", 
        "Delivered", "Picked-up", "Unsuccessful Delivery Attempt"
    ];
});
