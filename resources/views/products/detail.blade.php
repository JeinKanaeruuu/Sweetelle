@extends('layouts.app')

@section('content')
    <!-- Portfolio Details Section -->
    <section id="portfolio-details" class="portfolio-details section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <h1>Detail Produk</h1>

            <div class="row gy-4">

                <!-- Bagian Gambar Produk -->
                <div class="col-lg-8">
                    <div class="align-items-center">
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: auto; border-radius: 10px;">
                        </div>
                    </div>
                </div>

                <!-- Bagian Informasi Produk -->
                <div class="col-lg-4">
                    <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                        <h3>Informasi Produk</h3>
                        <ul>
                            <li><strong>Nama</strong>: {{ $product->name }}</li>
                            <li><strong>Kategori</strong>: {{ $product->category }}</li>
                            <li><strong>Sisa Stok</strong>: {{ $product->stock }} pcs</li>
                            <li><strong>Harga</strong>: Rp{{ number_format($product->price, 0, ',', '.') }}</li>
                            <li><strong>Diskon</strong>: {{ $product->discount_percentage }}%</li>
                            <li><strong>Minimal Pemesanan</strong>: <a href="#">Tidak ada</a></li>
                        </ul>
                    </div>
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>{{ $product->name }}</h2>
                        <p>
                            {{ $product->description }}
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section><!-- /Portfolio Details Section -->
@endsection
