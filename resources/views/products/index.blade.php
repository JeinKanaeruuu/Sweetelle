@extends('layouts.app')

@section('content')
  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Produk Kami</h2>
    </div><!-- End Section Title -->

    <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <!-- Portfolio Filters (remove or customize as needed) -->
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-kue-tumpeng">Kue Tumpeng</li>
          <li data-filter=".filter-kue-hantaran">Kue Hantaran</li>
          <li data-filter=".filter-kue-tampah">Kue Tampah Bulat</li>
          <li data-filter=".filter-kue-nampan">Kue Nampan</li>
          <li data-filter=".filter-pudding">Pudding</li>
          <li data-filter=".filter-snack">Snack Box</li>
          <li data-filter=".filter-jajanan-pasar">Jajanan Pasar</li>
          <li data-filter=".filter-rujak-rebus">Rujak Buah</li>
          <li data-filter=".filter-bubur">Bubur</li>
          <li data-filter=".filter-cake">Cake</li>
        </ul><!-- End Portfolio Filters -->

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          <style>
            .portfolio-content {
              position: relative;
              overflow: hidden; /* Untuk mencegah elemen overlay keluar dari area gambar */
              border-radius: 5px; /* Agar gambar dan overlay memiliki bentuk bulat yang sama */
            }
        
            .portfolio-content img {
              display: block;
              width: 100%;
              height: auto;
              border-radius: 5px; /* Menyamakan dengan elemen lainnya */
            }
        
            .product-overlay {
              color: #fff;
              position: absolute;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              display: flex;
              flex-direction: column;
              justify-content: end; /* Konten berada di bawah */
              align-items: center;
              text-align: center; /* Text rata tengah */
              padding-bottom: 1rem; /* Jarak ke bawah */
            }
        
            .product-info h5 {
              font-size: 1.2rem;
              font-weight: 600;
              margin: 0 0 0.5rem 0;
            }
        
            .product-info p {
              font-size: 0.9rem;
              margin: 0;
            }
          </style>
        
          @foreach($products as $product)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ strtolower(str_replace(' ', '-', $product->category)) }}">
              <div class="portfolio-content position-relative">
                
                <!-- Gambar Produk -->
                <a href="{{ route('product.details', $product->id) }}" title="More Details" class="details-link">
                  <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}">
                </a>
        
                <!-- Overlay Selalu Tampil -->
                <div class="product-overlay">
                  <div class="product-info">
                    <h5 style="color: white">{{ $product->name }}</h5>
                    <p><strong>Stok:</strong> {{ $product->stock > 0 ? $product->stock : 'Habis' }}</p>
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