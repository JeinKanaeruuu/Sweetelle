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
          <li data-filter=".filter-tumpeng">Kue Tumpeng</li>
          <li data-filter=".filter-hantaran">Kue Hantaran</li>
          <li data-filter=".filter-tampah">Kue Tampah Bulat</li>
          <li data-filter=".filter-nampan">Kue Nampan</li>
          <li data-filter=".filter-pudding">Pudding</li>
          <li data-filter=".filter-snack">Snack Box</li>
          <li data-filter=".filter-jajanan">Jajanan Pasar</li>
          <li data-filter=".filter-rujak">Rujak Buah</li>
          <li data-filter=".filter-bubur">Bubur</li>
          <li data-filter=".filter-cake">Cake</li>
        </ul><!-- End Portfolio Filters -->

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          @foreach($products as $product)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ strtolower(str_replace(' ', '-', $product->category)) }}">
              <div class="portfolio-content h-100">
                <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}">
                <div class="portfolio-info">
                  <h4>{{ $product->name }}</h4>
                  <p>{{ $product->description }}</p>
                  <a href="{{ asset('storage/'.$product->image) }}" title="{{ $product->name }}" data-gallery="portfolio-gallery-{{ strtolower(str_replace(' ', '-', $product->category)) }}" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="{{ route('product.details', $product->id) }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
          @endforeach
        </div><!-- End Portfolio Container -->

      </div>
    </div>

  </section><!-- /Portfolio Section -->
@endsection
