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
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15956.046298445113!2d116.85806319702948!3d-1.1522234946112935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df149298f826ab5%3A0x8489d5309f45c0db!2sKalimantan%20Institute%20of%20Technology!5e0!3m2!1sen!2sid!4v1735925733735!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Contact Form -->

      <div class="row my-4">
        <div class="col-lg-6 ">
          <div class="row gy-4">
            <div class="col-lg-12">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt"></i>
                <h3>Alamat</h3>
                <p>Jl.Contoh RT.12 Kelurahan ... Kecamatan ... Kota ... Provinsi ...</p>
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
          <button id="contactbtn" ><i class="bi bi-whatsapp"></i> WhatsApp</button>
        </div>
        <div class="row my-4 mx-4">
        <button id="contactbtn"><i class="bi bi-instagram"></i> Instagram</button>
        </div>
      </div>

      </div>

    </div>

  </section>
  <!-- /Contact Section -->
@endsection

