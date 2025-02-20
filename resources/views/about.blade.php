@include("header")

<main class="main">

  <!-- Page Title -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
    <div class="container position-relative">
      <h1>About Us</h1>
      <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="index.html">Home</a></li>
            <li class="current">About</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- About Section -->
  <section id="about" class="about section" ng-app="aboutApp" ng-controller="aboutController" >
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
<!-- End About Section -->

  <!-- Stats Section -->
<section id="stats" class="stats section" >

    <div class="container" data-aos="fade-up" data-aos-delay="100">
  
      <div class="row gy-4">
  
        <div class="col-lg-3 col-md-6" ng-repeat="stat in statsData">
          <div class="stats-item text-center w-100 h-100">
            <span  class="count">@{{stat.count}}</span>
            <p class="title">@{{stat.title}}</p>
          </div>
        </div>
  
      </div>
  
    </div>
</section>
    
  
  
  <!-- End Stats Section -->

  <!-- Team Section -->
   <!-- Section Title -->
   <section id="team" class="team section">
   <div class="container section-title" data-aos="fade-up">
    <span>Our Team<br></span>
    <h2>Our Team</h2>
    <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
   </div><!-- End Section Title -->

  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up"  ng-repeat="member in teamData">
        <div class="member">
          <img ng-src="@{{ member.image }}" class="img-fluid" alt="">
          <div class="member-content">
            <h4 class="name">@{{ member.name }}</h4>
            <span class="role">@{{ member.role }}</span>
            <p class="description">@{{ member.description }}</p>
            <div class="social">
              <a ng-href="@{{ member.social.twitter }}"><i class="bi bi-twitter"></i></a>
              <a ng-href="@{{ member.social.facebook }}"><i class="bi bi-facebook"></i></a>
              <a ng-href="@{{ member.social.instagram }}"><i class="bi bi-instagram"></i></a>
              <a ng-href="@{{ member.social.linkedin }}"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div><!-- End Team Member -->
    </div>
  </div>
   </section>

<!-- /Team Section -->
   <!-- End Team Section -->

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials section dark-background">

    <img src="assets/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
              {
                "loop": true,
                "speed": 600,
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
  
  <!-- /Faq Section -->
  
  


</main>

<script>
  // AngularJS App for About Section
  var aboutApp = angular.module('aboutApp', []);
  aboutApp.controller('aboutController', function($scope, $http) {
    $http.get('assets/data/features.json').then(function(response) {
      $scope.pageData = response.data;}, 
      function(error) {
        console.error('Error fetching featured services:', error);
    });
  

  // AngularJS App for Stats Section
  
    $http.get('assets/data/data.json').then(function(response) {
      $scope.statsData = response.data;}, 
      function(error) {
        console.error('Error  fetching featured services:', error);
      });
    
  

  // AngularJS App for Team Section
  
    $http.get('assets/data/team.json').then(function(response) {
      $scope.teamData = response.data;}, 
      function(error) {
        console.error('Error fetching featured services:', error);
    });
  

  // AngularJS App for Testimonials Section
  
    $http.get('assets/data/test.json').then(function(response) {
      $scope.testimonialsData = response.data;}, 
      function(error) {
        console.error('Error fetching featured services:', error);
    });
  
    // Swiper Initialization
    var swiper = new Swiper('.swiper', {
        loop: true,
        speed: 5000,
        autoplay: {
            delay:5000,
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
