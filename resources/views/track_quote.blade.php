@include("header")
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
        <div class="container position-relative">
            <h1>Get a Tracking</h1>
            <p>Esse dolorum voluptatum ullam est sint nemo et est ipsa porro placeat quibusdam quia assumenda numquam molestias.</p>
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li class="current"> Customer Details</li>
                </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->

    <!-- Get A Quote Section -->
    <section id="get-a-quote" class="get-a-quote section">
        <div class="container">
            <div class="row g-0" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-5 quote-bg" style="background-image: url(assets/img/quote-bg.jpg);"></div>
                <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                    <form id="TrackingForm" action="{{ route('parcels.store') }}" method="POST">
                        @csrf <!-- Add CSRF token for security -->
                        <div id="msg" class="alert" style="display: none;"></div>

                        <div class="row gy-4">
                            <!-- Sender Information -->
                            <div class="col-md-6 text-center">
                                <h4>Sender Information</h4><br>
                                <div class="form-group mb-3">
                                    <input type="text" name="sender_name" id="sender_name" class="form-control" placeholder="Name" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" name="sender_email" id="sender_email" class="form-control" placeholder="Email" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="sender_address" id="sender_address" class="form-control" placeholder="Address" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="sender_contact" id="sender_contact" class="form-control" placeholder="Contact" required>
                                </div>
                            </div>

                            <!-- Recipient Information -->
                            <div class="col-md-6 text-center">
                                <h4>Recipient Information</h4><br>
                                <div class="form-group mb-3">
                                    <input type="text" name="recipient_name" id="recipient_name" class="form-control" placeholder="Name" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="email" name="recipient_email" id="recipient_email" class="form-control" placeholder="Email" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="recipient_address" id="recipient_address" class="form-control" placeholder="Address" required>
                                </div>

                                <div class="form-group mb-3">
                                    <input type="text" name="recipient_contact" id="recipient_contact" class="form-control" placeholder="Contact" required>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-center"> 
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div><!-- End Quote Form -->
            </div>
        </div>
    </section><!-- /Get A Quote Section -->
</main>
    </body>

<!-- jQuery script to handle form submission -->
<script>
    $(document).ready(function () {
        $('#TrackingForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from reloading the page

            let formData = $(this).serialize(); // Serialize form data
            let url = $(this).attr('action'); // Get form action URL

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function (response) {
                    $('#msg').removeClass('alert-danger').addClass('alert-success').html(response.message).show();
                    // Redirect or refresh the page after success
                    setTimeout(function () {
                        window.location.href = '/admin.list_parcel'; // Redirect to parcel listing page
                    }, 2000); // Optional delay before redirect
                },
                error: function (response) {
                    let errors = response.responseJSON.errors;
                    let errorMsg = '';
                    $.each(errors, function (key, value) {
                        errorMsg += value[0] + '<br>';
                    });
                    $('#msg').removeClass('alert-success').addClass('alert-danger').html(errorMsg).show();
                }
            });
        });
    });
</script>

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
</html>

