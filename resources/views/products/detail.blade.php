@extends('layouts.app')

@section('content')
    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Tombol Sebelumnya -->
                @if($previousProduct)
                <a href="{{ route('product.details', $previousProduct->id) }}" class="btn btn-circle shadow" style="background-color: #496f16; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-left" style="color: #fff; font-size: 20px;"></i>
                </a>
                @endif
                <h1 class="text-uppercase text-center" style="font-family: 'Raleway', sans-serif; color: #333;">{{ $product->name }}</h1>
                <!-- Tombol Berikutnya -->
                @if($nextProduct)
                <a href="{{ route('product.details', $nextProduct->id) }}" class="btn btn-circle shadow" style="background-color: #496f16; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <i class="bi bi-chevron-right" style="color: #fff; font-size: 20px;"></i>
                </a>
                @endif
            </div>
        </div>

        <div class="row gy-5">
            <!-- Bagian Gambar Produk -->
            <div class="col-lg-6 text-center">
                <div class="product-image shadow" style="border-radius: 12px; overflow: hidden; width: 450px; height: 600px; margin: 0 auto;">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="object-fit: cover; width: 100%; height: 100%;">
                </div>
            </div>

            <!-- Bagian Informasi Produk -->
            <div class="col-lg-4">
                <h3 class="text-uppercase" style="font-family: 'Raleway', sans-serif; color: #496f16;">Informasi Produk</h3>
                <hr>
                <div class="portfolio-description">
                    <span class="badge text-light" style="background-color: #FFD700; font-size: 14px;">
                        {{ ucwords(str_replace('-', ' ', $product->category)) }}
                    </span>
                    <h2 class="mt-3">{{ $product->name }}</h2>
                    <h3 class="my-3 text-success fw-bold">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </h3>
                    <ul style="list-style: none; padding: 0; font-family: 'Raleway', sans-serif;">
                        <li><strong>Sisa Stok:</strong> {{ $product->stock }} pcs</li>
                        <li><strong>Minimal Pemesanan:</strong> Tidak ada</li>
                    </ul>
                    <p class="mt-3" style="color: #555;">{{ $product->description }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success mt-4" style="background-color: #496f16; border: none; font-size: 16px; padding: 10px 20px;">Kembali</a>
                </div>
            </div>

            <!-- Bagian Waktu dan Pesan Cepat -->
            <div class="col-lg-2">
                <div class="portfolio-info shadow p-4" style="background-color: #f9f9f9; border-radius: 8px;">
                    <h3 class="text-center text-uppercase" style="font-family: 'Raleway', sans-serif; color: #496f16;">Waktu Beroperasi</h3>
                    <p class="text-center mt-3" style="font-family: 'Raleway', sans-serif; font-size: 16px;">
                        <span class="fw-medium">Senin - Sabtu</span><br>
                        <span style="color: #496f16;">07.00 s/d 16.00 WITA</span>
                    </p>
                    <hr>
                    <h3 class="text-center text-uppercase pt-2" style="font-family: 'Raleway', sans-serif; color: #496f16;">Pesan Cepat</h3>
                    <p class="text-center mt-3" style="font-family: 'Raleway', sans-serif; font-size: 16px;">
                        <span class="fw-medium">WhatsApp</span><br>
                        <span style="color: #496f16;">07.00 s/d 16.00 WITA</span>
                    </p>
                </div>
            </div>
        </div>

      </div>
    </section><!-- /Portfolio Details Section -->
@endsection
