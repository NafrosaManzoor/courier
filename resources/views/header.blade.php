<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Logis Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
 


  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
  <!-- =======================================================
  * Template Name: Logis
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <!-- Bootstrap CSS 
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->
<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Courier Service</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          
          <li><a href="/index" class="">Home<br></a></li>
          <li><a href="/about">About</a></li>
          <li><a href="/service">Services</a></li>
          <li class="dropdown"><a href="#"><span>Pricing</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="/express">Express Courier</a></li>
              <li><a href="/standard">Standard Courier</a></li>
              <li><a href="/pallet">Pallet Courier</a></li>
              <li><a href="/international">International Courier</a></li>
            </ul>
    
          <li><a href="/contact">Contact</a></li>
        </ul> 
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
         
      </nav>

      <a class="btn-getstarted" href="/track_quote">Parcel</a>
      <a class="btn-getstarted" href="/track">Track</a>
      <a class="btn-getstarted" href="/admin.layout">Admin</a>
      <button type="button" class="btn-getstarted" data-toggle="modal" data-target="#loginModal">Login</button>


    </div>
  </header>
  

  

<!-- Modal HTML Structure -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     
      <div class="modal-body">
        <!-- Login Form -->
        <form action="/user_login" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" placeholder="Enter username" required>
          </div><br>
          <div class="form-group">
            <label for="password">Password</label><br>
            <input type="password" class="form-control" id="password" placeholder="Password" required>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Login</button>
          <!-- Add a Register button -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <!-- Register Form -->
        <form action="/user_register" method="post">
          <div class="form-group">
            <label for="reg_username">Username</label>
            <input type="text" class="form-control" id="reg_username" placeholder="Enter username" required>
          </div><br>
          <div class="form-group">
            <label for="reg_email">Email</label>
            <input type="email" class="form-control" id="reg_email" placeholder="Enter email" required>
          </div><br>
          <div class="form-group">
            <label for="reg_password">Password</label>
            <input type="password" class="form-control" id="reg_password" placeholder="Enter password" required>
          </div>
          <br>
          <button type="submit" class="btn btn-primary">Register</button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>