<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code for Bin: {{ $bin->code }}</title>
    @vite(['resources/css/app.css'])
    <style>
        /* Sembunyikan elemen yang tidak perlu saat mencetak */
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

    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold text-gray-800">Scan to Report</h1>
        <p class="text-gray-600 mb-4">Bin Code: <span
                class="font-mono font-semibold">{{ $bin->code }}</span></p>

        {{-- Di sinilah keajaiban terjadi! --}}
        <div class="p-4 border inline-block">
            {!! QrCode::size(300)->generate($url) !!}
        </div>

        <p class="mt-4 text-sm text-gray-500">Location:
            {{ $bin->location->name }}</p>
        <p class="text-xs text-gray-400 mt-2 font-mono">{{ $bin->qr_token }}</p>

        <div class="mt-6 no-print">
            <button onclick="window.print()"
                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Print
            </button>
            <a href="{{ route('officer.bins.index') }}"
                class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Back to List
            </a>
        </div>
    </div>

</body>

</html>
