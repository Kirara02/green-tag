<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('system.qr_code_page_title', ['code' => $bin->code])</title>
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body {
                background-color: white;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center w-full max-w-sm">
        <div class="flex items-center justify-center gap-2 mb-4">
            <img src="/logo.svg" alt="GreenTag Logo" class="w-8 h-8"><span
                class="text-2xl font-bold text-gray-800">GreenTag</span>
        </div>
        <h1 class="text-xl font-semibold text-gray-700">@lang('system.qr_code_scan_to_report')</h1>
        <p class="text-gray-500 mb-4">@lang('system.qr_code_bin_code'): <span
                class="font-mono font-semibold">{{ $bin->code }}</span></p>
        <div class="p-4 border inline-block rounded-lg">{!! QrCode::size(250)->generate($url) !!}</div>
        <p class="mt-4 text-sm text-gray-600">@lang('system.qr_code_location'): {{ $bin->location->name }}</p>
        <div class="mt-6 no-print">
            <button onclick="window.print()"
                class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium">@lang('system.btn_print')</button>
            <a href="{{ route('officer.bins.index') }}"
                class="px-6 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">@lang('system.btn_back_to_list')</a>
        </div>
    </div>
</body>

</html>
