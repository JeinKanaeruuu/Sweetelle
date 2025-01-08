<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sweetelle</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/sweetelle-logo.jpg') }}" rel="icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Presento
  * Template URL: https://bootstrapmade.com/presento-bootstrap-corporate-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ url('/#hero') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename" style="font-family: 'railey'; font-size: 4rem;">Sweetelle</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/#hero') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
          <li><a href="{{ url('/#carouselExampleIndicators') }}" class="{{ Request::is('*#carouselExampleIndicators*') ? 'active' : '' }}">Promo</a></li>
          <li><a href="{{ url('/#portfolio') }}" class="{{ Request::is('*#portfolio*') ? 'active' : '' }}">Portfolio</a></li>
          <li><a href="{{ route('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">Tentang</a></li>
          <li><a href="{{ route('products.index') }}" class="{{ Request::is('products*') ? 'active' : '' }}">Produk</a></li>          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('contact') }}">Hubungi Kami</a>

    </div>
  </header>

    <main class="main">
        @yield('content')
    </main>

    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6 footer-about">
              <a href="{{ url('/#hero') }}" class="logo d-flex align-items-center">
                <span class="sitename" style="font-family: 'railey'; color: #fcf9d6;">
                  Sweetelle</span>
              </a>
              <div class="footer-contact pt-3">
                <p>Jl.Contoh RT.</p>
                <p>Balikpapan, Kalimantan Timur 535022</p>
                <p class="mt-3"><strong>Phone:</strong> <span>+62 811-4880-2508</span></p>
                <p><strong>Email:</strong> <span>sweetelle@gmail.com</span></p>
              </div>
              <div class="social-links d-flex mt-4">
                <a href=""><i class="bi bi-twitter-x"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
    
            <div class="col-lg-2 col-md-3 footer-links">
              <h4>Navigasi</h4>
              <ul>
                <li><a href="{{ url('/#hero') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Produk</a></li>
                <li><a href="{{ url('/#promo') }}">Promo</a></li>
                <li><a href="{{ url('/#portfolio') }}">Portfolio</a></li>
                <li><a href="{{ route('about') }}">Tentang</a></li>
              </ul>
            </div>
    
            <div class="col-lg-4 col-md-3 footer-links">
                <h4>Produk Kami</h4>
              <div class="row my-2">
                <div class="col">
                  <ul>
                    <li><a href="{{ route('products.index') }}">Kue Tumpeng</a></li>
                    <li><a href="{{ route('products.index') }}">Kue Hantaran</a></li>
                    <li><a href="{{ route('products.index') }}">Kue Tampah Bulat</a></li>
                    <li><a href="{{ route('products.index') }}">Kue Nampan</a></li>
                    <li><a href="{{ route('products.index') }}">Pudding</a></li>
                  </ul>
                </div>
                <div class="col">
                  <ul>
                    <li><a href="{{ route('products.index') }}">Snack Box</a></li>
                    <li><a href="{{ route('products.index') }}">Jajanan Pasar</a></li>
                    <li><a href="{{ route('products.index') }}">Rujak Buah</a></li>
                    <li><a href="{{ route('products.index') }}">Bubur</a></li>
                    <li><a href="{{ route('products.index') }}">Cake</a></li>
                  </ul>    
                </div>
            </div>
          </div>
        </div>
        
        <div class="container copyright text-center mt-4">
          <p>© <span>Copyright</span> <strong class="px-1 sitename" style="font-family: 'railey'; color: #fcf9d6;">Sweetelle</strong> <span>All Rights Reserved</span> {{ date('Y') }}</p>
          <div class="credits">
          </div>
        </div>
    
      </footer>
    
      <!-- Scroll Top -->
      <a href="https://wa.me/6281148802508" target="_blank" class="whatsapp-fixed d-flex align-items-center justify-content-center" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Kontak WhatsApp Kami">
        <i class="bi bi-whatsapp"></i></a>
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
      <!-- Vendor JS Files -->
      <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
      <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
      <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
      <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
      <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    
      <!-- Main JS File -->
      <script src="{{ asset('assets/js/main.js') }}"></script>
    
    </body>
    
    </html>