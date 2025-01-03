@extends('layouts.app')

@section('content')
<style>
     
    .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .text-white {
        color: white;
    }

    .text-center {
        text-align: center, justify;
    }

    .text-5xl {
        font-size: 3rem;
    }

    .font-bold {
        font-weight: 700;
    }

    .font-semibold {
        font-weight: 600;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-3xl {
        font-size: 1.875rem;
    }

    .text-2xl {
        font-size: 1.5rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .mb-6 {
        margin-bottom: 1.5rem;
    }

    .mb-8 {
        margin-bottom: 2rem;
    }

    .mb-10 {
        margin-bottom: 2.5rem;
    }

    .mb-16 {
        margin-bottom: 4rem;
    }

    .rounded-xl {
        border-radius: 1rem;
    }

    .shadow-xl {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
   </style>

<section id="about-us" class="about-us py-20">
    @php
        $landingPage = \App\Models\LandingPages::where('image_title', 'Landing')->first();
    @endphp

    <div class="container mx-auto px-6 py-16 text-center">
        <!-- Title -->
        <h2 class="text-5xl font-bold mb-8">Tentang Kami</h2>

        <!-- Deskripsi Perusahaan -->
        <div class="flex flex-col md:flex-row justify-center items-center gap-12 mb-16">
            <div class="md:w-1/2">
                <h3 class="text-3xl font-semibold mb-4">Siapa Kami?</h3>
                <p class="text-lg mb-6 text-justify">
                    Kami adalah perusahaan yang berkomitmen untuk memberikan solusi terbaik dalam memenuhi kebutuhan Anda. 
                    Dengan produk berkualitas tinggi dan pelayanan yang ramah, kami hadir untuk membuat hidup Anda lebih mudah.
                </p>
                <p class="text-lg text-justify">
                Rambut Nenek BPN berdiri sejak 2016 di kota Balikpapan, berawal dari keinginan untuk menghadirkan kembali nostalgia jajanan tradisional "rambut nenek" yang jarang ditemui di Balikpapan saat itu.
                </p>
            </div>
            <div class="md:w-1/2">
                @php
                    $landingPage = \App\Models\LandingPages::where('image_title', 'About')->first();
                @endphp
                <img src="{{ $landingPage && $landingPage->image_url ? $landingPage->image_url : asset('assets/images/default.jpg') }}" 
                    alt="Tentang perusahaan" class="rounded-xl shadow-xl w-full h-auto object-cover" />
            </div>
            
        </div>

        <!-- Misi dan Visi -->
        <div class="mb-16">
            <h3 class="text-3xl font-semibold mb-4">Misi dan Visi Kami</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="flex flex-col items-center">
                    <h4 class="text-2xl font-bold mb-2">Misi</h4>
                    <p class="text-lg text-center">
                    Menghadirkan camilan tradisional Rambut Nenek yang autentik, berkualitas tinggi, 
                    dan ramah lingkungan untuk melestarikan budaya kuliner lokal sekaligus mendukung pemberdayaan ekonomi masyarakat Balikpapan.
                    </p>
                </div>
                <div class="flex flex-col items-center">
                    <h4 class="text-2xl font-bold mb-2">Visi</h4>
                    <p class="text-lg text-center">
                    Menjadi UMKM yang terdepan dalam memproduksi dan memasarkan camilan tradisional berkualitas tinggi, ramah lingkungan, dan bercita rasa autentik, 
                    sehingga dapat memperkenalkan budaya kuliner lokal Balikpapan ke tingkat nasional dan internasional.
                    </p>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection
