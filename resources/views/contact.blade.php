@extends('layouts.app')

@section('content')
  <!-- Contact Section -->
  <section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Hubungi Kami</h2>
      <p>Tertarik dengan produk Sweetelle? Jangan ragu untuk menghubungi kami. Kami dengan senang hati membantu Anda!</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row mb-4">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2371.827490782845!2d116.84551732386312!3d-1.2141913175626047!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df1487dee9e0a69%3A0xa555cdeadbb5cc43!2sJl.%20LKMD%2C%20Batu%20Ampar%2C%20Kec.%20Balikpapan%20Utara%2C%20Kota%20Balikpapan%2C%20Kalimantan%20Timur%2076136!5e0!3m2!1sen!2sid!4v1736592950597!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Contact Form -->

      <div class="row my-4">
        <div class="col-lg-6 ">
          <div class="row gy-4">
            <div class="col-lg-12">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt"></i>
                <h3>Alamat</h3>
                <p>Jl.LKMD Batu Ampar, Balikpapan Utara, Kota Balikpapan, Kalimantan Timur 76136</p>
              </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone"></i>
                <h3>Call Us</h3>
                <p>+62 811-4880-2508</p>
              </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope"></i>
                <h3>Email Us</h3>
                <p>sweetelle@gmail.com</p>
              </div>
            </div><!-- End Info Item -->
          </div>
        </div>
      <div class="col-lg-6 text-center">
        <div class="row mx-4">
          <h3 class="mb-4">Kontak Kami Sekarang</h3>
        </div>
        <div class="row my-4 mx-4">
          <a href="https://wa.me/6281148802508" target="_blank" style="text-decoration: none;">
            <button id="contactbtn">
              <i class="bi bi-whatsapp"></i> WhatsApp
            </button>
          </a>
        </div>
        <button id="contactbtn"><i class="bi bi-instagram"></i> Instagram</button>
        </div>
      </div>

      </div>

    </div>

  </section>
  <!-- /Contact Section -->
@endsection

