main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>Get a Tracking</h1>
            <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Get A Tracking</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Get A Quote Section -->
    <section id="get-a-quote" class="get-a-quote section" ng-app="trackingApp" ng-controller="TrackingController">
        <div class="container">
            <div class="row g-0" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5 quote-bg" style="background-image: url(assets/img/quote-bg.jpg);"></div>
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                    <form name="quoteForm" action="http://localhost:3000/formData" method="post" class="php-email-form" ng-submit="submitForm()" novalidate>

                        <div class="col-12 text-center">
                            <h3>Parcel Travel Details</h3>
                        </div>
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.parcel_no" class="form-control" placeholder="Parcel Number" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.weight" class="form-control" placeholder="Total Weight (kg)" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.dimensions" class="form-control" placeholder="Dimensions (cm)" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.distric" class="form-control" placeholder="District" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.division" class="form-control" placeholder="Division" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.departure" class="form-control" placeholder="Address of Departure" required>
                            </div>

                            <div class="col-md-6">
                                <input type="text" ng-model="formData.delivery" class="form-control" placeholder="Address of Delivery" required>
                            </div>

                            <div class="col-12 text-center">
                                <h4>Your Personal Details</h4>
                            </div>

                            <div class="col-12">
                                <input type="text" ng-model="formData.name" class="form-control" placeholder="Name" required>
                            </div>

                            <div class="col-12">
                                <input type="email" ng-model="formData.email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="col-12">
                                <input type="text" ng-model="formData.phone" class="form-control" placeholder="Phone" required>
                            </div>

                            <div class="col-12 text-center"> 
                                <div class="loading" ng-show="isLoading">Loading...</div>
                                <div class="error-message" ng-if="errorMessage">@{{ errorMessage }}</div>
                                <div class="sent-message" ng-if="successMessage">@{{ successMessage }}</div>

                                <button type="submit">Get a Track</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Quote Form -->
            </div>
        </div>
    </section><!-- /Get A Quote Section -->
</main>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script> --}}
<script>
    var app = angular.module('trackingApp', []);

    app.controller('TrackingController', function($scope, $http) {
        $scope.formData = {};
        $scope.successMessage = "";
        $scope.errorMessage = "";
        $scope.isLoading = false;

        // Function to calculate the distance between two points using the Haversine formula
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius of the Earth in kilometers
            const dLat = (lat2 - lat1) * (Math.PI / 180);
            const dLon = (lon2 - lon1) * (Math.PI / 180);
            const a = 
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) * 
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            const distance = R * c; // Distance in kilometers
            return distance;
        }

        // Simulated coordinates for departure and delivery for demo purposes
        function getCoordinates(address) {
            // Here you would call an API like Google Maps Geocoding API to get real coordinates
            // For demonstration, return dummy coordinates
            if (address === 'Address of Departure') {
                return { lat: 23.8103, lon: 90.4125 }; // Example: Dhaka, Bangladesh
            } else if (address === 'Address of Delivery') {
                return { lat: 22.3475, lon: 91.8123 }; // Example: Chittagong, Bangladesh
            }
        }

        // Example usage
const departure = getCoordinates('Address of Departure');
const delivery = getCoordinates('Address of Delivery');

// Calculate the distance between the two addresses
const distance = calculateDistance(departure.lat, departure.lon, delivery.lat, delivery.lon);

console.log(`Distance: ${distance.toFixed(2)} kilometers`);

        // Submit form data as JSON
        $scope.submitForm = function() {
    $scope.isLoading = true; // Show loading message

    // Calculate the distance between departure and delivery
    var departureCoords = getCoordinates($scope.formData.departure);
    var deliveryCoords = getCoordinates($scope.formData.delivery);
    var total_km = calculateDistance(departureCoords.lat, departureCoords.lon, deliveryCoords.lat, deliveryCoords.lon);
    $scope.formData.total_km = total_km;

    var jsonData = angular.toJson($scope.formData); // Convert form data to JSON

    $http.post('http://localhost:3000/formData', jsonData)
        .then(function(response) {
            console.log('Response:', response); // Add logging to capture success response
            $scope.successMessage = "Your parcel details have been sent successfully. Distance: " + total_km + " km.";
        }, function(error) {
            console.log('Error:', error); // Add logging to capture errors
            $scope.errorMessage = "Error saving form data: " + error.data.message;
        })
        .finally(function() {
            console.log('Request finished'); // Add logging to track completion
            $scope.isLoading = false; // Hide loading message
        });
};
    });

</script>
