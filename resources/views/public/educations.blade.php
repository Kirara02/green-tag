<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edukasi & Berita - GreenTag</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <a href="{{ route('landing') }}" class="text-green-600 hover:underline mb-4 inline-block">&larr; Kembali ke Beranda</a>
        <h1 class="text-3xl font-bold text-center mb-2">Edukasi & Berita</h1>
        <p class="text-center text-gray-600 mb-8">Baca semua artikel terbaru seputar pengelolaan sampah.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($articles as $article)
                <div class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-green-50 flex items-center justify-center text-green-300"><svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" viewBox="0 0 24 24" fill="currentColor"><path d="M8.25 6.75A2.25 2.25 0 0 1 10.5 4.5h3a2.25 2.25 0 0 1 2.25 2.25v12.75a.75.75 0 0 1-1.2.6l-2.55-1.9-2.55 1.9a.75.75 0 0 1-1.2-.6V6.75Z"/></svg></div>
                    @endif
                    <div class="p-6 flex-grow">
                        <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">{{ $article->category }}</span>
                        <h4 class="font-semibold text-gray-800 mt-3">{{ $article->title }}</h4>
                        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-3 text-center text-gray-500 py-8"><p>Belum ada artikel edukasi yang tersedia.</p></div>
            @endforelse
        </div>
        
        <div class="mt-10">
            {{ $articles->links() }}
        </div>
    </div>
</body>
</html>