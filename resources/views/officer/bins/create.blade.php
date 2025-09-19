@php
    $breadcrumb = [
        [
            'label' => 'Dashboard',
            'url' => route('officer.dashboard.index')
        ],
        [
            'label' => 'Master Data',
            'url' => '#'
        ],
        [
            'label' => 'Manajemen Tempat Sampah',
            'url' => route('officer.bins.index')
        ],
        [
            'label' => 'Tambah Tempat Sampah',
            'url' => '#'
        ]
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>
        Tambah Tempat Sampah
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Tambah Tempat Sampah Baru</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md" role="alert"><ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif

            <form action="{{ route('officer.bins.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="bin_location_id" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <select id="bin_location_id" name="bin_location_id" required 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">-- Pilih Lokasi --</option>
                        @forelse($locations as $location)
                        <option value="{{ $location->id }}" @selected(old('bin_location_id') == $location->id)>
                            {{ $location->name }} ({{ $location->code }})
                        </option>
                        @empty
                        <option value="" disabled>Tidak ada lokasi. Buat lokasi terlebih dahulu.</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Kode Aset (Unik)</label>
                    <input type="text" id="code" name="code" value="{{ old('code') }}" required placeholder="e.g., BIN-PLASTIC-001"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <input type="text" id="description" name="description" value="{{ old('description') }}" placeholder="e.g., Khusus Botol Plastik"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium">Simpan</button>
                    <a href="{{ route('officer.bins.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>