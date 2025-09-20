@php
    $breadcrumb = [
        [
            'label' => 'Dashboard',
            'url' => route('officer.dashboard.index'),
        ],
        [
            'label' => 'Operasional',
            'url' => '#',
        ],
        [
            'label' => 'Manajemen Pengaduan',
            'url' => '#',
        ],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>
        Manajemen Pengaduan
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <!-- Header Halaman -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengaduan</h1>
            <p class="text-sm text-gray-500 mt-1">Tinjau dan kelola semua pengaduan yang masuk dari
                warga.</p>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4"
                role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabel Data Pengaduan -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Lokasi</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Dilaporkan Pada</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($complaints as $complaint)
                            <tr class="hover:bg-gray-50">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ ucwords(str_replace('_', ' ', $complaint->category)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $complaint->bin->location->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $complaint->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($complaint->status == 'new')
                                        <span class="badge-red">Baru</span>
                                    @elseif($complaint->status == 'in_progress')
                                        <span class="badge-yellow">Diproses</span>
                                    @elseif($complaint->status == 'resolved')
                                        <span class="badge-green">Selesai</span>
                                    @else
                                        <span class="badge-gray">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('officer.complaints.edit', $complaint->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">Lihat
                                        Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada
                                    pengaduan yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">{{ $complaints->links() }}</div>
    </div>

    {{-- Style untuk lencana status, sama seperti di dasbor --}}
    @push('styles')
        <style>
            .badge-red {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800;
            }

            .badge-yellow {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800;
            }

            .badge-green {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800;
            }

            .badge-gray {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800;
            }
        </style>
    @endpush
</x-layout>
