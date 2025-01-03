@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="hero relative bg-cover bg-center text-white py-24" 
    @php
        $landingPage = \App\Models\LandingPages::where('image_title', 'Landing')->first();
    @endphp
    style="background-image: url('{{ $landingPage && $landingPage->image_url ? $landingPage->image_url : asset('assets/images/test.jpg') }}');">

    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="container mx-auto text-center relative z-10">
        <h1 class="text-5xl md:text-6xl font-bold leading-tight animate-typing">Manisnya Tradisi, Nikmatnya Setiap Gigitan!</h1>
        <p class="mt-6 text-xl md:text-2xl animate-fade-in">Rambut Nenek Balikpapan: Cemilan Legendaris untuk Semua Momen.</p>
        <a href="#products" class="mt-12 inline-block text-white font-semibold py-3 px-6 rounded-full shadow-lg hover:scale-105 transform transition duration-300" style="background-color: #8b0330;">Eksplor Produk Kami</a>

    </div>
</section>

<!-- Features Section -->
<section class="features py-20 bg-gray-100">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold mb-12">Mengapa Belanja di Rambut Nenek?</h2>
        <div class="flex flex-wrap justify-center">
            <div class="feature w-full sm:w-1/2 lg:w-1/3 p-6 transition-transform transform hover:scale-105">
                <div class="mb-4 text-6xl" style="color: #8b0330;">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h3 class="text-2xl font-semibold">Pengiriman Cepat</h3>
                <p class="mt-4" style="color: #8b0330;">Nikmati produk kami yang sampai di tangan Anda dengan cepat dan tepat waktu.</p>
            </div>
            <div class="feature w-full sm:w-1/2 lg:w-1/3 p-6 transition-transform transform hover:scale-105">
                <div class="mb-4 text-6xl" style="color: #8b0330;">
                    <i class="fas fa-tags"></i>
                </div>
                <h3 class="text-2xl font-semibold">Harga Terjangkau</h3>
                <p class="mt-4" style="color: #8b0330;">Dapatkan produk berkualitas tinggi dengan harga yang bersahabat.</p>
            </div>
            <div class="feature w-full sm:w-1/2 lg:w-1/3 p-6 transition-transform transform hover:scale-105">
                <div class="mb-4 text-6xl" style="color: #8b0330;">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="text-2xl font-semibold">Dukungan 24/7</h3>
                <p class="mt-4" style="color: #8b0330;">Kami siap membantu Anda kapan saja dan di mana saja untuk pengalaman berbelanja yang lebih baik.</p>
            </div>
        </div>
    </div>
</section>

{{-- Product Grid --}}
<section id="products" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 md:px-8">
        <h2 class="text-4xl font-semibold text-center mb-12">Produk Terlaris Kami</h2>

        <!-- Filter Section -->
        <div class="mb-8 text-center">
            <form method="GET" action="{{ route('home') }}">
                <select name="sort_by" class="p-2 border border-gray-300 rounded">
                    <option value="asc" {{ request('sort_by') == 'asc' ? 'selected' : '' }}>Harga: Termurah ke Termahal</option>
                    <option value="desc" {{ request('sort_by') == 'desc' ? 'selected' : '' }}>Harga: Termahal ke Termurah</option>
                </select>
                <button type="submit" class="ml-4 py-2 px-6 bg-pink-600 text-white rounded">Terapkan Filter</button>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="relative bg-white p-6 rounded-lg shadow-md transition-transform transform hover:scale-105 duration-300 flex flex-col h-full">
                <a href="{{ route('product.show', $product->id) }}" class="flex-grow">
                    <div class="aspect-w-1 aspect-h-1">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="object-cover rounded-lg w-full h-48" />
                        @else
                        <img src="{{ asset('images/default.png') }}" alt="Default Image" class="object-cover rounded-lg w-full h-48" />
                        @endif
                    </div>
                    <div class="absolute top-2 left-2 bg-pink-600 text-white px-2 py-1 rounded-full text-xs">Best Seller</div>
                    <div class="p-4 flex-grow flex flex-col justify-between">
                        <h2 class="text-lg md:text-xl font-semibold mb-2 text-gray-800">{{ $product->name }}</h2>
                        <p class="text-sm md:text-base text-gray-600 mb-2 flex-grow">{{ Str::limit($product->description, 100) }}</p>
                    </div>
                </a>
                <div class="flex justify-center mt-2">
                    <p class="text-lg font-bold" style="color: #8b0330;">Rp {{ number_format($product->price, 2, ',', '.') }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- Testimonials Section -->
<section class="testimonials py-20 bg-gray-100">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-semibold mb-12" style="color: #8b0330;">Apa Kata Pelanggan Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="testimonial bg-white p-8 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                    <div class="relative mb-4">
                        <!-- Gambar Testimonial dengan ukuran yang konsisten dan object-fit cover -->
                        @if($testimonial->image)
                            <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                 alt="{{ $testimonial->customer_name }}" 
                                 class="w-24 h-24 rounded-full border-4 border-purple-600 mx-auto object-cover">
                        @else
                            <img src="{{ asset('images/default.png') }}" 
                                 alt="Default Image" 
                                 class="w-24 h-24 rounded-full border-4 border-purple-600 mx-auto object-cover">
                        @endif
                    </div>
                    <p class="italic text-lg">"{{ $testimonial->testimonial }}"</p>
                    <p class="mt-4 font-semibold text-lg">- {{ $testimonial->customer_name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>



<!-- Customer Service Button -->
<div class="fixed bottom-5 right-5 z-50">
    <a href="https://wa.me/6285787716285" target="_blank" class="bg-gradient-to-r from-green-400 to-green-600 text-white p-4 rounded-full shadow-lg hover:scale-105 transform transition duration-300 focus:outline-none">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>
</div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Animasi menggunakan GSAP
        gsap.from(".hero h1", { duration: 1.5, opacity: 0, y: -50, ease: "power2.out" });
        gsap.from(".hero p", { duration: 1.5, opacity: 0, y: 50, delay: 0.3, ease: "power2.out" });
        gsap.from(".hero a", { duration: 1.5, opacity: 0, scale: 0.8, delay: 0.6, ease: "power2.out" });

        gsap.from(".feature", { duration: 1.2, opacity: 0, y: 30, stagger: 0.3 });
        gsap.from(".testimonial", { duration: 1.2, opacity: 0, y: 30, stagger: 0.3 });
    });
</script>
@endpush

@push('styles')
<style>
    /* Custom Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Typing effect */
    .animate-typing {
        border-right: 3px solid white;
        white-space: nowrap;
        overflow: hidden;
        animation: typing 3.5s steps(30, end), blink-caret .75s step-end infinite;
    }

    @keyframes typing {
        from {
            width: 0;
        }
        to {
            width: 100%;
        }
    }

    @keyframes blink-caret {
        from, to {
            border-color: transparent;
        }
        50% {
            border-color: white;
        }
    }

    /* Fade In Animation */
    .animate-fade-in {
        opacity: 0;
        animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }
</style>
@endpush
