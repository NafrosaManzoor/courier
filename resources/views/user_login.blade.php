@include("header")


<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>Get login </h1>
            <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current">Login</li>
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
                            <h3>User Details</h3>
                        </div>
                       <div class="row gy-4 justify-content-center">

                            <div class="col-md-8" >
                                <input type="text" ng-model="formData.name" class="form-control" placeholder="User Name" required>
                            </div>

                            <div class="col-md-8">
                                <input type="text" ng-model="formData.email" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="col-md-8">
                                <input type="password" ng-model="formData.password" class="form-control" placeholder="Password" required>
                            </div>

                            <div class="col-md-8">
                                <input type="password" ng-model="formData.c_password" class="form-control" placeholder="Confirm Password" required>
                            </div>

                           
                            <div class="col-12 text-center"> 

                                <button type="submit">Login</button>
                                <button type="submit" onclick="window.location.href='/user_login'">Register</button>
                                
                            </div>

                        </div>
                    </form>
                </div><!-- End Quote Form -->
            </div>
        </div>
    </section><!-- /Get A Quote Section -->
</main>


<!-- Include AngularJS -->




@include("footer")

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
