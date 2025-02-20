
    <section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <span>Our Services<br></span>
      <h2>Our ServiceS</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-4 col-md-6" ng-repeat="ourservice in ourservices" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-img">
              <img ng-src="@{{ ourservice.image }}" alt="image" class="img-fluid">
            </div>
            <h3 class="title">@{{ ourservice.title }}</h3>
            <p class="description ">@{{ ourservice.description }}</p>
          </div>
        </div>
      <!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-2.jpg" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">Logistics</a></h3>
            <p>Asperiores provident dolor accusamus pariatur dolore nam id audantium ut et iure incidunt molestiae dolor ipsam ducimus occaecati nisi</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-3.jpg" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">Cargo</a></h3>
            <p>Dicta quam similique quia architecto eos nisi aut ratione aut ipsum reiciendis sit doloremque oluptatem aut et molestiae ut et nihil</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-4.jpg" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">Trucking</a></h3>
            <p>Dicta quam similique quia architecto eos nisi aut ratione aut ipsum reiciendis sit doloremque oluptatem aut et molestiae ut et nihil</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-5.jpg" alt="" class="img-fluid">
            </div>
            <h3>Packaging</h3>
            <p>Illo consequuntur quisquam delectus praesentium modi dignissimos facere vel cum onsequuntur maiores beatae consequatur magni voluptates</p>
          </div>
        </div><!-- End Card Item -->

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="card">
            <div class="card-img">
              <img src="assets/img/service-6.jpg" alt="" class="img-fluid">
            </div>
            <h3><a href="#" class="stretched-link">Warehousing</a></h3>
            <p>Quas assumenda non occaecati molestiae. In aut earum sed natus eatae in vero. Ab modi quisquam aut nostrum unde et qui est non quo nulla</p>
          </div>
        </div><!-- End Card Item -->

      </div>

    </div>

  </section>

  <script>
    var app = angular.module('ourserviceApp', []);
     app.controller('OurserviceController', ['$scope', '$http', function ($scope, $http) {
      $scope.ourservices
      // Fetch services from JSON file
      $http.get('assest/data/ourservice.json').then(function (response) {
        $scope.ourservices = response.data;},
        function(error) {
          console.error('Error fetching services:', error);
      });
    }]);
  </script>
