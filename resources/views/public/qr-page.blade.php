@extends('layouts.public')

@section('page_title', 'Informasi Tempat Sampah')

@section('content')
    {{-- Inisialisasi state Alpine.js untuk halaman ini --}}
    <div x-data="{ complaintModalOpen: false }" @open-complaint-modal.window="complaintModalOpen = true">
        <div class="relative bg-gradient-to-b from-green-50 via-gray-50 to-gray-50 pt-8 pb-12">
            <div class="max-w-xl mx-auto px-4">

                {{-- Header Informasi --}}
                <div class="text-center mb-8">
                    <span
                        class="inline-block bg-white border border-gray-200 text-green-800 text-sm font-semibold px-3 py-1 rounded-full mb-2">
                        {{ $bin->location->name }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800">
                        @lang('public.qr_page_title')
                    </h1>
                    <p class="text-gray-500 font-mono mt-1 text-sm">
                        @lang('public.qr_page_asset_id'): {{ $bin->code }}
                    </p>
                </div>

                {{-- Info & Aksi Utama --}}
                <div class="bg-white p-6 rounded-2xl shadow-xl mb-8 border border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">
                        @lang('public.qr_page_accepted_waste')
                    </h2>
                    <div class="flex flex-wrap gap-2 mb-6">
                        @if ($bin->accepted_waste_types)
                            @foreach (explode(',', $bin->accepted_waste_types) as $type)
                                <span
                                    class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 rounded-full">{{ trim($type) }}</span>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500">@lang('public.qr_page_no_info')</p>
                        @endif
                    </div>

                    <div class="border-t pt-6">
                        <button @click="complaintModalOpen = true"
                            class="w-full text-center bg-red-600 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-red-700 transition-transform hover:scale-105 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            @lang('public.qr_page_report_button')
                        </button>
                    </div>
                </div>

                <div class="space-y-8">
                    {{-- Kartu Jadwal Pengambilan --}}
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">
                            @lang('public.qr_page_schedule_title')
                        </h2>
                        @if ($bin->location->collectionRoutes->isNotEmpty())
                            <ul class="space-y-4">
                                @foreach ($bin->location->collectionRoutes as $route)
                                    <li class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center font-bold text-xs uppercase">
                                            {{-- Localization hari --}}
                                            @lang('public.day_short_' . strtolower($route->day))
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800">{{ $route->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                {{ date('H:i', strtotime($route->start_time)) }} -
                                                {{ date('H:i', strtotime($route->end_time)) }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-500">@lang('public.qr_page_no_schedule')</p>
                        @endif
                    </div>

                    {{-- Edukasi Terkait --}}
                    <div class="space-y-4">
                        <h2 class="text-xl font-bold text-gray-800 text-center">
                            @lang('public.qr_page_related_education')
                        </h2>
                        @forelse($relatedArticles as $article)
                            <a href="{{ route('public.article', $article->slug) }}"
                                class=" bg-white p-4 rounded-2xl shadow-lg flex items-center gap-4 hover:shadow-xl hover:scale-[1.02] transition-all duration-300 border border-gray-200">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}"
                                        alt="{{ $article->title }}"
                                        class="w-20 h-20 rounded-lg object-cover flex-shrink-0">
                                @else
                                    <div
                                        class="w-20 h-20 bg-green-50 flex items-center justify-center text-green-300 rounded-lg flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M8.25 6.75A2.25 2.25 0 0 1 10.5 4.5h3a2.25 2.25 0 0 1 2.25 2.25v12.75a.75.75 0 0 1-1.2.6l-2.55-1.9-2.55 1.9a.75.75 0 0 1-1.2-.6V6.75Z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <span
                                        class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">
                                        {{ __('public.category_' . strtolower($article->category)) }}
                                    </span>
                                    <h3 class="font-semibold text-gray-800 mt-2">{{ $article->title }}
                                    </h3>
                                </div>
                            </a>
                        @empty
                            <p
                                class="text-sm text-center text-gray-500 bg-white p-4 rounded-xl shadow-lg">
                                @lang('public.qr_page_no_education')
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div x-show="complaintModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;"
            x-trap.noscroll="complaintModalOpen">

            <div @click="complaintModalOpen = false" class="fixed inset-0 bg-black/50"></div>
            <div @click.away="complaintModalOpen = false"
                class="relative bg-white rounded-xl w-full max-w-lg mx-auto" x-show="complaintModalOpen"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">

                <div class="p-6">
                    <h3 class="text-xl font-bold text-center mb-4">@lang('public.complaint_title')</h3>

                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md"
                            role="alert">
                            <strong class="font-bold">@lang('public.complaint_error_title')</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('complaints.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="qr_token" value="{{ $bin->qr_token }}">

                        {{-- Input Nama --}}
                        <div>
                            <label for="reporter_name_modal"
                                class="block text-sm font-medium text-gray-700">
                                @lang('public.complaint_name')
                            </label>
                            <input type="text" id="reporter_name_modal" name="reporter_name"
                                value="{{ old('reporter_name') }}" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                       focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        {{-- Input Telepon --}}
                        <div>
                            <label for="reporter_phone_modal"
                                class="block text-sm font-medium text-gray-700">
                                @lang('public.complaint_phone')
                            </label>
                            <input type="tel" id="reporter_phone_modal" name="reporter_phone"
                                value="{{ old('reporter_phone') }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                       focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        {{-- Input Alamat --}}
                        <div>
                            <label for="address_detail_modal"
                                class="block text-sm font-medium text-gray-700">
                                @lang('public.complaint_address')
                            </label>
                            <input type="text" id="address_detail_modal" name="address_detail"
                                value="{{ old('address_detail') }}" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                       focus:outline-none focus:ring-green-500 focus:border-green-500">
                        </div>

                        {{-- Select Kategori --}}
                        <div>
                            <label for="category_modal"
                                class="block text-sm font-medium text-gray-700">
                                @lang('public.complaint_category')
                            </label>
                            <select id="category_modal" name="category" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm 
                       focus:outline-none focus:ring-green-500 focus:border-green-500">
                                @foreach (__('public.complaint_categories') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Input Deskripsi --}}
                        <div>
                            <label for="description_modal"
                                class="block text-sm font-medium text-gray-700">
                                @lang('public.complaint_description')
                            </label>
                            <textarea id="description_modal" name="description" rows="4" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                       focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('description') }}</textarea>
                        </div>

                        {{-- Upload Foto --}}
                        <div>
                            <label for="photo_modal" class="block text-sm font-medium text-gray-700">
                                @lang('public.complaint_photo')
                            </label>
                            <input type="file" id="photo_modal" name="photo" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                       file:rounded-full file:border-0 file:text-sm file:font-semibold 
                       file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end space-x-3 pt-2">
                            <button type="button" @click="complaintModalOpen = false"
                                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 font-medium text-sm">
                                @lang('public.complaint_cancel')
                            </button>
                            <button type="submit"
                                class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 text-sm">
                                @lang('public.complaint_submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        // Jika ada error validasi setelah submit form, dialog akan otomatis terbuka kembali.
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('open-complaint-modal'));
            });
        @endif
    </script>
@endpush
