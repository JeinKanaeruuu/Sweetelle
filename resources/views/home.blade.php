@extends('layouts.app')

@section('content')
<!-- Hero Section -->
    <section id="hero" class="hero section">
        @php
            $landingPage = \App\Models\LandingPages::where('image_title', 'Landing')->first();
            $imageUrl = $landingPage && $landingPage->image_url 
                ? $landingPage->image_url 
                : asset('assets/images/test.jpg');
        @endphp

        <!-- Masukkan URL gambar ke dalam src tag -->
        <img src="{{ $imageUrl }}" alt="Landing Page" data-aos="fade-in">

        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <h2 data-aos="fade-up" data-aos-delay="100">Aneka Kue Tradisional dan Modern untuk Momen Istimewa Anda</h2>
              <p data-aos="fade-up" data-aos-delay="200">Kue nampan, kue tampah, bubur madura, rujak buah, hingga snackbox. Sweetelle siap melengkapi setiap acara Anda dengan kelezatan istimewa..</p>
              <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                <a href="{{ route('product') }}" id="plant-based">Eksplor Produk Kami
                  <div class="icon-new">
                    <svg viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <rect width="500" height="500" fill="url(#pattern0_3_5)"/>
                      <defs>
                        <pattern id="pattern0_3_5" patternContentUnits="objectBoundingBox" width="1" height="1">
                          <use xlink:href="#image0_3_5" transform="scale(0.002)"/>
                        </pattern>
                        <image id="image0_3_5" width="500" height="500" xlink:href="assets/img/bougenville.png">
                      </defs>
                    </svg>
                  </div>
                </a>
                {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
              </div>
  
            </div>
          </div>
        </div>
  
    </section>
    <!-- /Hero Section -->

    <!-- Carousel Promo -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <!-- Carousel Indicators -->
      <div class="carousel-indicators">
          @php
              $landingPages = \App\Models\LandingPages::where('image_title', 'promo')->get();
          @endphp

          @foreach ($landingPages as $index => $landingPage)
              <button type="button" 
                      data-bs-target="#carouselExampleIndicators" 
                      data-bs-slide-to="{{ $index }}" 
                      class="{{ $index === 0 ? 'active' : '' }}" 
                      aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                      aria-label="Slide {{ $index + 1 }}">
              </button>
          @endforeach
      </div>
      
      <!-- Carousel Inner -->
      <div class="carousel-inner">
          @foreach ($landingPages as $index => $landingPage)
              @php
                  $imageUrl = $landingPage->image_url ?? asset('assets/images/test.jpg');
              @endphp

              <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                  <img src="{{ $imageUrl }}" alt="Promo {{ $index + 1 }}" class="d-block w-100" data-aos="fade-in">
              </div>
          @endforeach
      </div>

      <!-- Carousel Navigation -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- /Carousel Promo -->
  

    <!-- About Section -->
    <section id="about" class="about section section-bg dark-background">

      <div class="container position-relative">

        <div class="row gy-5">

          <div class="content col-xl-5 d-flex flex-column" data-aos="fade-up" data-aos-delay="100">
            <h3>Mengapa pilih<span style="font-family: 'railey'; color: #fcf9d6;">
              Sweetelle</span> ?</h3>
            <p>
              Kami berpengalaman bertahun-tahun membantu menghadirkan pilihan kue yang menggoda selera, mulai dari kue nampan, kue tampah, bubur madura, rujak buah, hingga puding manis. Cocok untuk acara ulang tahun, hantaran istimewa, hingga snackbox praktis untuk berbagai momen. Sweetelle, karena setiap acara pantas dirayakan dengan rasa terbaik.
            </p>
            <a href="#" class="about-btn align-self-center align-self-xl-start"><span>Produk Kami</span> <i class="bi bi-chevron-right"></i></a>
          </div>

          <div class="col-xl-7" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-basket-fill"></i>
                <h4><a href="" class="stretched-link">Pilihan Beragam</a></h4>
                <p>Aneka kue tradisional dan modern yang menggugah selera, siap melengkapi momen spesial Anda.</p>
              </div><!-- Icon-Box -->

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-award-fill"></i>
                <h4><a href="" class="stretched-link">Kualitas Terbaik</a></h4>
                <p>Dibuat dengan bahan segar dan berkualitas tinggi untuk kelezatan tanpa kompromi.</p>
              </div><!-- Icon-Box -->

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-gift-fill"></i>
                <h4><a href="" class="stretched-link">Desain Elegan</a></h4>
                <p>Penampilan yang cantik, cocok untuk hantaran, ulang tahun, dan acara spesial.</p>
              </div><!-- Icon-Box -->

              <div class="col-md-6 icon-box position-relative">
                <i class="bi bi-emoji-smile-fill"></i>
                <h4><a href="" class="stretched-link">Pelayanan Profesional</a></h4>
                <p>Sweetelle berkomitmen memberikan layanan terbaik untuk kepuasan Anda.</p>
              </div><!-- Icon-Box -->

            </div>
          </div>

        </div>

      </div>

    </section>
    <!-- /About Section -->

        <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Kumpulan Karya Ter-<span style="font-family: 'railey'; color: #496f16; font-size: 40px;">
          Sweet  </span>Kami untuk Berbagai Momen Istimewa Anda.</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row mb-4">
          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              <div class="col portfolio-item isotope-item filter-app">
                <div class="portfolio-content h-100">
                  <img src="assets/img/portfolio/tumpeng_kue.png" style="width: 100%; height: 500px; object-fit: cover;" alt="">
                  <div class="portfolio-info">
                    <h4 class="text-dark">Best Seller</h4>
                    <p>Tumpeng Kue</p>
                    <a href="assets/img/portfolio/tumpeng_kue.png" title="Tumpeng Kue" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="{{ route('product') }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div><!-- End Portfolio Item -->
            </div>
          </div>
        </div>
        <div class="row py-4">
          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              <div class="col portfolio-item isotope-item filter-app">
                <div class="portfolio-content h-100">
                  <img src="assets/img/portfolio/kue_tampah_bulat.png" style="width: 100%; height: 500px; object-fit: cover;" alt="">
                  <div class="portfolio-info">
                    <h4 class="text-dark">2</h4>
                    <p>Kue Tampah Bulat</p>
                    <a href="assets/img/portfolio/kue_tampah_bulat.png" title="Kue Tampah Bulat" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="{{ route('product') }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div><!-- End Portfolio Item -->
            </div>
          </div>
        </div>
        <div class="row py-4">
          <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
              <div class="col portfolio-item isotope-item filter-app">
                <div class="portfolio-content h-100">
                  <img src="assets/img/portfolio/kue_hantaran.png" style="width: 100%; height: 500px; object-fit: cover;" alt="">
                  <div class="portfolio-info">
                    <h4 class="text-dark">Kue-kue</h4>
                    <p>Kue Hantaran</p>
                    <a href="assets/img/portfolio/kue_hantaran.png" title="Kue Hantaran Pernikahan" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                    <a href="{{ route('product') }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                  </div>
                </div>
              </div><!-- End Portfolio Item -->
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>Apa Kata Mereka Tentang <span style="font-family: 'railey'; color: #496f16; font-size: 40px;">
          Sweetelle ?</span></p>
      </div><!-- End Section Title -->

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
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 10
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section>
    <!-- /Testimonials Section -->

@endsection
