<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? 'Dasbor' }} - GreenTag Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Load AlpineJS dengan persist plugin secara bersamaan untuk menghindari race condition --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.14.1/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    {{-- CSS untuk mencegah layout shift dan memperbaiki transisi sidebar --}}
    <style>
        /* Mencegah layout shift saat navigasi */
        .sidebar-transition {
            transition: width 200ms ease-in-out, padding-left 200ms ease-in-out;
        }

        /* Memastikan transisi smooth untuk elemen sidebar */
        .sidebar-content {
            transition: opacity 150ms ease-in-out;
        }

        /* Mencegah flash saat AlpineJS load */
        [x-cloak] {
            display: none !important;
        }

        /* Optimasi untuk mencegah reflow */
        .sidebar-fixed {
            will-change: width;
            transform: translateZ(0);
        }

        /* Mencegah sidebar flash saat page load */
        body {
            opacity: 0;
            transition: opacity 100ms ease-in-out;
        }

        body.loaded {
            opacity: 1;
        }

        /* Pastikan sidebar tidak berubah ukuran saat navigasi */
        .sidebar-fixed {
            contain: layout style;
        }
    </style>

    @stack('styles')
</head>
{{-- 2. Gunakan $persist untuk menyimpan state 'sidebarExpanded' --}}

<body class="bg-slate-50 text-slate-800" x-data="{ sidebarOpen: false, sidebarExpanded: $persist(true).as('sidebar_expanded_state') }">
    @auth
        <!-- Sidebar -->
        <aside
            class="hidden md:flex fixed inset-y-0 left-0 bg-white border-r border-slate-200 z-40 sidebar-fixed sidebar-transition"
            :class="sidebarExpanded ? 'w-64' : 'w-20'" x-cloak>
            <div class="flex flex-col w-full">
                {{-- 3. Modifikasi Header Sidebar untuk mengatasi masalah layout --}}
                <div class="flex items-center h-16 border-b border-slate-100 flex-shrink-0"
                    :class="sidebarExpanded ? 'justify-between px-4' : 'justify-center px-3'">
                    {{-- Logo kini disembunyikan saat sidebar diciutkan untuk memberi ruang --}}
                    <a href="{{ Auth::user()->role == 'admin' ? route('admin.dashboard.index') : route('officer.dashboard.index') }}"
                        x-show="sidebarExpanded" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-end="opacity-0" class="flex items-center gap-2">
                        <img src="/logo.svg" alt="GreenTag" class="w-7 h-7">
                        <span class="font-bold text-lg">GreenTag Panel</span>
                    </a>
                    {{-- Tombol toggle kini akan selalu terlihat dan berada di tengah saat diciutkan --}}
                    <button @click="sidebarExpanded = !sidebarExpanded"
                        class="p-2 rounded-full hover:bg-slate-100" aria-label="Toggle sidebar">
                        <svg x-show="sidebarExpanded" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                        <svg x-show="!sidebarExpanded" xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
                @include('components.partials.sidebar-nav')
            </div>
        </aside>

        <!-- Mobile Sidebar (Tidak ada perubahan) -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="md:hidden fixed inset-0 bg-black/30 z-40" x-transition.opacity></div>
        <aside
            class="md:hidden fixed inset-y-0 left-0 w-64 bg-white border-r border-slate-200 z-50 transform"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" x-transition>
            <div class="flex items-center justify-between px-4 h-16 border-b border-slate-100">
                <a href="#" class="flex items-center gap-2"><img src="/logo.svg" alt="GreenTag"
                        class="w-7 h-7"><span class="font-bold text-lg">GreenTag Panel</span></a>
                <button @click="sidebarOpen = false" class="p-2 rounded hover:bg-slate-100"
                    aria-label="Close sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            @include('components.partials.sidebar-nav')
        </aside>

        <!-- Header & Main Content Wrapper -->
        <div class="flex flex-col flex-1 min-h-screen sidebar-transition"
            :class="{ 'md:pl-64': sidebarExpanded, 'md:pl-20': !sidebarExpanded }">
            <!-- Header (Tidak ada perubahan) -->
            <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
                <div class="px-4 h-16 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        {{-- Tombol toggle sekarang ada di header --}}
                        <button @click="desktopSidebarOpen = !desktopSidebarOpen"
                            class="hidden md:block p-2 rounded-full hover:bg-slate-100"
                            aria-label="Toggle sidebar">
                            <svg x-show="desktopSidebarOpen" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <svg x-show="!desktopSidebarOpen" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                        <button @click="mobileSidebarOpen = true"
                            class="md:hidden p-2 rounded-full hover:bg-slate-100"
                            aria-label="Open sidebar">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center gap-4">
                        {{-- INTEGRASI LANGUAGE SWITCHER DI SINI --}}
                        <x-language-switcher />

                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center gap-2 rounded-full p-1 pr-3 hover:bg-slate-100">
                                <span
                                    class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-green-500 text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                <span
                                    class="hidden sm:block text-sm font-medium">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-slate-500 hidden sm:block" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 origin-top-right">
                                <div class="px-4 py-2 text-xs text-slate-500">{{ Auth::user()->email }}
                                </div>
                                <div class="border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}">@csrf<button
                                        type="submit"
                                        class="w-full text-left flex items-center gap-2 px-4 py-2 text-sm text-slate-700 hover:bg-slate-100"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                                clip-rule="evenodd" />
                                        </svg><span>Logout</span></button></form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-4 sm:p-6 lg:p-8 flex-1">
                {{-- Breadcrumb --}}
                @if (isset($breadcrumb))
                    <x-breadcrumb :items="$breadcrumb" />
                @endif

                {{ $slot }}
            </main>
        </div>
    @endauth

    {{-- Script untuk mencegah flash saat page load --}}
    <script>
        // Tambahkan class loaded setelah AlpineJS selesai load
        document.addEventListener('alpine:init', () => {
            document.body.classList.add('loaded');
        });

        // Fallback jika AlpineJS sudah loaded
        if (window.Alpine) {
            document.body.classList.add('loaded');
        }
    </script>

    @stack('scripts')
</body>

</html>
