<nav class="bg-white/95 backdrop-blur-sm shadow-lg sticky top-0 z-50 border-b border-gray-100"
    x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('landing') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg">
                        <img src="/logo.svg" alt="GreenTag Logo" class="w-10 h-10">
                    </div>
                    <span
                        class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">GreenTag</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-8">
                    <a href="{{ route('landing') }}"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50 {{ request()->routeIs('landing') ? 'text-green-600 bg-green-50' : '' }}">
                        {{ __('navbar.home') }}
                    </a>
                    <a href="{{ route('schedules.public.index') }}"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50 {{ request()->routeIs('schedules.public.*') ? 'text-green-600 bg-green-50' : '' }}">
                        {{ __('navbar.schedule') }}
                    </a>
                    <a href="{{ route('educations.public.index') }}"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-green-50 {{ request()->routeIs('educations.public.*') || request()->routeIs('public.article') ? 'text-green-600 bg-green-50' : '' }}">
                        {{ __('navbar.education') }}
                    </a>

                </div>
            </div>

            <!-- Language Switcher & Login Button -->
            <div class="hidden md:flex items-center space-x-3">
                <x-language-switcher />

                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-green-600 px-4 py-2.5 rounded-xl transition-all duration-200 hover:bg-green-50 border border-gray-200 hover:border-green-200 shadow-sm hover:shadow-md font-medium text-sm"
                    title="{{ __('navbar.admin_login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5">
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
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200 shadow-lg">
            <a href="{{ route('landing') }}" @click="mobileMenuOpen = false"
                class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50 {{ request()->routeIs('landing') ? 'text-green-600 bg-green-50' : '' }}">
                {{ __('navbar.home') }}
            </a>
            <a href="{{ route('schedules.public.index') }}" @click="mobileMenuOpen = false"
                class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50 {{ request()->routeIs('schedules.public.*') ? 'text-green-600 bg-green-50' : '' }}">
                {{ __('navbar.schedule') }}
            </a>
            <a href="{{ route('educations.public.index') }}" @click="mobileMenuOpen = false"
                class="text-gray-700 hover:text-green-600 block px-3 py-3 rounded-lg text-base font-medium transition-all duration-200 hover:bg-green-50 {{ request()->routeIs('educations.public.*') || request()->routeIs('public.article') ? 'text-green-600 bg-green-50' : '' }}">
                {{ __('navbar.education') }}
            </a>

            <div class="pt-4 border-t border-gray-200 space-y-3">
                <!-- Language Switcher for Mobile -->
                <div class="flex justify-center space-x-2">
                    <a href="{{ route('lang.switch', 'id') }}" @click="mobileMenuOpen = false"
                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors {{ app()->getLocale() === 'id' ? 'text-green-600 bg-green-50' : '' }}">
                        <span class="text-xs font-semibold">ID</span>
                        <span>Indonesia</span>
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" @click="mobileMenuOpen = false"
                        class="flex items-center gap-2 px-3 py-2 text-sm text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition-colors {{ app()->getLocale() === 'en' ? 'text-green-600 bg-green-50' : '' }}">
                        <span class="text-xs font-semibold">EN</span>
                        <span>English</span>
                    </a>
                </div>

                <a href="{{ route('login') }}" @click="mobileMenuOpen = false"
                    class="text-gray-600 hover:text-green-600 flex items-center justify-center w-full px-4 py-3 rounded-lg text-base font-medium transition-all duration-200 border border-gray-200 hover:border-green-200 hover:bg-green-50 shadow-sm hover:shadow-md"
                    title="{{ __('navbar.admin_login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 mr-2">
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
