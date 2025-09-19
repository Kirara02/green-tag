<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenTag - Manajemen Sampah Cerdas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <style>
        @keyframes float { 0% { transform: translateY(0); } 50% { transform: translateY(-8px); } 100% { transform: translateY(0); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        {{ session('success') }}
    </div>
    @endif

    <!-- Navbar -->
    <nav class="bg-green-600 text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="text-xl font-bold flex items-center gap-2"><img src="/logo.svg" alt="Logo GreenTag" class="w-7 h-7"/>GreenTag</a>
            <div class="hidden md:flex space-x-6 items-center">
                <a href="#tentang" class="hover:text-gray-200">Tentang</a>
                <a href="#jadwal" class="hover:text-gray-200">Jadwal</a>
                <a href="#edukasi" class="hover:text-gray-200">Edukasi</a>
                <a href="#kontak" class="hover:text-gray-200">Kontak</a>
                <a href="{{ route('login') }}" class="inline-flex items-center bg-white/90 text-green-700 p-2 rounded-full shadow hover:bg-white transition-colors" aria-label="Login Admin">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M3.75 4.5A2.25 2.25 0 0 1 6 2.25h6A2.25 2.25 0 0 1 14.25 4.5v3a.75.75 0 0 1-1.5 0v-3a.75.75 0 0 0-.75-.75H6a.75.75 0 0 0-.75.75v15a.75.75 0 0 0 .75.75h6a.75.75 0 0 0 .75-.75v-3a.75.75 0 0 1 1.5 0v3A2.25 2.25 0 0 1 12 21.75H6A2.25 2.25 0 0 1 3.75 19.5v-15Z"/><path d="M21 12a.75.75 0 0 1-.22.53l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H10.5a.75.75 0 0 1 0-1.5h6.94l-1.72-1.72a.75.75 0 1 1 1.06-1.06l3 3c.14.14.22.33.22.53Z"/></svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-green-50 via-white to-green-100">
        <div class="max-w-7xl mx-auto px-4 py-20 grid md:grid-cols-2 gap-8 items-center">
            <div class="text-center md:text-left">
                <div class="inline-flex items-center gap-2 bg-white shadow-sm rounded-full px-4 py-1 text-sm text-green-700 border border-green-100"><span class="w-2 h-2 rounded-full bg-green-500"></span>Kota Lebih Hijau, Kelola Sampah Lebih Cerdas</div>
                <h2 class="mt-6 text-4xl md:text-5xl font-extrabold tracking-tight text-green-800">Kelola Sampah Lebih Cerdas, Bersih, dan Bersama</h2>
                <p class="mt-4 text-lg text-gray-600 md:max-w-xl">Scan QR di tempat sampah, kirim pengaduan secara instan, dan ikuti jadwal pengambilan di area Anda.</p>
                <div class="mt-8 flex items-center md:justify-start justify-center gap-4">
                    <button onclick="document.getElementById('complaintDialog').showModal()" class="bg-green-600 text-white px-6 py-3 rounded-xl font-semibold shadow hover:bg-green-700 transition">Kirim Pengaduan</button>
                    <a href="#fitur" class="px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="hidden md:block">
                <svg class="w-full max-w-lg mx-auto animate-float" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="grad" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#34d399"/><stop offset="100%" stop-color="#10b981"/></linearGradient></defs><rect x="40" y="60" width="320" height="180" rx="16" fill="url(#grad)" opacity="0.15"/><rect x="70" y="90" width="260" height="140" rx="12" fill="#fff" stroke="#d1fae5"/><rect x="90" y="120" width="100" height="12" rx="6" fill="#34d399"/><rect x="90" y="140" width="180" height="10" rx="5" fill="#a7f3d0"/><rect x="90" y="160" width="160" height="10" rx="5" fill="#a7f3d0"/><circle cx="310" cy="120" r="14" fill="#10b981"/><path d="M306 120l6 6 10-12" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/><g opacity="0.4"><rect x="240" y="60" width="40" height="10" rx="5" fill="#34d399"/><rect x="120" y="230" width="60" height="10" rx="5" fill="#10b981"/></g></svg>
            </div>
        </div>
    </section>

    <!-- Stats Band -->
    <section class="bg-slate-50 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:divide-x md:divide-slate-200">
                
                <div class="flex items-center justify-center gap-4">
                    <div class="flex-shrink-0 w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M5.25 9a6.75 6.75 0 0 1 13.5 0v.75c0 2.123.8 4.057 2.118 5.52a.75.75 0 0 1-.297 1.206c-1.544.57-3.16.99-4.831 1.243a3.75 3.75 0 1 1-7.48 0c-1.67-.253-3.285-.673-4.83-1.243a.75.75 0 0 1-.298-1.205A8.217 8.217 0 0 0 4.5 9.75V9Zm4.502 8.9a2.25 2.25 0 1 0 4.496 0L12 17.9l-2.248.002Z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="text-left">
                        <div class="text-4xl font-extrabold text-green-700">{{ $stats['complaint_count'] }}+</div>
                        <div class="text-slate-500 font-medium">Pengaduan Diproses</div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <div class="flex-shrink-0 w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M4.5 6A1.5 1.5 0 0 1 6 4.5h12A1.5 1.5 0 0 1 19.5 6v3A1.5 1.5 0 0 1 18 10.5H6A1.5 1.5 0 0 1 4.5 9V6ZM4.5 15A1.5 1.5 0 0 1 6 13.5h12A1.5 1.5 0 0 1 19.5 15v3A1.5 1.5 0 0 1 18 19.5H6A1.5 1.5 0 0 1 4.5 18v-3Z"/></svg>
                    </div>
                    <div class="text-left">
                        <div class="text-4xl font-extrabold text-green-700">{{ $stats['bin_count'] }}+</div>
                        <div class="text-slate-500 font-medium">Tempat Sampah Cerdas</div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <div class="flex-shrink-0 w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a2.25 2.25 0 0 0 .286-.17c1.395-.893 2.824-2.15 3.963-3.793a12.08 12.08 0 0 0 2.592-7.198C21 6.088 17.03 2.25 12 2.25S3 6.088 3 11.25a12.08 12.08 0 0 0 2.592 7.198c1.139 1.643 2.568 2.9 3.963 3.793a2.25 2.25 0 0 0 .286.17l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041ZM12 15a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" /></svg>
                    </div>
                    <div class="text-left">
                        <div class="text-4xl font-extrabold text-green-700">{{ $stats['location_count'] }}+</div>
                        <div class="text-slate-500 font-medium">Lokasi Terjangkau</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Why GreenTag / Features -->
    <section id="fitur" class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Mengapa GreenTag?</h2>
            <div class="mt-3 mx-auto h-1 w-24 bg-green-500 rounded"></div>
            <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">Alat sederhana untuk komunitas dan pengelola untuk menjaga kebersihan kota melalui tiga pilar utama.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            
            <div class="flex flex-col items-start bg-white p-8 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M12 2.25a.75.75 0 0 1 .75.75v6.19l2.53 2.53a.75.75 0 1 1-1.06 1.06l-3-3A.75.75 0 0 1 11 9V3a.75.75 0 0 1 1-.75Z"/><path d="M3 12a9 9 0 1 0 18 0 9 9 0 0 0-18 0Z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold leading-7 text-gray-900">Laporan Cepat & Akurat</h3>
                <p class="mt-4 text-base leading-7 text-gray-600">Kirim masalah dalam hitungan detik. Scan QR di tempat sampah secara otomatis akan melampirkan lokasi yang tepat, membantu tim kami merespon lebih cepat.</p>
            </div>

            <div class="flex flex-col items-start bg-white p-8 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M3.75 6A2.25 2.25 0 0 1 6 3.75h12A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6Zm3 2.25A.75.75 0 0 0 6 9v6a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Zm4.5 0A.75.75 0 0 0 10.5 9v6a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Zm4.5 0A.75.75 0 0 0 15 9v6a.75.75 0 0 0 1.5 0V9a.75.75 0 0 0-.75-.75Z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold leading-7 text-gray-900">Jadwal yang Jelas</h3>
                <p class="mt-4 text-base leading-7 text-gray-600">Tidak perlu lagi menebak-nebak. Akses jadwal pengambilan sampah yang terperinci untuk setiap area, langsung dari halaman utama kami.</p>
            </div>

            <div class="flex flex-col items-start bg-white p-8 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-green-400 to-green-600 text-white shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><path d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-.53 5.72a.75.75 0 0 1 1.06 0l4.5 4.5a.75.75 0 0 1-1.06 1.06L12.75 10.56V18a.75.75 0 0 1-1.5 0v-7.44L9.03 13.53a.75.75 0 1 1-1.06-1.06l4.5-4.5Z"/></svg>
                </div>
                <h3 class="mt-6 text-xl font-semibold leading-7 text-gray-900">Pusat Edukasi</h3>
                <p class="mt-4 text-base leading-7 text-gray-600">Tingkatkan pengetahuan Anda tentang cara memilah sampah, membuat kompos, dan praktik ramah lingkungan lainnya melalui artikel-artikel kami.</p>
            </div>
        </div>
    </section>

    <!-- KODE YANG DIPERBAIKI: Schedule Section -->
    <section id="jadwal" class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-2xl font-bold text-center mb-2">Jadwal Pengambilan</h3>
            <p class="text-center text-gray-600 mb-8">Jadwal pengambilan sampah rutin di area yang terdaftar.</p>
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
            @if($schedules->isNotEmpty())
            <div class="text-center mt-10">
                <a href="{{ route('schedules.public.index') }}" class="px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition">Lihat Semua Jadwal</a>
            </div>
            @endif
        </div>
    </section>

    <!-- Education Section -->
    <section id="edukasi" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-2">Edukasi & Berita</h3>
        <p class="text-center text-gray-600 mb-8">Baca artikel terbaru seputar pengelolaan sampah dan lingkungan.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($articles as $article)
                <div class="bg-white shadow rounded-xl overflow-hidden flex flex-col">
                    @if($article->image)<img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                    @else<div class="w-full h-48 bg-green-50 flex items-center justify-center text-green-300"><svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16" viewBox="0 0 24 24" fill="currentColor"><path d="M8.25 6.75A2.25 2.25 0 0 1 10.5 4.5h3a2.25 2.25 0 0 1 2.25 2.25v12.75a.75.75 0 0 1-1.2.6l-2.55-1.9-2.55 1.9a.75.75 0 0 1-1.2-.6V6.75Z"/></svg></div>
                    @endif
                    <div class="p-6 flex-grow">
                        <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">{{ $article->category }}</span>
                        <h4 class="font-semibold text-gray-800 mt-3">{{ $article->title }}</h4>
                        <p class="text-gray-600 mt-2 text-sm">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-3 text-center text-gray-500 py-8"><p>Belum ada artikel edukasi yang tersedia saat ini.</p></div>
            @endforelse
        </div>
        <!-- KODE YANG DIPERBAIKI: Tombol "Lihat Semua" untuk Edukasi -->
        @if($articles->isNotEmpty())
        <div class="text-center mt-10">
            <a href="{{ route('educations.public.index') }}" class="px-6 py-3 rounded-xl font-semibold border border-green-200 text-green-700 hover:bg-white shadow-sm transition">Lihat Semua Artikel</a>
        </div>
        @endif
    </section>

    <!-- About Section -->
    <section id="tentang" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-6">Tentang GreenTag QR Scan</h3>
        <p class="text-center text-gray-600 max-w-3xl mx-auto">GreenTag QR Scan didedikasikan untuk merevolusi pembuangan sampah dengan mengintegrasikan teknologi kode QR dengan kelestarian lingkungan. Platform kami menawarkan informasi interaktif untuk memandu pengguna dalam daur ulang dan pengelolaan sampah yang bertanggung jawab. Bergabunglah dengan kami dalam menciptakan masa depan yang lebih bersih dan hijau dengan memanfaatkan teknologi cerdas untuk tindakan ramah lingkungan sehari-hari.</p>
    </section>
    
    <!-- FAQ Section -->
    <section id="faq" class="max-w-7xl mx-auto px-4 py-16">
        <h3 class="text-2xl font-bold text-center mb-2">Pertanyaan Umum</h3>
        <p class="text-center text-gray-600 mb-8">Pertanyaan yang sering diajukan seputar GreenTag</p>
        <div class="max-w-3xl mx-auto space-y-3" x-data="{ open: null }">
            <div class="bg-white border border-gray-200 rounded-xl"><button class="w-full text-left px-4 py-3 font-medium flex justify-between items-center" @click="open = open === 1 ? null : 1">Bagaimana cara mengirim pengaduan?<span x-text="open === 1 ? '-' : '+'"></span></button><div x-show="open === 1" x-collapse class="px-4 pb-4 text-gray-600">Gunakan tombol "Kirim Pengaduan" dan isi formulirnya. Jika Anda memindai QR tempat sampah, ID akan terisi otomatis.</div></div>
            <div class="bg-white border border-gray-200 rounded-xl"><button class="w-full text-left px-4 py-3 font-medium flex justify-between items-center" @click="open = open === 2 ? null : 2">Bisakah saya melacak pengaduan saya?<span x-text="open === 2 ? '-' : '+'"></span></button><div x-show="open === 2" x-collapse class="px-4 pb-4 text-gray-600">Fitur pelacakan akan segera hadir. Untuk saat ini, Anda akan dihubungi jika diperlukan informasi lebih lanjut.</div></div>
            <div class="bg-white border border-gray-200 rounded-xl"><button class="w-full text-left px-4 py-3 font-medium flex justify-between items-center" @click="open = open === 3 ? null : 3">Siapa yang dapat mengakses dasbor?<span x-text="open === 3 ? '-' : '+'"></span></button><div x-show="open === 3" x-collapse class="px-4 pb-4 text-gray-600">Hanya admin dan petugas dengan kredensial yang valid.</div></div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center">
                <h3 class="text-3xl font-bold mb-2">Hubungi Kami</h3>
                <p class="text-gray-600 mb-12">Kami siap membantu Anda. Temukan kami di lokasi atau hubungi kami melalui detail di bawah ini.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center bg-white p-8 rounded-2xl shadow-lg">
                
                {{-- Kolom Kiri: Detail Kontak dengan Ikon --}}
                <div class="space-y-8">
                    <div>
                        <h4 class="text-xl font-semibold text-gray-800 mb-4">Detail Kontak</h4>
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a2.25 2.25 0 0 0 .286-.17c1.395-.893 2.824-2.15 3.963-3.793a12.08 12.08 0 0 0 2.592-7.198C21 6.088 17.03 2.25 12 2.25S3 6.088 3 11.25a12.08 12.08 0 0 0 2.592 7.198c1.139 1.643 2.568 2.9 3.963 3.793a2.25 2.25 0 0 0 .286-.17l.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041ZM12 15a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" /></svg>
                            </div>
                            <div>
                                <h5 class="font-semibold text-gray-700">Alamat</h5>
                                <p class="text-gray-600">Uniguard Indonesia, Pasirhalang, Kab. Bandung Barat</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" /><path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" /></svg>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-700">Email</h5>
                            <p class="text-gray-600">info@uniguard.co.id</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6"><path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.298-.083.465a10.89 10.89 0 0 0 5.426 5.426c.167.08.364.052.465-.083l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" /></svg>
                        </div>
                        <div>
                            <h5 class="font-semibold text-gray-700">Telepon</h5>
                            <p class="text-gray-600">+62 822-9990-0331</p>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Google Maps --}}
                <div class="w-full h-80 lg:h-full rounded-2xl overflow-hidden shadow-md border-4 border-white">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.599187321589!2d107.51746507474815!3d-6.831107893181817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e7f2d87a1ac1%3A0xbe1472eb77d64fd4!2sUniguard%20Indonesia!5e0!3m2!1sid!2sid!4v1672898984313!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

            </div>
        </div>
    </section>

    <!-- Dialog: Complaint -->
    <dialog id="complaintDialog" class="backdrop:bg-black/50 rounded-xl p-0 max-w-lg w-[90vw] m-auto">
        <div class="bg-white rounded-xl p-6 w-full">
            <h3 class="text-xl font-bold text-center mb-4">Kirim Pengaduan</h3>
            @if ($errors->any())<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md" role="alert"><strong class="font-bold">Oops! Terjadi kesalahan.</strong><ul class="mt-2 list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
            <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" id="qr_token_input" name="qr_token" value="">
                <div><label for="reporter_name" class="block text-sm font-medium">Nama Anda</label><input type="text" id="reporter_name" name="reporter_name" value="{{ old('reporter_name') }}" class="w-full border rounded-lg px-3 py-2 mt-1" required></div>
                <div><label for="reporter_phone" class="block text-sm font-medium">Nomor Telepon (Opsional)</label><input type="tel" id="reporter_phone" name="reporter_phone" value="{{ old('reporter_phone') }}" class="w-full border rounded-lg px-3 py-2 mt-1"></div>
                <div><label for="address_detail" class="block text-sm font-medium">Detail Alamat (cth: dekat patokan)</label><input type="text" id="address_detail" name="address_detail" value="{{ old('address_detail') }}" class="w-full border rounded-lg px-3 py-2 mt-1" required></div>
                <div><label for="category" class="block text-sm font-medium">Kategori</label><select id="category" name="category" class="w-full border rounded-lg px-3 py-2 mt-1" required><option value="garbage_pile">Tumpukan Sampah</option><option value="odor">Bau Tidak Sedap</option><option value="full_bin">Tempat Sampah Penuh</option><option value="broken_bin">Tempat Sampah Rusak</option><option value="other">Lainnya</option></select></div>
                <div><label for="description" class="block text-sm font-medium">Deskripsi</label><textarea id="description" name="description" rows="4" class="w-full border rounded-lg px-3 py-2 mt-1" required>{{ old('description') }}</textarea></div>
                <div><label for="photo" class="block text-sm font-medium">Foto (opsional, maks 2MB)</label><input type="file" id="photo" name="photo" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"></div>
                <div class="flex justify-end space-x-3 pt-2"><button type="button" onclick="document.getElementById('complaintDialog').close()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Batal</button><button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700">Kirim</button></div>
            </form>
        </div>
    </dialog>

    <!-- Footer -->
    <footer class="bg-green-700 text-white py-10 mt-12">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div><h4 class="font-bold text-lg">GreenTag</h4><p class="text-sm text-green-100 mt-2">Platform manajemen sampah cerdas untuk kota yang lebih bersih.</p></div>
            <div><h5 class="font-semibold">Tautan Cepat</h5><ul class="mt-2 space-y-2 text-green-100"><li><a href="#fitur" class="hover:text-white">Fitur</a></li><li><a href="#jadwal" class="hover:text-white">Jadwal</a></li><li><a href="#edukasi" class="hover:text-white">Edukasi</a></li><li><a href="#faq" class="hover:text-white">FAQ</a></li></ul></div>
            <div><h5 class="font-semibold">Kontak</h5><ul class="mt-2 space-y-1 text-green-100"><li>📍 Jl. Hijau Indah No. 123, Jakarta</li><li>📧 info@greentag.com</li><li>📞 +62 812-3456-7890</li></ul></div>
        </div>
        <div class="border-t border-green-600 mt-8 pt-4 text-center text-sm text-green-100">&copy; {{ date('Y') }} GreenTag. Semua hak cipta dilindungi.</div>
    </footer>

</body>
</html>