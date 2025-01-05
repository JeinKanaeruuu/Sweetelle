@extends('layouts.app')

@section('content')
    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">
      {{-- <style>
        .banner{
          background-image: url("{{ asset('assets/img/banner.png') }}");
          background-size: cover;  /* Menutupi seluruh lebar dan tinggi */
          background-position: center;
          height: 100px;  /* Menentukan tinggi banner agar lebih pendek */
          width: 100%;
          align-items: center;
          justify-content: center;
          margin-top: 0;
          margin-bottom: 20px;
          margin-left: 0;
          margin-right: 0;
        }
      </style> --}}
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        
        <div class="row" style="margin-top: -20px; margin-bottom: 80px;">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Tombol Sebelumnya -->
                @if($previousProduct)
                <a href="{{ route('product.details', $previousProduct->id) }}" class="btn btn-circle" style="background-color: #496f16; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-left" style="color: #fff;"></i>
                </a>
                @endif
                <h1>{{ $product->name }}</h1>
                <!-- Tombol Berikutnya -->
                @if($nextProduct)
                <a href="{{ route('product.details', $nextProduct->id) }}" class="btn btn-circle" style="background-color: #496f16; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-right" style="color: #fff;"></i>
                </a>
                @endif
            </div>
            
        </div>

            <div class="row gy-4">

                <!-- Bagian Gambar Produk -->
                <div class="col-lg-4">
                    <div class="align-items-center">
                        <div class="swiper-slide">
                          <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width: 350px; height: 480px; border-radius: 0; object-fit:cover">
                        </div>
                    </div>
                </div>                

                <!-- Bagian Informasi Produk -->
                <div class="col-lg-4">
                  <h3>Informasi Produk</h3>
                  <hr>
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300" style="margin-top: -20px;">
                      <span class="badge text-light" style="background-color: #FFD700">{{ $product->category }}</span>
                      <h2>{{ $product->name }}</h2>
                      <h3 class="my-2">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                      </h3>
                      <ul style="font-family: raleway">
                          <li><strong>Sisa Stok</strong>: {{ $product->stock }} pcs</li>
                          <li><strong>Diskon</strong>: {{ $product->discount_percentage }}%</li>
                          <li><strong>Minimal Pemesanan</strong>: Tidak ada</li>
                      </ul>
                        <p>
                          {{ $product->description }}
                        </p>
                        <a href="{{ route('products.index') }}" class="btn text-white" style="color: #496f16;"> Kembali</a>
                    </div>
                </div>

                <div class="col-lg-4">
                  <div class="portfolio-info text-center" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="fw-normal">Waktu Beroperasi</h3> 
                    <div class="row text-center pb-4" style="font-family: raleway;">
                      <p class="fw-medium">Senin - Sabtu</p>
                      <p style="color: #496f16">07.00 s/d 16.00 WITA</p>
                      <p class="fw-medium">Order Minimal H-1</p>
                    </div>
                    <h3 class="fw-normal pt-2">Pesan Cepat</h3> 
                    <div class="row text-center" style="font-family: raleway;">
                      <p class="fw-medium">WhatsApp</p>
                      <p style="color: #496f16">07.00 s/d 16.00 WITA</p>
                      <p class="fw-medium">Order Minimal H-1</p>
                    </div>
                  </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->
@endsection
