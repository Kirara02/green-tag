<x-layout>
    {{-- Mengirim judul halaman ke layout melalui named slot 'page_title' --}}
    <x-slot:page_title>
        Dasbor Admin
    </x-slot>

    {{-- Seluruh konten sekarang berada langsung di dalam <x-layout> --}}
    <div>
        <!-- Header Sambutan -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Dasbor Admin</h1>
            <p class="mt-1 text-sm text-gray-600">Selamat datang, {{ Auth::user()->name }}! Berikut adalah gambaran umum sistem.</p>
        </div>

        <!-- Grid Kartu Statistik Utama -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white p-6 rounded-lg shadow-md"><p class="text-sm font-medium text-gray-500">Total Petugas</p><p class="mt-1 text-3xl font-semibold">{{ $stats['total_officers'] }}</p></div>
            <div class="bg-white p-6 rounded-lg shadow-md"><p class="text-sm font-medium text-gray-500">Total Tempat Sampah</p><p class="mt-1 text-3xl font-semibold">{{ $stats['total_bins'] }}</p></div>
            <div class="bg-white p-6 rounded-lg shadow-md"><p class="text-sm font-medium text-gray-500">Pengaduan Baru</p><p class="mt-1 text-3xl font-semibold text-red-600">{{ $stats['new_complaints'] }}</p></div>
            <div class="bg-white p-6 rounded-lg shadow-md"><p class="text-sm font-medium text-gray-500">Pengaduan Selesai</p><p class="mt-1 text-3xl font-semibold text-green-600">{{ $stats['resolved_complaints'] }}</p></div>
        </div>

        <!-- Grid untuk Grafik dan Aktivitas -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900">Tren Pengaduan (7 Hari Terakhir)</h3>
                <div class="mt-4 relative h-72">
                    <canvas id="complaintsChart"></canvas>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-medium text-gray-900">Komposisi Kategori</h3>
                <div class="mt-4 relative h-64">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Daftar Aktivitas Terbaru -->
        <div class="mt-8 bg-white shadow-md rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900">Aktivitas Pengaduan Terbaru</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="divide-y">
                        @forelse($recent_complaints as $complaint)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ ucwords(str_replace('_', ' ', $complaint->category)) }}</div><div class="text-sm text-gray-500">{{ $complaint->bin->location->name ?? 'N/A' }}</div></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $complaint->created_at->diffForHumans() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($complaint->status == 'new') <span class="badge-red">New</span>
                                @elseif($complaint->status == 'in_progress') <span class="badge-yellow">In Progress</span>
                                @elseif($complaint->status == 'resolved') <span class="badge-green">Resolved</span>
                                @else <span class="badge-gray">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"><a href="{{ route('officer.complaints.edit', $complaint->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a></td>
                        </tr>
                        @empty
                        <tr class="hover:bg-gray-50"><td class="px-6 py-4 text-center text-gray-500" colspan="4">Tidak ada aktivitas pengaduan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .badge-red { @apply px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800; }
        .badge-yellow { @apply px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800; }
        .badge-green { @apply px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800; }
        .badge-gray { @apply px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800; }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Kode JavaScript Anda sekarang akan berjalan dengan benar
        const complaintLabels = @json($chart_labels);
        const complaintValues = @json($chart_values);
        const categoryLabels = @json($category_distribution->keys());
        const categoryValues = @json($category_distribution->values());
        const ctxComplaints = document.getElementById('complaintsChart').getContext('2d');
        new Chart(ctxComplaints, {
            type: 'line', data: { labels: complaintLabels, datasets: [{ label: 'Jumlah Pengaduan', data: complaintValues, borderColor: 'rgb(22, 163, 74)', backgroundColor: 'rgba(22, 163, 74, 0.1)', fill: true, tension: 0.3 }] },
            options: { responsive: true, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
        });
        const ctxCategory = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctxCategory, {
            type: 'doughnut', data: { labels: categoryLabels.map(label => label.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase())), datasets: [{ label: 'Jumlah', data: categoryValues, backgroundColor: ['rgba(239, 68, 68, 0.8)','rgba(234, 179, 8, 0.8)','rgba(59, 130, 246, 0.8)','rgba(107, 114, 128, 0.8)','rgba(139, 92, 246, 0.8)',], hoverOffset: 4 }] },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
    @endpush
</x-layout>