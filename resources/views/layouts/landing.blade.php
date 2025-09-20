<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenTag - Manajemen Sampah Cerdas | Platform QR Code untuk Pengelolaan Sampah</title>
    <meta name="description"
        content="GreenTag adalah platform manajemen sampah cerdas dengan teknologi QR Code. Kirim pengaduan sampah, akses jadwal pengambilan, dan baca edukasi lingkungan secara mudah.">
    <meta name="keywords"
        content="manajemen sampah, QR code, pengaduan sampah, jadwal pengambilan sampah, edukasi lingkungan, GreenTag">
    <meta name="author" content="GreenTag">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="GreenTag - Manajemen Sampah Cerdas">
    <meta property="og:description"
        content="Platform manajemen sampah cerdas dengan teknologi QR Code untuk kota yang lebih bersih dan hijau.">
    <meta property="og:image" content="{{ url('/logo.svg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="GreenTag - Manajemen Sampah Cerdas">
    <meta property="twitter:description"
        content="Platform manajemen sampah cerdas dengan teknologi QR Code untuk kota yang lebih bersih dan hijau.">
    <meta property="twitter:image" content="{{ url('/logo.svg') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <style>
        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition
            class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <!-- Modern Navbar -->
    <nav class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50 border-b border-gray-100"
        x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg">
                            <img src="/logo.svg" alt="GreenTag Logo" class="w-10 h-10">
                        </div>
                        <span
                            class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">GreenTag</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#tentang"
                            class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50">
                            {{ __('navbar.about') }}
                        </a>
                        <a href="#jadwal"
                            class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50">
                            {{ __('navbar.schedule') }}
                        </a>
                        <a href="#edukasi"
                            class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50">
                            {{ __('navbar.education') }}
                        </a>
                        <a href="#kontak"
                            class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50">
                            {{ __('navbar.contact') }}
                        </a>
                    </div>
                </div>

                <!-- Language Switcher & Login Button -->
                <div class="hidden md:flex items-center space-x-3">
                    <x-language-switcher />
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-green-50 border border-gray-200 hover:border-green-200 shadow-sm hover:shadow-md font-medium text-sm"
                        title="{{ __('navbar.admin_login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-5 h-5">
                            <path
                                d="M3.75 4.5A2.25 2.25 0 0 1 6 2.25h6A2.25 2.25 0 0 1 14.25 4.5v3a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 0-.75-.75H6a.75.75 0 0 0-.75.75v15a.75.75 0 0 0 .75.75h6a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 1 1.5 0v3A2.25 2.25 0 0 1 12 21.75H6A2.25 2.25 0 0 1 3.75 19.5v-15Z" />
                            <path
                                d="M21 12a.75.75 0 0 1-.22.53l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H10.5a.75.75 0 0 1 0-1.5h6.94l-1.72-1.72a.75.75 0 1 1 1.06-1.06l3 3c.14.14.22.33.22.53Z" />
                        </svg>
                        {{ __('navbar.login') }}
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-green-600 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-green-500 transition-all duration-200"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg x-show="!mobileMenuOpen" class="block h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- Close icon -->
                        <svg x-show="mobileMenuOpen" class="block h-6 w-6"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden" id="mobile-menu">
            <div
                class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200 shadow-lg">
                <a href="#tentang" @click="mobileMenuOpen = false"
                    class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50">
                    {{ __('navbar.about') }}
                </a>
                <a href="#jadwal" @click="mobileMenuOpen = false"
                    class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50">
                    {{ __('navbar.schedule') }}
                </a>
                <a href="#edukasi" @click="mobileMenuOpen = false"
                    class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50">
                    {{ __('navbar.education') }}
                </a>
                <a href="#kontak" @click="mobileMenuOpen = false"
                    class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50">
                    {{ __('navbar.contact') }}
                </a>
                <div class="pt-4 border-t border-gray-200 space-y-3">
                    <!-- Language Switcher for Mobile -->
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('lang.switch', 'id') }}"
                            @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors {{ app()->getLocale() === 'id' ? 'text-green-600 bg-green-50' : '' }}">
                            <span class="text-xs font-semibold">ID</span>
                            <span>Indonesia</span>
                        </a>
                        <a href="{{ route('lang.switch', 'en') }}"
                            @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors {{ app()->getLocale() === 'en' ? 'text-green-600 bg-green-50' : '' }}">
                            <span class="text-xs font-semibold">EN</span>
                            <span>English</span>
                        </a>
                    </div>

                    <a href="{{ route('login') }}" @click="mobileMenuOpen = false"
                        class="text-gray-600 hover:text-green-600 flex items-center justify-center w-full px-4 py-3 rounded-lg text-base font-medium transition-all duration-200 border border-gray-200 hover:border-green-200 hover:bg-green-50 shadow-sm hover:shadow-md"
                        title="{{ __('navbar.admin_login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-5 h-5 mr-2">
                            <path
                                d="M3.75 4.5A2.25 2.25 0 0 1 6 2.25h6A2.25 2.25 0 0 1 14.25 4.5v3a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 0-.75-.75H6a.75.75 0 0 0-.75.75v15a.75.75 0 0 0 .75.75h6a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 1 1.5 0v3A2.25 2.25 0 0 1 12 21.75H6A2.25 2.25 0 0 1 3.75 19.5v-15Z" />
                            <path
                                d="M21 12a.75.75 0 0 1-.22.53l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H10.5a.75.75 0 0 1 0-1.5h6.94l-1.72-1.72a.75.75 0 1 1 1.06-1.06l3 3c.14.14.22.33.22.53Z" />
                        </svg>
                        {{ __('navbar.login') }}
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-50 via-white to-green-100">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-20 grid md:grid-cols-2 gap-8 items-center">
            <div class="text-center md:text-left order-2 md:order-1">
                <div
                    class="inline-flex items-center gap-2 bg-white shadow-sm rounded-full px-4 py-1 text-sm text-green-700 border border-green-100">
                    <span
                        class="w-2 h-2 rounded-full bg-green-500"></span>{{ __('landing.hero_tagline') }}
                </div>
                <h2
                    class="mt-6 text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-green-800">
                    {{ __('landing.hero_title') }}</h2>
                <p class="mt-4 text-base md:text-lg text-gray-600 md:max-w-xl">
                    {{ __('landing.hero_description') }}</p>
                <div
                    class="mt-8 flex flex-col sm:flex-row items-center md:justify-start justify-center gap-4">
                    <button onclick="document.getElementById('complaintDialog').showModal()"
                        class="w-full sm:w-auto bg-green-600 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-green-700 transition">{{ __('landing.hero_cta_report') }}</button>
                    <a href="#fitur"
                        class="w-full sm:w-auto px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition text-center">{{ __('landing.hero_cta_learn') }}</a>
                </div>
            </div>
            <div class="order-1 md:order-2">
                <svg class="w-full max-w-lg mx-auto animate-float" viewBox="0 0 400 300"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="grad" x1="0" y1="0"
                            x2="1" y2="1">
                            <stop offset="0%" stop-color="#34d399" />
                            <stop offset="100%" stop-color="#10b981" />
                        </linearGradient>
                    </defs>
                    <rect x="40" y="60" width="320" height="180" rx="16"
                        fill="url(#grad)" opacity="0.15" />
                    <rect x="70" y="90" width="260" height="140" rx="12"
                        fill="#fff" stroke="#d1fae5" />
                    <rect x="90" y="120" width="100" height="12" rx="6"
                        fill="#34d399" />
                    <rect x="90" y="140" width="180" height="10" rx="5"
                        fill="#a7f3d0" />
                    <rect x="90" y="160" width="160" height="10" rx="5"
                        fill="#a7f3d0" />
                    <circle cx="310" cy="120" r="14" fill="#10b981" />
                    <path d="M306 120l6 6 10-12" stroke="#fff" stroke-width="2" fill="none"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <g opacity="0.4">
                        <rect x="240" y="60" width="40" height="10" rx="5"
                            fill="#34d399" />
                        <rect x="120" y="230" width="60" height="10" rx="5"
                            fill="#10b981" />
                    </g>
                </svg>
            </div>
        </div>
    </section>

    <!-- Stats Band -->
    <section class="bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-12">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

                <div
                    class="flex items-center justify-center gap-4 bg-white p-4 rounded-xl shadow-sm">
                    <div
                        class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                            <path fill-rule="evenodd"
                                d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.678 3.348-3.97z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-2xl md:text-4xl font-extrabold text-green-700">
                            {{ $stats['complaint_count'] }}+</div>
                        <div class="text-sm md:text-base text-slate-500 font-medium">
                            {{ __('landing.stats_complaints') }}</div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center gap-4 bg-white p-4 rounded-xl shadow-sm">
                    <div
                        class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-6 h-6 md:w-8 md:h-8">
                            <path
                                d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                            <path fill-rule="evenodd"
                                d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-2xl md:text-4xl font-extrabold text-green-700">
                            {{ $stats['bin_count'] }}+</div>
                        <div class="text-sm md:text-base text-slate-500 font-medium">
                            {{ __('landing.stats_bins') }}</div>
                    </div>
                </div>

                <div
                    class="flex items-center justify-center gap-4 bg-white p-4 rounded-xl shadow-sm sm:col-span-2 lg:col-span-1">
                    <div
                        class="flex-shrink-0 w-12 h-12 md:w-16 md:h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="w-7 h-7 md:w-9 md:h-9">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-2xl md:text-4xl font-extrabold text-green-700">
                            {{ $stats['location_count'] }}+</div>
                        <div class="text-sm md:text-base text-slate-500 font-medium">
                            {{ __('landing.stats_locations') }}</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Why GreenTag / Features -->
    <section id="fitur" class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ __('landing.features_title') }}</h2>
            <div class="mt-3 mx-auto h-1 w-24 bg-green-500 rounded"></div>
            <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">
                {{ __('landing.features_subtitle') }}</p>
        </div>
        <div
            class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">

            <div
                class="flex flex-col items-start bg-white p-8 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" class="w-8 h-8">
                        <path
                            d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375z" />
                        <path fill-rule="evenodd"
                            d="M3.087 9l.54 9.176A3 3 0 006.62 21h10.757a3 3 0 002.995-2.824L20.913 9H3.087zm6.163 3.75A.75.75 0 0110 12h4a.75.75 0 010 1.5h-4a.75.75 0 01-.75-.75z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold leading-7 text-gray-900">
                    {{ __('landing.feature_1_title') }}</h3>
                <p class="mt-4 text-base leading-7 text-gray-600">
                    {{ __('landing.feature_1_description') }}</p>
            </div>

            <div
                class="flex flex-col items-start bg-white p-8 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" class="w-8 h-8">
                        <path fill-rule="evenodd"
                            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold leading-7 text-gray-900">
                    {{ __('landing.feature_2_title') }}</h3>
                <p class="mt-4 text-base leading-7 text-gray-600">
                    {{ __('landing.feature_2_description') }}</p>
            </div>

            <div
                class="flex flex-col items-start bg-white p-8 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" class="w-8 h-8">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 006 3a9.735 9.735 0 00-3.25.555.75.75 0 00-.5.707v14.25a.75.75 0 001 .707A8.237 8.237 0 016 18.75c1.995 0 3.823.707 5.25 1.886V4.533zM12.75 20.636A8.214 8.214 0 0118 18.75c.966 0 1.89.166 2.75.47a.75.75 0 001-.708V4.262a.75.75 0 00-.5-.707A9.735 9.735 0 0018 3a9.707 9.707 0 00-5.25 1.533v16.103z" />
                    </svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold leading-7 text-gray-900">
                    {{ __('landing.feature_3_title') }}</h3>
                <p class="mt-4 text-base leading-7 text-gray-600">
                    {{ __('landing.feature_3_description') }}</p>
            </div>
        </div>
    </section>

    <!-- KODE YANG DIPERBAIKI: Schedule Section -->
    <section id="jadwal" class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-2xl font-bold text-center mb-2">{{ __('landing.schedule_title') }}
            </h3>
            <p class="text-center text-gray-600 mb-8">{{ __('landing.schedule_subtitle') }}</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($schedules as $schedule)
                    <div class="bg-white shadow rounded-xl p-6">
                        <h4 class="font-bold text-lg text-green-700">{{ $schedule->day }}</h4>
                        <p class="font-semibold text-gray-800 mt-2">{{ $schedule->name }}</p>
                        <p class="text-sm text-gray-500">
                            {{ date('H:i', strtotime($schedule->start_time)) }} -
                            {{ date('H:i', strtotime($schedule->end_time)) }}</p>
                    </div>
                @empty
                    <div class="lg:col-span-3 text-center text-gray-500 py-8">
                        <p>{{ __('landing.schedule_empty') }}</p>
                    </div>
                @endforelse
            </div>
            @if ($schedules->isNotEmpty())
                <div class="text-center mt-10">
                    <a href="{{ route('schedules.public.index') }}"
                        class="px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition">{{ __('landing.schedule_view_all') }}</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Education Section -->
    <section id="edukasi" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-2">{{ __('landing.education_title') }}</h3>
        <p class="text-center text-gray-600 mb-8">{{ __('landing.education_subtitle') }}</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($articles as $article)
                <div class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    @if ($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}"
                            alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else<div
                            class="w-full h-48 bg-green-50 flex items-center justify-center text-green-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M8.25 6.75A2.25 2.25 0 0 1 10.5 4.5h3a2.25 2.25 0 0 1 2.25 2.25v12.75a.75.75 0 0 1-1.2.6l-2.55-1.9-2.55 1.9a.75.75 0 0 1-1.2-.6V6.75Z" />
                            </svg></div>
                    @endif
                    <div class="p-6 flex-grow">
                        <span
                            class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">{{ $article->category }}</span>
                        <h4 class="font-semibold text-gray-800 mt-3">{{ $article->title }}</h4>
                        <p class="text-gray-600 mt-2 text-sm">
                            {{ Str::limit(strip_tags($article->content), 120) }}</p>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-3 text-center text-gray-500 py-8">
                    <p>{{ __('landing.education_empty') }}</p>
                </div>
            @endforelse
        </div>
        <!-- KODE YANG DIPERBAIKI: Tombol "Lihat Semua" untuk Edukasi -->
        @if ($articles->isNotEmpty())
            <div class="text-center mt-10">
                <a href="{{ route('educations.public.index') }}"
                    class="px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition">{{ __('landing.education_view_all') }}</a>
            </div>
        @endif
    </section>

    <!-- About Section -->
    <section id="tentang" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-6">{{ __('landing.about_title') }}</h3>
        <p class="text-center text-gray-600 max-w-3xl mx-auto">
            {{ __('landing.about_description') }}</p>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-2">{{ __('landing.faq_title') }}</h3>
        <p class="text-center text-gray-600 mb-8">{{ __('landing.faq_subtitle') }}</p>
        <div class="max-w-3xl mx-auto space-y-3" x-data="{ open: null }">
            <div class="bg-white border border-gray-200 rounded-xl"><button
                    class="w-full text-left px-4 py-3 font-medium flex justify-between items-center"
                    @click="open = open === 1 ? null : 1">{{ __('landing.faq_1_question') }}<span
                        x-text="open === 1 ? '-' : '+'"></span></button>
                <div x-show="open === 1" x-collapse class="px-4 pb-4 text-gray-600">
                    {{ __('landing.faq_1_answer') }}</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl"><button
                    class="w-full text-left px-4 py-3 font-medium flex justify-between items-center"
                    @click="open = open === 2 ? null : 2">{{ __('landing.faq_2_question') }}<span
                        x-text="open === 2 ? '-' : '+'"></span></button>
                <div x-show="open === 2" x-collapse class="px-4 pb-4 text-gray-600">
                    {{ __('landing.faq_2_answer') }}</div>
            </div>
            <div class="bg-white border border-gray-200 rounded-xl"><button
                    class="w-full text-left px-4 py-3 font-medium flex justify-between items-center"
                    @click="open = open === 3 ? null : 3">{{ __('landing.faq_3_question') }}<span
                        x-text="open === 3 ? '-' : '+'"></span></button>
                <div x-show="open === 3" x-collapse class="px-4 pb-4 text-gray-600">
                    {{ __('landing.faq_3_answer') }}</div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h3 class="text-3xl font-bold mb-2">{{ __('landing.contact_title') }}</h3>
                <p class="text-gray-600 mb-12">{{ __('landing.contact_subtitle') }}</p>
            </div>

            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center bg-white p-8 rounded-2xl shadow-lg">

                {{-- Kolom Kiri: Detail Kontak dengan Ikon --}}
                <div class="space-y-8">
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">
                            {{ __('landing.contact_details') }}</h4>
                        <div class="flex items-start gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd"
                                        d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a2.25 2.25 0 0 0 .286-.17c1.395-.893 2.824-2.15 3.963-3.793a12.08 12.08 0 0 0 2.592-7.198C21 6.088 17.03 2.25 12 2.25S3 6.088 3 11.25a12.08 12.08 0 0 0 2.592 7.198c1.139 1.643 2.568 2.9 3.963 3.793a2.25 2.25 0 0 0 .286-.17l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041ZM12 15a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-700">
                                    {{ __('landing.contact_address') }}</h5>
                                <p class="text-gray-600">{{ __('landing.contact_address_value') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path
                                    d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path
                                    d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-700">
                                {{ __('landing.contact_email') }}</h5>
                            <p class="text-gray-600">info@uniguard.co.id</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div
                            class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.298-.083.465a10.89 10.89 0 0 0 5.426 5.426c.167.08.364.052.465-.083l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-700">
                                {{ __('landing.contact_phone') }}</h5>
                            <p class="text-gray-600">+62 822-9990-0331</p>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Google Maps --}}
                <div
                    class="w-full h-80 lg:h-full rounded-2xl overflow-hidden shadow-md border-4 border-white">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.599187321589!2d107.51746507474815!3d-6.831107893181817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7f2d87a1ac1%3A0xbe1472eb77d64fd4!2sUniguard%20Indonesia!5e0!3m2!1sid!2sid!4v1672898984313!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>
    </section>

    <!-- Dialog: Complaint -->
    <dialog id="complaintDialog"
        class="backdrop:bg-black/50 rounded-xl p-0 max-w-lg w-[90vw] m-auto">
        <div class="bg-white rounded-xl p-6 w-full">
            <h3 class="text-xl font-bold text-center mb-4">{{ __('landing.complaint_title') }}
            </h3>
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md"
                    role="alert"><strong
                        class="font-bold">{{ __('landing.complaint_error_title') }}</strong>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('complaints.store') }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" id="qr_token_input" name="qr_token" value="">
                <div><label for="reporter_name"
                        class="block text-sm font-medium">{{ __('landing.complaint_name') }}</label><input
                        type="text" id="reporter_name" name="reporter_name"
                        value="{{ old('reporter_name') }}"
                        class="w-full border rounded-lg px-3 py-2 mt-1" required></div>
                <div><label for="reporter_phone"
                        class="block text-sm font-medium">{{ __('landing.complaint_phone') }}</label><input
                        type="tel" id="reporter_phone" name="reporter_phone"
                        value="{{ old('reporter_phone') }}"
                        class="w-full border rounded-lg px-3 py-2 mt-1"></div>
                <div><label for="address_detail"
                        class="block text-sm font-medium">{{ __('landing.complaint_address') }}</label><input
                        type="text" id="address_detail" name="address_detail"
                        value="{{ old('address_detail') }}"
                        class="w-full border rounded-lg px-3 py-2 mt-1" required></div>
                <div><label for="category"
                        class="block text-sm font-medium">{{ __('landing.complaint_category') }}</label><select
                        id="category" name="category"
                        class="w-full border rounded-lg px-3 py-2 mt-1" required>
                        @foreach (__('landing.complaint_categories') as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select></div>
                <div><label for="description"
                        class="block text-sm font-medium">{{ __('landing.complaint_description') }}</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full border rounded-lg px-3 py-2 mt-1" required>{{ old('description') }}</textarea>
                </div>
                <div><label for="photo"
                        class="block text-sm font-medium">{{ __('landing.complaint_photo') }}</label><input
                        type="file" id="photo" name="photo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                </div>
                <div class="flex justify-end space-x-3 pt-2"><button type="button"
                        onclick="document.getElementById('complaintDialog').close()"
                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">{{ __('landing.complaint_cancel') }}</button><button
                        type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700">{{ __('landing.complaint_submit') }}</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- Scroll to Top Button -->
    <button x-data="{ show: false }" @scroll.window="show = window.scrollY > 300"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-show="show" x-transition
        class="fixed bottom-6 right-6 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 z-40"
        aria-label="Scroll to top">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-lg">GreenTag</h4>
                <p class="text-sm text-green-100 mt-2">{{ __('landing.footer_description') }}</p>
            </div>
            <div>
                <h5 class="font-semibold">{{ __('landing.footer_quick_links') }}</h5>
                <ul class="mt-2 space-y-2 text-green-100">
                    <li><a href="#fitur" class="hover:text-white">{{ __('navbar.about') }}</a>
                    </li>
                    <li><a href="#jadwal"
                            class="hover:text-white">{{ __('navbar.schedule') }}</a></li>
                    <li><a href="#edukasi"
                            class="hover:text-white">{{ __('navbar.education') }}</a></li>
                    <li><a href="#faq"
                            class="hover:text-white">{{ __('landing.faq_title') }}</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-semibold">{{ __('landing.footer_contact') }}</h5>
                <ul class="mt-2 space-y-1 text-green-100">
                    <li>📍 {{ __('landing.contact_address_value') }}</li>
                    <li>📧 info@uniguard.co.id</li>
                    <li>📞 +62 822-9990-0331</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-green-600 mt-8 pt-4 text-center text-sm text-green-100">&copy;
            {{ date('Y') }} GreenTag. {{ __('landing.footer_copyright') }}</div>
    </footer>

</body>

</html>
