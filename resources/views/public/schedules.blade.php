<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Jadwal Pengambilan - GreenTag</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <a href="{{ route('landing') }}" class="text-green-600 hover:underline mb-4 inline-block">&larr; Kembali ke Beranda</a>
        <h1 class="text-3xl font-bold text-center mb-2">Semua Jadwal Pengambilan</h1>
        <p class="text-center text-gray-600 mb-8">Temukan semua jadwal pengambilan sampah yang terdaftar.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($schedules as $schedule)
                <div class="bg-white shadow rounded-xl p-6">
                    <h4 class="font-bold text-lg text-green-700">{{ $schedule->day }}</h4>
                    <p class="font-semibold text-gray-800 mt-2">{{ $schedule->name }}</p>
                    <p class="text-sm text-gray-500">{{ date('H:i', strtotime($schedule->start_time)) }} - {{ date('H:i', strtotime($schedule->end_time)) }}</p>
                </div>
            @empty
                <div class="lg:col-span-3 text-center text-gray-500 py-8"><p>Jadwal pengambilan belum dipublikasikan.</p></div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $schedules->links() }}
        </div>
    </div>
</body>
</html>