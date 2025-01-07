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
            <div class="portfolio-content h-100">
              <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid" style="height: 450px; width: auto; object-fit: cover;" alt="{{ $product->name }}">
            </div>
            
            <!-- Info Produk -->
            <div class="product-info text-center">
              <h4 class="my-4 text-center">{{ $product->name }}</h4>
              <style>
                hr {
                  height: 2px;
                  background: 0;
                  border-top: 0;
                  border-bottom: 5px solid black;
                  border-left: 0;
                  border-right: 0;
                  margin: 0 auto;
                  margin-top: 10px;
                  margin-bottom: 30px;
                  width: 150px;
                  text-align: center;
                }
              </style>
              <hr>
              {{-- <p class="stock"><strong>Stok:</strong> {{ $product->stock }} pcs</p> --}}
              <a href="{{ route('product.details', $product->id) }}" style="background-color : #496f16" class="btn border-0 text-white">
              Selengkapnya</a>
            </div>
          </div><!-- End Portfolio Item -->
          @endforeach
        </div>
      </div>
    </div>
  </section><!-- /Portfolio Section -->
@endsection
