@extends('layouts.app')

@section('content')
  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section">
    <!-- Section Title -->
    <div class="container section-title">
      <h2>Produk Kami</h2>
    </div><!-- End Section Title -->

    <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <!-- Portfolio Filters -->
        <ul class="portfolio-filters isotope-filters">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-kue-satuan">Kue Satuan</li>
          <li data-filter=".filter-snack-box">Snack Box</li>
          <li data-filter=".filter-kue-nampan">Kue Nampan</li>
          <li data-filter=".filter-kue-tampah-bambu">Kue Tampah Bambu</li>
          <li data-filter=".filter-jajan-pasar">Jajan Pasar</li>
          <li data-filter=".filter-bubur-traditional">Bubur Traditional</li>
          <li data-filter=".filter-tampah-rujak-buah">Tampah Rujak Buah</li>
          <li data-filter=".filter-tampah-rebusan">Tampah Rebusan</li>
          <li data-filter=".filter-tumpeng-tower-kue">Tumpeng Tower Kue</li>
          <li data-filter=".filter-bolu-cake">Bolu / Cake</li>
          <li data-filter=".filter-kue-kering">Kue Kering / Kletikan</li>
          <li data-filter=".filter-hantaran-kue">Hantaran Kue</li>
          <li data-filter=".filter-hantaran-pernikahan">Hantaran Pernikahan</li>
        </ul><!-- End Portfolio Filters -->

        <!-- Portfolio Items -->
        <div class="row isotope-container" style="margin: 40px 0;">
          @foreach($products as $product)
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ strtolower(str_replace(' ', '-', $product->category)) }}" style="margin: 60px 0;">
            <div class="portfolio-content h-100 position-relative">
              <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" style="height: 450px; width: auto; object-fit: cover;" alt="{{ $product->name }}">
              <div class="portfolio-info">
                <!-- Tombol Quick View -->
                <a href="#" class="quick-view-btn d-flex align-items-center justify-content-center position-absolute" 
                   style="bottom: 0; left: 0; width: 100%; padding: 15px; background-color: rgba(73, 111, 22, 0.8); color: white; text-decoration: none;" 
                   data-bs-toggle="modal" data-bs-target="#quickViewModal{{ $product->id }}" 
                   data-image="{{ asset('storage/'.$product->image) }}">
                  <i class="bi bi-eye"></i> Quick View
                </a>
              </div>
            </div>

            <!-- Info Produk -->
            <div class="product-info text-center">
              <h4 class="my-4 text-center">{{ $product->name }}</h4>
              <hr>
              <a href="{{ route('product.details', $product->id) }}" style="background-color : #496f16" class="btn border-0 text-white">
                Selengkapnya
              </a>
            </div>
          </div><!-- End Portfolio Item -->

          <!-- Modal for Quick View -->
          <div class="modal fade" id="quickViewModal{{ $product->id }}" tabindex="-1" aria-labelledby="quickViewModalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="quickViewModalLabel{{ $product->id }}">Quick View</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                  <!-- Gambar besar akan ditampilkan di sini -->
                  <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="Product Image" style="max-height: 500px; object-fit: contain;">
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section><!-- /Portfolio Section -->
@endsection

@section('styles')
<style>
  /* Untuk memastikan portfolio-content relatif dan tombol berada di bawah gambar */
  .portfolio-content {
    position: relative;
    overflow: hidden;
  }

  .portfolio-content img {
    width: 100%;
    transition: transform 0.3s ease-in-out;
  }

  /* Gambar zoom saat dihover */
  .portfolio-content:hover img {
    transform: scale(1.1); /* Gambar akan sedikit membesar saat hover */
  }

  /* Tombol Quick View, secara default disembunyikan dan posisinya berada di bawah */
  .quick-view-btn {
    position: absolute;
    bottom: -60px; /* Tombol berada di bawah gambar saat tidak dihover */
    left: 0;
    width: 100%;
    padding: 15px 0;
    background-color: rgba(73, 111, 22, 0.8); /* Background hijau transparan */
    color: white;
    text-decoration: none;
    text-align: center;
    display: block; /* Menampilkan tombol */
    transition: all 0.3s ease-out; /* Efek transisi animasi */
    opacity: 0; /* Menyembunyikan tombol dengan opacity 0 */
  }

  .quick-view-btn i {
    margin-right: 8px;
  }

  /* Efek hover, tombol muncul dengan animasi dari bawah */
  .portfolio-content:hover .quick-view-btn {
    bottom: 0; /* Tombol naik ke bawah gambar */
    opacity: 1; /* Tombol muncul secara perlahan */
  }

  /* Hover efek untuk tombol */
  .quick-view-btn:hover {
    background-color: rgba(73, 111, 22, 1); /* Ubah warna background tombol saat dihover */
  }
</style>
@endsection

@section('scripts')
<script>
  var quickViewButtons = document.querySelectorAll('.quick-view-btn');
  quickViewButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
      // Mendapatkan gambar dari atribut data-image
      var imageUrl = event.target.getAttribute('data-image');
      
      // Mendapatkan elemen gambar di modal berdasarkan ID modal
      var modalImage = document.getElementById('quickViewModal' + event.target.getAttribute('data-bs-target').replace('#quickViewModal', '')).querySelector('img');
      
      // Update gambar modal dengan gambar yang dipilih
      modalImage.src = imageUrl;
    });
  });
</script>
@endsection
