<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page_title ?? 'GreenTag' }} - {{ config('app.name', 'GreenTag') }}</title>

    @if (isset($page_description))
        <meta name="description" content="{{ $page_description }}">
    @endif

    @if (isset($page_keywords))
        <meta name="keywords" content="{{ $page_keywords }}">
    @endif

    <meta name="author" content="GreenTag">

    @if (isset($og_type))
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="{{ $og_type }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title"
            content="{{ $page_title ?? 'GreenTag' }} - {{ config('app.name', 'GreenTag') }}">
        <meta property="og:description" content="{{ $page_description ?? '' }}">
        <meta property="og:image" content="{{ $og_image ?? url('/logo.svg') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title"
            content="{{ $page_title ?? 'GreenTag' }} - {{ config('app.name', 'GreenTag') }}">
        <meta property="twitter:description" content="{{ $page_description ?? '' }}">
        <meta property="twitter:image" content="{{ $og_image ?? url('/logo.svg') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Modern Navbar -->
    <x-public-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Brand -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 rounded-xl flex items-center justify-center shadow-lg">
                            <img src="/logo.svg" alt="GreenTag Logo" class="w-10 h-10">
                        </div>
                        <span
                            class="text-2xl font-bold bg-gradient-to-r from-green-600 to-green-700 bg-clip-text text-transparent">GreenTag</span>
                    </div>
                    <p class="text-gray-600 text-sm">{{ __('landing.footer_description') }}</p>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ __('landing.footer_quick_links') }}</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('landing') }}"
                                class="text-gray-600 hover:text-green-600 transition-colors">{{ __('navbar.home') }}</a>
                        </li>
                        <li><a href="{{ route('schedules.public.index') }}"
                                class="text-gray-600 hover:text-green-600 transition-colors">{{ __('navbar.schedule') }}</a>
                        </li>
                        <li><a href="{{ route('educations.public.index') }}"
                                class="text-gray-600 hover:text-green-600 transition-colors">{{ __('navbar.education') }}</a>
                        </li>
                        <li><a href="{{ route('landing') }}#lapor"
                                class="text-gray-600 hover:text-green-600 transition-colors">{{ __('navbar.report') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ __('landing.footer_contact') }}</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p>{{ __('landing.contact_address_value') }}</p>
                        <p>{{ __('landing.contact_email') }}: info@greentag.com</p>
                        <p>{{ __('landing.contact_phone') }}: +62 123 456 7890</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-8 pt-8 text-center">
                <p class="text-gray-500 text-sm">{{ __('landing.footer_copyright') }} ©
                    {{ date('Y') }} GreenTag. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>
