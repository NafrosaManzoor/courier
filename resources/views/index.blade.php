@include("header")

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background" >

      <img src="assets/img/world-dotted-map.png" alt="" class="hero-bg" data-aos="fade-in">

      <div class="container">
        <div class="row gy-4 d-flex justify-content-between">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2 data-aos="fade-up">Your Lightning Fast Delivery Partner</h2>
            <p data-aos="fade-up" data-aos-delay="100">Facere distinctio molestiae nisi fugit tenetur repellat non praesentium nesciunt optio quis sit odio nemo quisquam. eius quos reiciendis eum vel eum voluptatem eum maiores eaque id optio ullam occaecati odio est possimus vel reprehenderit</p>

            <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up" data-aos-delay="200">
              <input type="text" class="form-control" placeholder="Your ZIP code or City. e.g. New York">
              <button type="submit" class="btn btn-primary">Search</button>
            </form>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.svg" class="img-fluid mb-3 mb-lg-0" alt="">
          </div>
        </div>
      </div>
    </section>

    

    <!-- /Hero Section -->

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
    



    
    <!-- /Featured Services Section -->

    <!-- About Section -->
  <section id="about" class="about section">
    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
          <img src="assets/img/about.jpg" class="img-fluid" alt="">
          <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
        </div>

        <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
          <h3>About Us</h3>
          <p>
            Dolor iure expedita id fuga asperiores qui sunt consequatur minima. Quidem voluptas deleniti. Sit quia molestiae quia quas qui magnam itaque veritatis dolores. Corrupti totam ut eius incidunt reiciendis veritatis asperiores placeat.
          </p>
          <ul>
            <div ng-repeat="feature in pageData">
           <li>
            <i class="@{{ feature.icon }}"></i>
            <div>
            <h5 class="title">@{{ feature.title }}</h5>
            <p class="description">@{{ feature.description }}</p>
           </li>
          </div>
         </ul>
        </div>
    </div>
  </section>
<!-- End About Section -->


    <!-- Services Section -->
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
    
    <!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="assets/img/cta-bg.jpg" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Call To Action</h3>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <a class="cta-btn" href="#">Call To Action</a>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

   <!-- Features Section -->
   <section id="features" class="features section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <span>Features</span>
      <h2>Features</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div>

    <div class="container" ng-repeat="feature in features">

      <div class="row gy-4 align-items-center features-item">
        <!-- Alternate Image and Text layout -->
        <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" ng-if="$index % 2 === 0">
          <img ng-src="@{{feature.image}}" class="img-fluid" alt="">
        </div>
        <div class="col-md-7" data-aos="fade-up">
          <h3>@{{feature.title}}</h3>
          <p class="fst-italic">@{{feature.description}}</p>
          <ul>
            <li ng-repeat="detail in feature.details"><i class="bi bi-check"></i> <span>@{{detail}}</span></li>
          </ul>
        </div>
        <!-- Image on the right for odd index items -->
        <div class="col-md-5 d-flex align-items-center order-1 order-md-2" data-aos="zoom-out" ng-if="$index % 2 !== 0">
          <img ng-src="@{{feature.image}}" class="img-fluid" alt="">
        </div>
      </div>

    </div>

  </section>

    

     <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section dark-background">

    <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 5000,
                "autoplay": {
                  "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                  "el": ".swiper-pagination",
                  "type": "bullets",
                  "clickable": true
                }
              }
            </script>
            <div class="swiper-wrapper">
                <div class="swiper-slide" ng-repeat="testimonial in testimonialsData">
                    <div class="testimonial-item">
                        <img ng-src="@{{testimonial.image}}" class="testimonial-img" alt="">
                        <h3 class="name">@{{testimonial.name}}</h3>
                        <h4 class="role">@{{testimonial.role}}</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill" ng-repeat="n in [].constructor(testimonial.stars) track by $index"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span class="quote">@{{testimonial.quote}}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>

  <!-- End Testimonials Section -->
  
    <section id="faq" class="faq section">
      <div class="container section-title" data-aos="fade-up">
        <span>Frequently Asked Questions</span>
        <h2>Frequently Asked Questions</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div>
  
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-10">
            <div class="faq-container">
              <div class="faq-item" ng-repeat="faq in faqs" ng-click="toggleFaq($index)" ng-class="{'faq-active': faq.active}" data-aos="fade-up" data-aos-delay="@{{200 + $index * 100}}">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3 class="question">@{{ faq.question }}</h3>
                <div class="faq-content" ng-show="faq.active">
                  <p class="answer">@{{ faq.answer }}</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right" ng-class="{'bi-chevron-down': faq.active, 'bi-chevron-right': !faq.active}"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </section>
<!-- /Faq Section -->

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
      //about
      $http.get('assets/data/features.json').then(function(response) {
      $scope.pageData = response.data;}, 
      function(error) {
        console.error('Error fetching featured services:', error);
    });
    //testi
    $http.get('assets/data/test.json').then(function(response) {
      $scope.testimonialsData = response.data;}, 
      function(error) {
        console.error('Error fetching featured services:', error);
    });
  
    // Swiper Initialization
    var swiper = new Swiper('.swiper', {
        loop: true,
        speed: 5,
        autoplay: {
            delay:5,
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
    });

  

  // AngularJS App for FAQ Section

   $http.get('assets/data/faq.json').then(function(response) {
        $scope.faqs = response.data;
  
        // Initialize all FAQ items as inactive
        $scope.faqs.forEach(function(faq) {
          faq.active = false;
        });
      });
  
      // Function to toggle the active status of each FAQ
      $scope.toggleFaq = function(index) {
        // Toggle the 'active' status of the clicked FAQ
        $scope.faqs[index].active = !$scope.faqs[index].active;
      };

      // AngularJS App for Stats Section
  
    $http.get('assets/data/data.json').then(function(response) {
      $scope.statsData = response.data;}, 
      function(error) {
        console.error('Error fetching featured services:', error);
      });

      $http.get('assets/data/index_features.json').then(function(response) {
        $scope.features = response.data.features;
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