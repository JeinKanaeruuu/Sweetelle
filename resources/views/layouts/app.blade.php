<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Rambut Nenek Bpn</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            position: relative; /* Added for positioning the circles */
        }



        body {
            display: flex;
            flex-direction: column;
            z-index: 1; /* Ensure body content is above circles */
        }

        main {
            flex: 1;
        }

        /* Navbar */
        header {
            background-color: #8b0330; /* Soft pink */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ffffff;
        }

        nav a {
            color: #ffffff;
            transition: all 0.3s;
        }

        nav a:hover {
            color: #A5855F; /* Darker pink on hover */
            transform: scale(1.1);
        }

        /* Active link color */
        .active-link {
            color: #A5855F; /* Active link color */
            border-bottom: 2px solid #A5855F; /* Menambahkan border bawah */
            padding-bottom: 4px; /* Menambahkan jarak antara teks dan garis bawah */
            font-weight: bold; /* Membuat teks lebih tebal jika diinginkan */
        }

        /* Footer */
        footer {
            background-color: #8b0330;
            color: #f1f1f1;
            margin-top: 2rem;
        }

        footer h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        footer a {
            color: #f1f1f1;
            transition: all 0.3s;
        }

        footer a:hover {
            color: #A5855F; /* Darker pink on hover */
        }

        /* Hamburger Menu */
        .navbar-toggler {
            display: none;
        }

        @media (max-width: 768px) {
            .navbar-icons {
                display: none;
            }

            .navbar-toggler {
                display: block;
                cursor: pointer;
                color: #3b3b3b;
                font-size: 1.5rem;
            }

            .navbar-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                right: 0;
                background-color: #f1c0e3; /* Soft pink */
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                z-index: 10;
            }

            .navbar-menu.active {
                display: flex;
            }

            nav a {
                padding: 10px 20px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            nav a:last-child {
                border-bottom: none;
            }
        }

        form button {
            color: #ffffff;
            background-color: transparent;
            border: none;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        form button:hover {
            color: #A5855F; /* Darker pink on hover */
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <!-- Circle Backgrounds -->
    <div class="circle circle1"></div>
    <div class="circle circle2"></div>

    <!-- Navbar -->
    <header class="shadow-md text-black relative">
        <nav class="bg-white shadow-md">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a href="#">
                    @php
                        $landingPage = \App\Models\LandingPages::where('image_title', 'Header')->first();
                    @endphp
                    @if($landingPage && $landingPage->image_url)
                        <img src="{{ $landingPage->image_url }}" alt="Rambut Nenek BPN Logo" class="h-12">
                    @else
                        <!-- Optional fallback logo or text if image is not found -->
                        <span class="text-2xl font-bold text-gray-800">Rambut Nenek BPN</span>
                    @endif
                </a>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('home') ? 'text-gray-800 font-semibold' : '' }}">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="{{ route('home') }}#products" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('home') ? 'text-gray-800 font-semibold' : '' }}">
                        <i class="fas fa-cookie-bite mr-2"></i> Produk
                    </a>
                    <a href="{{ route('about') }}" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('about') ? 'text-gray-800 font-semibold' : '' }}">
                        <i class="fas fa-info-circle mr-2"></i> About Us
                    </a>
        
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('cart') ? 'text-gray-800 font-semibold' : '' }}">
                            <i class="fas fa-shopping-cart mr-2"></i> Keranjang Belanja
                        </a>
                        <a href="{{ route('transactions.index') }}" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('transactions') ? 'text-gray-800 font-semibold' : '' }}">
                            <i class="fas fa-file-invoice-dollar mr-2"></i> Transaksi
                        </a>
                        <a href="{{ route('profile') }}" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('profile') ? 'text-gray-800 font-semibold' : '' }}">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                    @else
                        <a href="{{ route('customer.login') }}" class="text-gray-600 hover:text-gray-800 transition duration-300 {{ request()->is('customer/login') ? 'text-gray-800 font-semibold' : '' }}">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                    @endauth
                </div>
        
                <div class="hidden md:flex space-x-4">
                    @auth
                        <form action="{{ route('customer.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800 transition duration-300">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        <a href="https://www.instagram.com/rambutnenek_bpn/profilecard/?igsh=MTJ2ejA5a3owbmNycg==" class="text-gray-600 hover:text-gray-800 transition duration-300"><i class="fab fa-instagram"></i></a>
                    @endauth
                </div>
        
                <div class="md:hidden">
                    <button id="menu-btn" class="text-gray-600 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        
            <div id="mobile-menu" class="hidden md:hidden">
                <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                    <i class="fas fa-home mr-2"></i> Home
                </a>
                <a href="{{ route('home') }}#products" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                    <i class="fas fa-cookie-bite mr-2"></i> Produk
                </a>
        
                @auth
                    <a href="{{ route('cart.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-shopping-cart mr-2"></i> Keranjang Belanja
                    </a>
                    <a href="{{ route('transactions.index') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-file-invoice-dollar mr-2"></i> Transaksi
                    </a>
                    <a href="{{ route('about') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-info-circle mr-2"></i> About Us
                    </a>
                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                @else
                    <a href="{{ route('customer.login') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-200">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                @endauth
        
                <div class="flex justify-center space-x-4 py-2">
                    @auth
                        <form action="{{ route('customer.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800 transition duration-300">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    @else
                        
                        <a href="https://www.instagram.com/rambutnenek_bpn/profilecard/?igsh=MTJ2ejA5a3owbmNycg==" class="text-gray-600 hover:text-gray-800 transition duration-300"><i class="fab fa-instagram"></i></a>
                        
                    @endauth
                </div>
            </div>
        </nav>
        
        <script>
            document.getElementById('menu-btn').addEventListener('click', function() {
                var menu = document.getElementById('mobile-menu');
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                } else {
                    menu.classList.add('hidden');
                }
            });
        </script>
        
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 flex-1">
        @yield('content')
    </main>

<!-- Footer -->
<footer class="bg-[#8b0330] text-white py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-2xl font-bold mb-4">
                    Rambut<span class="text-[#FFD700]"> Nenek BPN</span>
                </h3>
                <p class="text-sm mb-4">
                    Rambut Nenek Balikpapan adalah cemilan tradisional yang melegenda. Dibuat dengan cinta, untuk menemani setiap momen manismu.
                </p>
                <div class="flex space-x-4 mt-4">
                    <a href="https://www.instagram.com/rambutnenek_bpn/profilecard/?igsh=MTJ2ejA5a3owbmNycg==" class="hover:text-[#FFD700] transition duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Links Section -->
            <div>
                <h4 class="text-xl font-semibold mb-4">Navigasi</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-[#FFD700] transition duration-300">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}#products" class="hover:text-[#FFD700] transition duration-300">
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="hover:text-[#FFD700] transition duration-300">
                            About Us
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div>
                <h4 class="text-xl font-semibold mb-4">Hubungi Kami</h4>
                <p class="text-sm">
                    <i class="fas fa-map-marker-alt mr-2"></i> Balikpapan, Kalimantan Timur
                </p>
                <p class="text-sm mt-2">
                    <i class="fas fa-phone-alt mr-2"></i> +6285787716285
                </p>
                <p class="text-sm mt-2">
                    <i class="fas fa-envelope mr-2"></i> annisarahmadani97@gmail.com
                </p>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm">
            <p>&copy; {{ date('Y') }} Rambut Nenek BPN. All Rights Reserved. Crafted with ❤️ in Balikpapan.</p>
        </div>
    </div>
</footer>



    @livewireScripts
    <script>
        function toggleMenu() {
            const menu = document.querySelector('.navbar-menu');
            menu.classList.toggle('active');
        }
    </script>
</body>

</html>
