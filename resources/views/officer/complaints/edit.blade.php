<x-layout>
    <x-slot:page_title>
        Detail Pengaduan
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Detail Pengaduan</h1>
            <p class="text-sm text-gray-500 mt-1">Tinjau dan perbarui status pengaduan.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- KOLOM KIRI: DETAIL PENGADUAN (LEBIH LEBAR) --}}
            <div class="lg:col-span-2 space-y-6">
                <!-- KARTU DETAIL PENGADUAN -->
                <div class="bg-white shadow-md rounded-lg">
                    <div class="px-6 py-4 border-b"><h3 class="text-lg font-semibold text-gray-800">Detail Pengaduan</h3></div>
                    <div class="p-6 space-y-6">
                        <div><label class="text-sm font-medium text-gray-500">Kategori</label><p class="mt-1 text-base text-gray-900 font-semibold">{{ ucwords(str_replace('_', ' ', $complaint->category)) }}</p></div>
                        <div><label class="text-sm font-medium text-gray-500">Lokasi</label><p class="mt-1 text-base text-gray-900">{{ $complaint->bin->location->name }}</p></div>
                        <div><label class="text-sm font-medium text-gray-500">Kode Tempat Sampah</label><p class="mt-1 text-base text-gray-900 font-mono">{{ $complaint->bin->code }}</p></div>
                        <div><label class="text-sm font-medium text-gray-500">Deskripsi</label><p class="mt-1 text-base text-gray-900 whitespace-pre-wrap">{{ $complaint->description }}</p></div>
                        @if($complaint->photo)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Foto Terlampir</label>
                            <div class="mt-2"><a href="{{ asset('storage/' . $complaint->photo) }}" target="_blank" class="inline-block"><img src="{{ asset('storage/' . $complaint->photo) }}" alt="Foto Pengaduan" class="w-full max-w-sm h-auto rounded-md border-2 border-gray-200 hover:border-green-500 transition"></a><p class="text-xs text-gray-500 mt-1">Klik gambar untuk memperbesar</p></div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- KARTU INFORMASI PELAPOR -->
                <div class="bg-white shadow-md rounded-lg">
                     <div class="px-6 py-4 border-b"><h3 class="text-lg font-semibold text-gray-800">Informasi Pelapor</h3></div>
                    <div class="p-6 space-y-6">
                        <div><label class="text-sm font-medium text-gray-500">Nama Pelapor</label><p class="mt-1 text-base text-gray-900">{{ $complaint->reporter_name }}</p></div>
                        <div><label class="text-sm font-medium text-gray-500">Telepon Pelapor</label><p class="mt-1 text-base text-gray-900">{{ $complaint->reporter_phone ?? 'Tidak diberikan' }}</p></div>
                        <div><label class="text-sm font-medium text-gray-500">Detail Alamat Pelapor</label><p class="mt-1 text-base text-gray-900">{{ $complaint->address_detail }}</p></div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: FORM UPDATE (TETAP DI ATAS) --}}
            <div class="lg:col-span-1">
                <form action="{{ route('officer.complaints.update', $complaint->id) }}" method="POST" class="bg-white shadow-md rounded-lg lg:sticky lg:top-6">
                    @csrf
                    @method('PUT')
                    <div class="p-6"><h3 class="text-lg font-semibold text-gray-800">Aksi</h3><p class="text-sm text-gray-500 mt-1">Perbarui status dan tambahkan catatan penyelesaian.</p></div>
                    <div class="p-6 border-t space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Atur Status</label>
                            <select id="status" name="status" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="new" @selected($complaint->status == 'new')>Baru</option>
                                <option value="in_progress" @selected($complaint->status == 'in_progress')>Sedang Diproses</option>
                                <option value="resolved" @selected($complaint->status == 'resolved')>Selesai</option>
                                <option value="rejected" @selected($complaint->status == 'rejected')>Ditolak</option>
                            </select>
                            @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="resolution_notes" class="block text-sm font-medium text-gray-700">Catatan Penyelesaian</label>
                            <textarea id="resolution_notes" name="resolution_notes" rows="6" placeholder="Tambahkan catatan jika status Selesai atau Ditolak..." class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('resolution_notes', $complaint->resolution_notes) }}</textarea>
                            @error('resolution_notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 border-t rounded-b-lg flex items-center justify-between">
                        <a href="{{ route('officer.complaints.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">&larr; Kembali ke daftar</a>
                        <button type="submit" class="px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold text-sm">Perbarui Pengaduan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>