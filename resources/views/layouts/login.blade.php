<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('public.login_page_title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>

<body class="bg-gradient-to-b from-green-50 to-white text-gray-800">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div
            class="bg-white/90 backdrop-blur shadow-lg rounded-2xl w-full max-w-md p-8 border border-green-100">
            <div class="text-center mb-6">
                <img src="/logo.svg" alt="GreenTag logo" class="w-12 h-12 mx-auto mb-3" />
                <h1 class="text-2xl font-bold">@lang('public.login_form_title')</h1>
                <p class="text-sm text-gray-500 mt-1">@lang('public.login_form_subtitle')</p>
            </div>

            @if ($errors->any())
                <div
                    class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 p-3 rounded-lg">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.perform') }}" class="space-y-5"
                x-data="{ show: false }">
                @csrf
                <div>
                    <label for="email"
                        class="block text-sm font-medium">@lang('public.login_form_email')</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="password"
                        class="block text-sm font-medium">@lang('public.login_form_password')</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" id="password" name="password"
                            required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 pr-10">
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 top-0 my-auto flex items-center pr-3 text-gray-500 hover:text-gray-700"
                            aria-label="Toggle password visibility">

                            <!-- Eye (show password) -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12c0 0 3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                                <circle cx="12" cy="12" r="2.25" />
                            </svg>

                            <!-- Eye slash (hide password) -->
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 3l18 18M10.5 10.5A2.25 2.25 0 0012 14.25c.621 0 1.184-.252 1.591-.659M15.75 12c0-.621-.252-1.184-.659-1.591M9.5 5.5c.8-.21 1.63-.25 2.5-.25 6 0 9.75 6.75 9.75 6.75-1.018 1.833-2.354 3.31-3.955 4.34" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.343 6.343C4.72 7.527 3.454 9.162 2.25 12c0 0 3.75 6.75 9.75 6.75 1.24 0 2.385-.232 3.41-.65" />
                            </svg>
                        </button>

                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2.5 rounded-md font-semibold shadow hover:bg-green-700 transition-colors">@lang('public.login_form_submit')</button>
            </form>
            <div class="text-center mt-4">
                <a href="{{ route('landing') }}"
                    class="text-sm text-gray-500 hover:text-gray-700">@lang('public.login_back_to_landing')</a>
            </div>
        </div>
    </div>

</body>

</html>
