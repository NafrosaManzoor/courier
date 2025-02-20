@include("admin.header")
<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<html lang="en" ng-app="adminApp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Bootstrap CSS or any other CSS/JS dependencies -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
</head>
<body ng-controller="AdminController">
  <aside class="main-sidebar sidebar-dark-primary elevation-4" ng-app="adminApp" ng-controller="AdminController">
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home active " ng-click="setActive('home')">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard </p>
            </a>
          </li>
          

          <!--<li class="nav-item">
            <a href="#" class="nav-link nav-edit_branch" ng-click="toggleBranch()">
              <i class="nav-icon fas fa-building"></i>
              <p> Branch <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview" ng-show="isBranchOpen">
              <li class="nav-item">
                <a href="./index.php?page=new_branch" class="nav-link nav-new_branch tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=branch_list" class="nav-link nav-branch_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
          

          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff" ng-click="toggleStaff()">
              <i class="nav-icon fas fa-users"></i>
              <p> Branch Staff <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview" ng-show="isStaffOpen">
              <li class="nav-item">
                <a href="./index.php?page=new_staff" class="nav-link nav-new_staff tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=staff_list" class="nav-link nav-staff_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Parcels Section 
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_parcel" ng-click="toggleParcel()">
              <i class="nav-icon fas fa-boxes"></i>
              <p> Parcels <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview" ng-show="isParcelOpen">
              <li class="nav-item">
                <a href="./index.php?page=new_parcel" class="nav-link nav-new_parcel tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=parcel_list" class="nav-link nav-parcel_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List All</p>
                </a>
              </li>
              <!-- Status Loop 
              <?php 
                $status_arr = array("Item Accepted<br/>by Courier","Collected","Shipped","In-Transit","Arrived At<br/>Destination","Out for Delivery","Ready to Pickup","Delivered","Picked-up","Unsuccessfull<br/>Delivery Attempt");
                foreach($status_arr as $k =>$v):
              ?>
              <li class="nav-item">
                <a href="./index.php?page=parcel_list&s=<?php echo $k ?>" class="nav-link nav-parcel_list_<?php echo $k ?> tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p><?php echo $v ?></p>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a href="./index.php?page=track" class="nav-link nav-track">
              <i class="nav-icon fas fa-search"></i>
              <p> Track Parcel </p>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="./index.php?page=reports" class="nav-link nav-reports">
              <i class="nav-icon fas fa-file"></i>
              <p> Reports </p>
            </a>
          </li> 
        </ul>
      </nav>
    </div>
</aside>

<!-- Include AngularJS 
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

<script>
    // AngularJS App and Controller
    angular.module('adminApp', [])
        .controller('AdminController', function($scope) {
            // Variables to control dropdown state
            $scope.isBranchOpen = false;
            $scope.isStaffOpen = false;
            $scope.isParcelOpen = false;

            // Toggle Branch dropdown
            $scope.toggleBranch = function() {
                $scope.isBranchOpen = !$scope.isBranchOpen;
            };

            // Toggle Staff dropdown
            $scope.toggleStaff = function() {
                $scope.isStaffOpen = !$scope.isStaffOpen;
            };

            // Toggle Parcel dropdown
            $scope.toggleParcel = function() {
                $scope.isParcelOpen = !$scope.isParcelOpen;
            };

            // Set active page
            $scope.setActive = function(page) {
                console.log("Navigating to:", page);
                // Perform navigation or other logic
            };
        });

    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='') page = page+'_'+s;

      if($('.nav-link.nav-'+page).length > 0){
        $('.nav-link.nav-'+page).addClass('active');
        if($('.nav-link.nav-'+page).hasClass('tree-item')){
          $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active');
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open');
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree')){
          $('.nav-link.nav-'+page).parent().addClass('menu-open');
        }
      }
    });
</script> -->
 <!-- Branch Menu -->
 
 <li class="nav-item" ng-class="{'menu-open': isBranchOpen}">
  <a href="#" class="nav-link " ng-click="toggleBranch()">
      <i class="fas fa-building nav-icon"></i> 
      <p>Branch <i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview">
      <li class="nav-item" ng-class="{'active': activePage === 'new_branch'}">
          <a href="/admin.new_branch" class="nav-link" ng-click="setActive('new_branch')">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>Add New</p>
          </a>
      </li>
      <li class="nav-item " ng-class="{'active': activePage === 'list_branch'}">
          <a href="/admin.list_branch" class="nav-link " ng-click="setActive('list_branch')">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>List</p>
          </a>
      </li>
  </ul>
</li>

<!-- Staff Menu -->
<li class="nav-item" ng-class="{'menu-open': isStaffOpen}">
  <a href="#" class="nav-link" ng-click="toggleStaff()">
      <i class="fas fa-users nav-icon"></i>
      <p>Branch Staff <i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview">
      <li class="nav-item" ng-class="{'active': activePage === 'new_staff'}">
          <a href="/admin.new_staff" class="nav-link" ng-click="setActive('new_staff')">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>Add New</p>
          </a>
      </li>
      <li class="nav-item" ng-class="{'active': activePage === 'list_staff'}">
          <a href="/admin.list_staff" class="nav-link" ng-click="setActive('list_staff')">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>List</p>
          </a>
      </li>
  </ul>
</li>

<!-- Parcels Menu --> 
<li class="nav-item" ng-class="{'menu-open': isParcelOpen}">
  <a href="#" class="nav-link" ng-click="toggleParcel()">
      <i class="fas fa-boxes nav-icon"></i>
      <p>Parcels <i class="right fas fa-angle-left"></i></p>
  </a>
  <ul class="nav nav-treeview">
      <li class="nav-item"ng-class="{'active': activePage === 'new_parcel'}">
          <a href="/admin.new_parcel" class="nav-link" ng-click="setActive('new_parcel')">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>Add New</p>
          </a>
      </li>
      <li class="nav-item" ng-class="{'active': activePage === 'list'}">
          <a href="/admin.list_parcel" class="nav-link" ng-click="setActive('list_parcel')">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>List All</p>
          </a>
      </li>
      <!-- Dynamically Generated Parcel Status -->
      {{-- <li class="nav-item" ng-repeat="(index, status) in parcelStatuses">
          <a href="/admin.list_parcel" class="nav-link" ng-click="setActive('parcel_status_' + index)">
              <i class="fas fa-angle-right nav-icon"></i>
              <p>@{{ status }}</p>
          </a>
      </li> --}}
  </ul>
</li>

<!-- Track Parcel -->
<li class="nav-item">
  <a href="/admin.tracking" class="nav-link" ng-click="setActive('tracking')">
      <i class="fas fa-search nav-icon"></i>
      <p>Track Parcel</p>
  </a>
</li>

<!-- Reports -->
<li class="nav-item">
  <a href="/admin.report" class="nav-link" ng-click="setActive('reports')">
      <i class="fas fa-file nav-icon"></i>
      <p>Reports</p>
  </a>
</li>
</ul>
</div>
</aside>
 <!-- Main Content -->
 <div class="content-wrapper">
  <section class="content">
      @yield('content')
  </section>
</div>
</body>

<!-- AngularJS Script -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
<script>
angular.module('adminApp', [])
.controller('AdminController', function($scope) {
// Control dropdown menus
$scope.isBranchOpen = false;
$scope.isStaffOpen = false;
$scope.isParcelOpen = false;

// Parcel statuses
$scope.parcelStatuses = [
"Item Accepted ",
"Collected",
"Shipped",
"In-Transit",
"Arrived At Destination",
"Out for Delivery",
"Ready to Pickup",
"Delivered",
"Picked-up",
"Unsuccessful Delivery "
];

// Toggle dropdowns
$scope.toggleBranch = function(autoExpand) {
$scope.isBranchOpen = autoExpand || !$scope.isBranchOpen;
};

$scope.toggleStaff = function(autoExpand) {
$scope.isStaffOpen = autoExpand || !$scope.isStaffOpen;
};

$scope.toggleParcel = function(autoExpand) {
$scope.isParcelOpen = autoExpand || !$scope.isParcelOpen;
};

// Simulate navigation action
$scope.setActive = function(page) {
console.log("Navigating to:", page);
// Implement further logic here
};
}); --}}
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular-route.min.js"></script>

<script>


angular.module('adminApp', [])
.controller('AdminController', function($scope) {
    // Control dropdown menus
    $scope.isBranchOpen = false;
    $scope.isStaffOpen = false;
    $scope.isParcelOpen = false;

    // Parcel statuses
    // $scope.parcelStatuses = [
    //     "Item Accepted ",
    //     "Collected",
    //     "Shipped",
    //     "In-Transit",
    //     "Arrived At Destination",
    //     "Out for Delivery",
    //     "Ready to Pickup",
    //     "Delivered",
    //     "Picked-up",
    //     "Unsuccessful Delivery"
    // ];

    // Toggle Branch dropdown
    $scope.toggleBranch = function() {
        $scope.isBranchOpen = !$scope.isBranchOpen;  // Open/close Branch
        $scope.isStaffOpen = false;                  // Close Staff
        $scope.isParcelOpen = false;                 // Close Parcels
    };

    // Toggle Staff dropdown
    $scope.toggleStaff = function() {
        $scope.isStaffOpen = !$scope.isStaffOpen;    // Open/close Staff
        $scope.isBranchOpen = false;                 // Close Branch
        $scope.isParcelOpen = false;                 // Close Parcels
    };

    // Toggle Parcel dropdown
    $scope.toggleParcel = function() {
        $scope.isParcelOpen = !$scope.isParcelOpen;  // Open/close Parcels
        $scope.isBranchOpen = false;                 // Close Branch
        $scope.isStaffOpen = false;                  // Close Staff
    };

    // Simulate navigation action

    $scope.setActive = function(page) {
    console.log("Navigating to:", page);
    $scope.activePage = page; // Store the active page

    // Logic to add/remove active classes can also be handled here
};

});

</script>



