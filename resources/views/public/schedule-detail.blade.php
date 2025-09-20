@extends('layouts.public')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
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
                    <a href="{{ route('schedules.public.index') }}"
                        class="text-gray-600 hover:text-green-700 transition-colors">{{ __('public.schedules_breadcrumb') }}</a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-700">{{ $schedule->name }}</span>
                </li>
            </ol>
        </nav>

        <!-- Schedule Content -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Schedule Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 p-8 text-white">
                <div class="flex items-center justify-between mb-4">
                    @php
                        $dayColors = [
                            'senin' => 'bg-blue-100 text-blue-800',
                            'selasa' => 'bg-green-100 text-green-800',
                            'rabu' => 'bg-yellow-100 text-yellow-800',
                            'kamis' => 'bg-purple-100 text-purple-800',
                            'jumat' => 'bg-red-100 text-red-800',
                            'sabtu' => 'bg-indigo-100 text-indigo-800',
                            'minggu' => 'bg-pink-100 text-pink-800',
                        ];
                        $dayColor =
                            $dayColors[strtolower($schedule->day)] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-white bg-opacity-20 text-white">
                        {{ $schedule->day }}
                    </span>
                    <div class="flex items-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-lg font-medium">{{ __('public.schedules_title') }}</span>
                    </div>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ $schedule->name }}</h1>
                <p class="text-green-100 text-lg">{{ __('public.schedules_description') }}</p>
            </div>

            <!-- Schedule Details -->
            <div class="p-8">
                <!-- Time Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('public.schedules_time') }}
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ __('public.schedules_time') }}:</span>
                                <span
                                    class="font-semibold text-gray-900">{{ date('H:i', strtotime($schedule->start_time)) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-gray-600">{{ __('public.schedules_duration') }}:</span>
                                <span
                                    class="font-semibold text-gray-900">{{ date('H:i', strtotime($schedule->end_time)) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span
                                    class="text-gray-600">{{ __('public.schedules_duration') }}:</span>
                                <span class="font-semibold text-gray-900">{{ $schedule->duration }}
                                    menit</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('public.schedule_detail_locations') }}
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Nama Area:</span>
                                <span class="font-semibold text-gray-900">{{ $schedule->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Hari:</span>
                                <span class="font-semibold text-gray-900">{{ $schedule->day }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">{{ __('public.schedules_status') }}:</span>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $schedule->status === 'ongoing' ? 'bg-green-100 text-green-800' : ($schedule->status === 'upcoming' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $schedule->status === 'ongoing' ? __('public.status_ongoing') : ($schedule->status === 'upcoming' ? __('public.status_upcoming') : __('public.status_completed')) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Officer Information -->
                @if ($schedule->officerInCharge)
                    <div class="bg-blue-50 rounded-lg p-6 mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('public.schedule_detail_officer') }}
                        </h3>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-12 w-12 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span
                                        class="text-white font-semibold text-lg">{{ substr($schedule->officerInCharge->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $schedule->officerInCharge->name }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ __('public.schedule_detail_officer') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Locations -->
                @if ($schedule->locations->count() > 0)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ __('public.schedule_detail_locations') }}
                            ({{ $schedule->locations->count() }}
                            {{ __('public.schedules_locations') }})
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($schedule->locations as $location)
                                <div class="bg-gray-50 rounded-lg p-4 border-l-4 border-green-500">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="font-semibold text-gray-900">
                                                {{ $location->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $location->address }}
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Urutan {{ $location->pivot->sequence }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related Schedules -->
        @if ($relatedSchedules->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">
                    {{ __('public.schedule_detail_related') }} - {{ $schedule->day }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($relatedSchedules as $relatedSchedule)
                        <div
                            class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-l-4 border-green-500">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $dayColor }} border">
                                    {{ $relatedSchedule->day }}
                                </span>
                                <div class="flex items-center text-green-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-medium">Jadwal</span>
                                </div>
                            </div>

                            <h3 class="font-bold text-lg text-gray-900 mb-2">
                                {{ $relatedSchedule->name }}</h3>

                            <div class="bg-gray-50 rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm">Waktu</span>
                                    </div>
                                    <span
                                        class="font-semibold text-gray-900">{{ $relatedSchedule->formatted_time }}</span>
                                </div>
                            </div>

                            <div class="flex items-center text-green-600 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>{{ $relatedSchedule->locations->count() }} lokasi</span>
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('public.schedule', $relatedSchedule->id) }}"
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
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back to Schedules -->
        <div class="mt-12 text-center">
            <a href="{{ route('schedules.public.index') }}"
                class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                {{ __('public.schedule_detail_back') }}
            </a>
        </div>
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
    </script>
@endsection
