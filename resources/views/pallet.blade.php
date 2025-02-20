@include("header")
  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Pallet Courier</h1>
        <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Pallet Pricing</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    
      
          <!-- Pricing Section -->
          <section id="pricing" class="pricing section" ng-app="pricingApp" ng-controller="pricingController">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <span>Pricing</span>
              <h2>Pricing</h2>
              <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
            
            <div class="container">
              <div class="row gy-4">
                <!-- Loop through pricing plans -->
                <div class="col-lg-4" ng-repeat="plan in pricingData" data-aos="zoom-in" data-aos-delay="100">
                  <div class="pricing-item">
                    <h3>@{{plan.title}}</h3>
                    <h4><sup>$</sup>@{{plan.price}}<span> / @{{plan.period}}</span></h4>
                    <ul>
                      <li ng-repeat="feature in plan.features"><i class="bi bi-check"></i> <span>@{{feature}}</span></li>
                      <li class="na" ng-repeat="disabled in plan.disabledFeatures"><i class="bi bi-x"></i> <span>@{{disabled}}</span></li>
                    </ul>
                    <a href="#" class="buy-btn">@{{plan.buttonText}}</a>
                  </div>
                </div>
              </div>
            </div>
          <!-- End Pricing Section -->
      
          <!-- Alt Pricing Section -->
          <section id="alt-pricing" class="alt-pricing section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
              <span>Alt Pricing</span>
              <h2>Alt Pricing</h2>
              <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div>
      
            <div class="container">
              <!-- Loop through pricing plans in an alternate layout -->
              <div class="row gy-4 pricing-item" ng-repeat="plan in pricingData" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                  <h3>@{{plan.title}}</h3>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                  <h4><sup>$</sup>@{{plan.price}}<span> / @{{plan.period}}</span></h4>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                  <ul>
                    <li ng-repeat="feature in plan.features"><i class="bi bi-check"></i> <span>@{{feature}}</span></li>
                  </ul>
                </div>
                <div class="col-lg-3 d-flex align-items-center justify-content-center">
                  <div class="text-center"><a href="#" class="buy-btn">@{{plan.buttonText}}</a></div>
                </div>
              </div>
            </div>
          </section>
          </section><!-- End Alt Pricing Section -->
      
        
      
  </main>

  <script>
    var app = angular.module('pricingApp', []);
  
    app.controller('pricingController', function($scope, $http) {
      $scope.pricingData = [];
      
      // Fetch pricing data from JSON file
      $http.get('assets/data/pricing.json').then(function(response) {
        $scope.pricingData = response.data.pricing;
      }, function(error) {
        console.error("Error fetching pricing data:", error);
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

