@include("header")

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Services</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Services</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section" ng-app="featuredServiceApp" ng-controller="featuredServiceController">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100" ng-repeat="service in featuredServices">
            <div class="icon flex-shrink-0"><i class="@{{ service.icon }}"></i></div>
            <div>
              <h4 class="title">@{{ service.title }}</h4>
              <p class="description">@{{ service.description }}</p>
             
            </div>
          </div>
        </div>
      </div>




      <section id="services" class="services section">

      <div class="container section-title" data-aos="fade-up">
        <span>Our Services<br></span>
        <h2>Our Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->
    
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" ng-repeat="ourservice in ourServices" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <div class="card-img">
                <img ng-src="@{{ourservice.image}}" alt="image" class="img-fluid">
              </div>
              <h3 class="title">@{{ourservice.title}}</h3>
              <p class="description">@{{ourservice.description}}</p>
              <a href="#" class="readmore stretched-link"><span>@{{ ourservice.linkText }}</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      
    </section>
    </section>
    
    
    
    {{-- <section id="services" class="services section" ng-app="featuredServiceApp" ng-controller="featuredServiceController"> --}}
      <!-- Section Title -->
      {{-- <div class="container section-title" data-aos="fade-up">
        <span>Our Services<br></span>
        <h2>Our Services</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->
    
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" ng-repeat="ourservice in ourServices" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <div class="card-img">
                <img ng-src="@{{ourservice.image}}" alt="image" class="img-fluid">
              </div>
              <h3 class="title">@{{ourservice.title}}</h3>
              <p class="description">@{{ourservice.description}}</p>
            </div>
          </div>
        </div>
      </div> --}}

      {{-- <div class="container"> 
        <div class="row gy-4">
          <!-- ng-repeat iterates over the ourServices array -->
          <div class="col-lg-4 col-md-6" ng-repeat="ourservice in ourServices" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <div class="card-img">
                <!-- Use ng-src to dynamically bind the image source -->
                <img ng-src="{{ ourservice.image }}" alt="{{ ourservice.title }}" class="img-fluid">
              </div>
              <h3 class="title">{{ ourservice.title }}</h3>
              <p class="description">{{ ourservice.description }}</p>
            </div>
          </div>
        </div>
      </div> --}}
      
    {{-- </section> --}}
    
    

    <!-- Services Section -->
  <!-- /Services Section -->

    <!-- Features Section -->
    
    <!-- Testimonials Section -->
 
    
    

  </main>

  <script>
    // AngularJS Application for Featured Services
    var featuredApp = angular.module('featuredServiceApp', []);
    featuredApp.controller('featuredServiceController', function($scope, $http) {
      $http.get('assets/data/featured-services.json').then(function(response) {
        $scope.featuredServices = response.data;
      }, function(error) {
        console.error('Error fetching featured services:', error);
      });

      $http.get('assets/data/ourservices.json').then(function(response) {
        $scope.ourServices = response.data;
        console.log($scope.ourServices);
      }, function(error) {
        console.error('Error fetching our services:', error);
      });
    });
  
   
  </script>
  


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  @include("footer")

</body>

</html>