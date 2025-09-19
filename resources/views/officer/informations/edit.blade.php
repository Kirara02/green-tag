@php
    $breadcrumb = [
        [
            'label' => 'Dashboard',
            'url' => route('officer.dashboard.index')
        ],
        [
            'label' => 'Operasional',
            'url' => '#'
        ],
        [
            'label' => 'Manajemen Edukasi',
            'url' => route('officer.informations.index')
        ],
        [
            'label' => 'Edit Artikel',
            'url' => '#'
        ]
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>
        Edit Artikel
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Edit Artikel</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md" role="alert"><ul class="list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif
        
        <form action="{{ route('officer.informations.update', $information->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Kolom Kiri: Konten Utama --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Artikel</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $information->title) }}" required 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content', $information->content) }}">
                        <trix-editor input="content" class="trix-content mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"></trix-editor>
                    </div>
                </div>

                {{-- Kolom Kanan: Metadata --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-medium mb-4">Metadata</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                <select id="category" name="category" required 
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <option value="Edukasi" @selected(old('category', $information->category) == 'Edukasi')>Edukasi</option>
                                    <option value="Berita" @selected(old('category', $information->category) == 'Berita')>Berita</option>
                                    <option value="Pengumuman" @selected(old('category', $information->category) == 'Pengumuman')>Pengumuman</option>
                                </select>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select id="status" name="status" required 
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <option value="published" @selected(old('status', $information->status) == 'published')>Published</option>
                                    <option value="draft" @selected(old('status', $information->status) == 'draft')>Draft</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-medium mb-4">Gambar Utama</h3>
                        @if($information->image)
                            <img src="{{ asset('storage/' . $information->image) }}" alt="Gambar saat ini" class="w-full h-auto rounded-md mb-2 border border-gray-200">
                        @endif
                        <input type="file" id="image" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong untuk mempertahankan gambar saat ini.</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex items-center gap-4"><button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium">Perbarui Artikel</button><a href="{{ route('officer.informations.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">Batal</a></div>
        </form>
    </div>
    @push('styles')<style>.trix-content { min-height: 20rem; background-color: white; } .trix-button-group { border-color: #d1d5db; } .trix-toolbar { background-color: #f9fafb; border-bottom: 1px solid #d1d5db; }</style>@endpush
</x-layout>