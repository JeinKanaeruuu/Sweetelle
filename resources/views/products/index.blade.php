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

        <!-- Portfolio Filters (remove or customize as needed) -->
        <ul class="portfolio-filters isotope-filters">
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

        <div class="row gy-4 isotope-container">
          <style>
            .portfolio-content {
              position: relative;
              overflow: hidden;
              border-radius: 5px;
            }
        
            .portfolio-content img {
              display: block;
              width: 100%;
              height: 250px;
              object-fit: cover;
              border-radius: 5px;
            }

            /* Styling untuk container nama dan stok di bawah gambar */
            .product-info {
              padding: 1rem;
              background-color: #fff;
              border-radius: 5px;
              box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
              text-align: center;
              position: relative;
              top: -20px;
            }

            .product-info h4 {
              font-size: 1.2rem;
              font-weight: bold;
              margin-bottom: 0.5rem;
            }

            .product-info p {
              font-size: 0.9rem;
              margin-bottom: 1rem;
            }

            .product-info .stock {
              font-size: 1rem;
              font-weight: bold;
              margin-top: 0.5rem;
              color: #333;
            }

            /* Styling untuk ikon link dan zoom-in */
            .product-info .product-links {
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              display: none; /* Sembunyikan secara default */
              gap: 15px;
            }

            .product-info .product-links a {
              font-size: 1.5rem;
              color: #333;
              transition: color 0.3s ease;
            }

            /* Hover efek pada produk untuk menampilkan ikon */
            .portfolio-content:hover .product-links {
              display: flex;
            }

            .portfolio-item {
              display: flex;
              flex-direction: column;
              justify-content: space-between;
              position: relative;
            }

          </style>

          @foreach($products as $product)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ strtolower(str_replace(' ', '-', $product->category)) }}">
              <div class="portfolio-content h-100">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}">
              </div>

              <!-- Info Produk di bawah gambar -->
              <div class="product-info">
                <h4>{{ $product->name }}</h4>
                <p>{{ $product->description }}</p>
                <p class="stock"><strong>Stok:</strong> {{ $product->stock }} pcs</p> <!-- Stok produk selalu terlihat -->

                <!-- Ikon-ikon link yang hanya muncul saat hover pada produk -->
                <div class="product-links">
                  <a href="{{ asset('storage/'.$product->image) }}" title="{{ $product->name }}" data-gallery="portfolio-gallery-{{ strtolower(str_replace(' ', '-', $product->category)) }}" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="{{ route('product.details', $product->id) }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
          @endforeach
        </div>
        
      </div>
    </div>

  </section><!-- /Portfolio Section -->
@endsection
