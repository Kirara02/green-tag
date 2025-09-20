<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GreenTag</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>

<body class="bg-gradient-to-b from-green-50 to-white text-gray-800">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div
            class="bg-white/90 backdrop-blur shadow-lg rounded-2xl w-full max-w-md p-8 border border-green-100">
            <div class="text-center mb-6">
                <img src="/logo.svg" alt="GreenTag logo" class="w-12 h-12 mx-auto mb-3" />
                <h1 class="text-2xl font-bold">GreenTag Admin Login</h1>
                <p class="text-sm text-gray-500 mt-1">Masuk untuk mengelola GreenTag</p>
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
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500/50"
                        required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Password</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password"
                            class="w-full border rounded-lg px-3 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-green-500/50"
                            required>
                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-2 my-auto text-gray-500 hover:text-gray-700">
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path
                                    d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7Zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10Z" />
                            </svg>
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path
                                    d="M3.707 2.293 2.293 3.707l3.22 3.22A13.89 13.89 0 0 0 1 12s3.367 7 11 7a11.43 11.43 0 0 0 5.073-1.128l3.22 3.22 1.414-1.414-17-17ZM12 7a5 5 0 0 1 5 5c0 .558-.096 1.093-.272 1.592L9.408 6.272A4.98 4.98 0 0 1 12 7Z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <button type="submit"
                    class="w-full bg-green-600 text-white py-2.5 rounded-lg font-semibold shadow hover:bg-green-700">Login</button>
            </form>
            <div class="text-center mt-4">
                <a href="/" class="text-sm text-gray-500 hover:text-gray-700">Kembali ke
                    landing</a>
            </div>
        </div>
    </div>

</body>

</html>
