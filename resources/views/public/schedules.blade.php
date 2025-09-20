@extends('layouts.public')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm font-medium text-gray-500 mb-6"
            aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li>
                    <a href="{{ route('landing') }}"
                        class="text-gray-600 hover:text-green-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        {{ __('public.home') }}
                    </a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-700">{{ __('public.schedules_breadcrumb') }}</span>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ __('public.schedules_title') }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ __('public.schedules_description') }}
            </p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchInput"
                            placeholder="{{ __('public.schedules_search_placeholder') }}"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="sm:w-48">
                    <select id="dayFilter"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">{{ __('public.all_days') }}</option>
                        <option value="Senin">{{ __('public.day_monday') }}</option>
                        <option value="Selasa">{{ __('public.day_tuesday') }}</option>
                        <option value="Rabu">{{ __('public.day_wednesday') }}</option>
                        <option value="Kamis">{{ __('public.day_thursday') }}</option>
                        <option value="Jumat">{{ __('public.day_friday') }}</option>
                        <option value="Sabtu">{{ __('public.day_saturday') }}</option>
                        <option value="Minggu">{{ __('public.day_sunday') }}</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Schedules Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($schedules as $schedule)
                @php
                    $dayColors = [
                        'senin' => 'bg-blue-100 text-blue-800 border-blue-200',
                        'selasa' => 'bg-green-100 text-green-800 border-green-200',
                        'rabu' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'kamis' => 'bg-purple-100 text-purple-800 border-purple-200',
                        'jumat' => 'bg-red-100 text-red-800 border-red-200',
                        'sabtu' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                        'minggu' => 'bg-pink-100 text-pink-800 border-pink-200',
                    ];
                    $dayColor =
                        $dayColors[strtolower($schedule->day)] ??
                        'bg-gray-100 text-gray-800 border-gray-200';
                @endphp
                <div
                    class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-l-4 border-green-500">
                    <div class="flex items-center justify-between mb-4">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $dayColor }} border">
                            {{ $schedule->day }}
                        </span>
                        <div class="flex items-center text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">{{ __('public.schedules_title') }}</span>
                        </div>
                    </div>

                    <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $schedule->name }}</h3>

                    <div class="bg-gray-50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm">{{ __('public.schedules_time') }}</span>
                            </div>
                            <span
                                class="font-semibold text-gray-900">{{ date('H:i', strtotime($schedule->start_time)) }}</span>
                        </div>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm">{{ __('public.schedules_duration') }}</span>
                            </div>
                            <span
                                class="font-semibold text-gray-900">{{ date('H:i', strtotime($schedule->end_time)) }}</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-green-600 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $schedule->locations->count() }}
                                {{ __('public.schedules_locations') }}</span>
                        </div>
                        <a href="{{ route('public.schedule', $schedule->id) }}"
                            class="inline-flex items-center text-green-600 hover:text-green-700 font-medium text-sm transition-colors">
                            {{ __('public.view_details') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="lg:col-span-3 text-center py-16">
                    <div class="max-w-md mx-auto">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-16 w-16 text-gray-300 mx-auto mb-4" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            {{ __('public.schedules_empty_title') }}</h3>
                        <p class="text-gray-500">{{ __('public.schedules_empty_description') }}</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($schedules->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-lg shadow-sm p-4">
                    {{ $schedules->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Scroll to Top Button -->
    <button id="scrollToTop"
        class="fixed bottom-6 right-6 bg-green-600 text-white p-3 rounded-full shadow-lg hover:bg-green-700 transition-all duration-300 opacity-0 invisible">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20"
            fill="currentColor">
            <path fill-rule="evenodd"
                d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <script>
        // Scroll to top functionality
        const scrollToTopBtn = document.getElementById('scrollToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.remove('opacity-0', 'invisible');
                scrollToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollToTopBtn.classList.add('opacity-0', 'invisible');
                scrollToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Search and Filter functionality
        const searchInput = document.getElementById('searchInput');
        const dayFilter = document.getElementById('dayFilter');

        // Function to update URL and reload page with filters
        function applyFilters() {
            const searchTerm = searchInput.value.trim();
            const day = dayFilter.value;

            const url = new URL(window.location);

            // Update URL parameters
            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }

            if (day) {
                url.searchParams.set('day', day);
            } else {
                url.searchParams.delete('day');
            }

            // Reload page with new parameters
            window.location.href = url.toString();
        }

        // Add event listeners
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        dayFilter.addEventListener('change', function() {
            applyFilters();
        });

        // Set current values from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const currentSearch = urlParams.get('search');
        const currentDay = urlParams.get('day');

        if (currentSearch) {
            searchInput.value = currentSearch;
        }

        if (currentDay) {
            dayFilter.value = currentDay;
        }
    </script>
@endsection
