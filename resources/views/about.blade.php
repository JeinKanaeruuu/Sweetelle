@extends('layouts.app')

@section('content')


  <!-- About Section -->
  <section id="blog-details" class="blog-details section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Tentang Kami</h2>
      <div class="row">
        <div class="col">
          <img src="assets/img/sweetelle-logo.jpg" class="img-fluid" style="max-height: 300px;" alt="">
        </div>
        <div class="col">
          <p class="text-start">
            <span style="font-family: 'railey'; color: #496f16; font-size: 30px;">
              Sweetelle </span>lahir dari kecintaan kami terhadap jajanan tradisional Indonesia yang berpadu dengan sentuhan modern. Berdiri sejak [tahun berdirinya], kami memiliki visi untuk membawa kelezatan kue dan jajanan pasar ke setiap momen istimewa Anda. Dari kue tampah tradisional hingga kue ulang tahun dengan desain elegan, setiap produk kami dirancang untuk menciptakan kenangan manis.
          </p>
          <p class="text-start mt-4">
            Kami bangga menjadi bagian dari berbagai acara penting, mulai dari pesta ulang tahun, pengajian, seminar, hingga perayaan hari besar. Dengan bahan-bahan berkualitas tinggi, proses produksi yang higienis, dan dedikasi untuk menciptakan rasa yang sempurna, Sweetelle selalu berkomitmen untuk memberikan yang terbaik kepada pelanggan kami.
          </p>
        </div>
      </div>
      <div class="row my-4">
        <div class="content">
          <h2>Visi Kami</h2>
          <blockquote class="fs-4 fst-italic fw-medium">
            "Menjadi penyedia kue dan jajanan pasar terbaik yang memadukan kelezatan tradisional dengan inovasi modern, serta menghadirkan kebahagiaan di setiap gigitan."
          </blockquote>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h2>Misi Kami</h2>
          <ol class="text-start fw-normal fst-italic">
            <li>Menghadirkan produk kue dan jajanan pasar dengan kualitas terbaik yang dibuat dari bahan-bahan segar dan higienis.</li>
            <li>Menjaga keaslian cita rasa jajanan tradisional Indonesia dengan sentuhan inovasi untuk memenuhi selera modern.</li>
            <li>Memberikan pelayanan terbaik yang berorientasi pada kepuasan pelanggan.</li>
            <li>Menjadi mitra andalan untuk berbagai acara, mulai dari acara keluarga hingga kebutuhan korporat.</li>
          </ol>
        </div>
        <div class="col">
          <h2>Nilai Kami</h2>
          <ol class="text-start fw-normal fst-italic">
            <li>Kualitas: Selalu menggunakan bahan-bahan terbaik untuk menciptakan produk berkualitas.</li>
            <li>Inovasi: Menggabungkan keaslian tradisional dengan kreativitas modern.</li>
            <li>Pelayanan: Fokus pada kebutuhan dan kepuasan pelanggan.</li>
            <li>Kebahagiaan: Membawa senyum melalui setiap produk yang kami ciptakan.</li>
          </ol>
        </div>
      </div>
    </div><!-- End Section Title -->
  </section>

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


@endsection
