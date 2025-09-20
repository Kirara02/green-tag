@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.breadcrumb_operational'), 'url' => '#'],
        [
            'label' => __('system.breadcrumb_schedule_management'),
            'url' => route('officer.schedules.index'),
        ],
        ['label' => __('system.breadcrumb_edit_schedule'), 'url' => '#'],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>
        @lang('system.schedules_edit_title')
    </x-slot>

    {{-- Fungsi Alpine.js tidak berubah --}}
    <script>
        function scheduleForm(initialLocations = []) {
            return {
                search: '',
                selectedLocations: initialLocations,
                filter(locationName) {
                    return this.search === '' || locationName.toLowerCase().includes(this.search
                        .toLowerCase());
                },
                toggleAll(event) {
                    if (event.target.checked) {
                        // Ambil semua ID dari lokasi yang terlihat (difilter)
                        let visibleLocationIds = [];
                        document.querySelectorAll('.location-checkbox-item').forEach(el => {
                            if (el.style.display !== 'none') {
                                visibleLocationIds.push(parseInt(el.querySelector('input')
                                    .value));
                            }
                        });
                        this.selectedLocations = [...new Set([...this.selectedLocations, ...
                            visibleLocationIds
                        ])];
                    } else {
                        this.selectedLocations = [];
                    }
                }
            }
        }
    </script>

    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">@lang('system.schedules_edit_subtitle', ['name' => $schedule->name])</h1>

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md"
                role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('officer.schedules.update', $schedule->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8" x-data="scheduleForm(@json(old('locations', $selectedLocations)))">

                {{-- Kolom Kiri: Detail Jadwal --}}
                <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6 space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-3 mb-4">
                            @lang('system.form_route_details')</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700">@lang('system.schedules_table_route_name')</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $schedule->name) }}" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label for="day"
                                    class="block text-sm font-medium text-gray-700">@lang('system.schedules_table_day')</label>
                                <select id="day" name="day" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <option value="Monday" @selected(old('day', $schedule->day) == 'Monday')>
                                        @lang('public.day_monday')</option>
                                    <option value="Tuesday" @selected(old('day', $schedule->day) == 'Tuesday')>
                                        @lang('public.day_tuesday')</option>
                                    <option value="Wednesday" @selected(old('day', $schedule->day) == 'Wednesday')>
                                        @lang('public.day_wednesday')</option>
                                    <option value="Thursday" @selected(old('day', $schedule->day) == 'Thursday')>
                                        @lang('public.day_thursday')</option>
                                    <option value="Friday" @selected(old('day', $schedule->day) == 'Friday')>
                                        @lang('public.day_friday')</option>
                                    <option value="Saturday" @selected(old('day', $schedule->day) == 'Saturday')>
                                        @lang('public.day_saturday')</option>
                                    <option value="Sunday" @selected(old('day', $schedule->day) == 'Sunday')>
                                        @lang('public.day_sunday')</option>
                                </select>
                            </div>
                            <div>
                                <label for="start_time"
                                    class="block text-sm font-medium text-gray-700">@lang('system.form_start_time')</label>
                                <input type="time" id="start_time" name="start_time"
                                    value="{{ old('start_time', $schedule->start_time) }}" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label for="end_time"
                                    class="block text-sm font-medium text-gray-700">@lang('system.form_end_time')</label>
                                <input type="time" id="end_time" name="end_time"
                                    value="{{ old('end_time', $schedule->end_time) }}" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Penetapan Lokasi --}}
                <div class="lg:col-span-1 bg-white shadow-md rounded-lg">
                    <div class="p-6">
                        <label for="location_search"
                            class="block text-sm font-medium text-gray-700">@lang('system.form_assign_locations')</label>
                        <p class="text-xs text-gray-500 mt-1">@lang('system.form_assign_locations_help')</p>
                        <input type="text" id="location_search" x-model="search"
                            placeholder="@lang('system.form_search_location_placeholder')"
                            class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <div class="mt-3 flex justify-between items-center text-xs">
                            <span class="font-semibold text-green-700"><span
                                    x-text="selectedLocations.length"></span>
                                @lang('system.form_selected_locations')</span>
                            <div class="flex items-center"><input type="checkbox"
                                    @click="toggleAll($event)"
                                    class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500 mr-1"><label>@lang('system.form_select_all')</label>
                            </div>
                        </div>
                    </div>
                    <div class="border-t p-4 h-64 overflow-y-auto space-y-2">
                        @forelse($locations as $location)
                            <div class="location-checkbox-item flex items-center p-2 rounded-md hover:bg-gray-100"
                                x-show="filter('{{ strtolower($location->name . ' ' . $location->code) }}')">
                                <input type="checkbox" id="location_{{ $location->id }}"
                                    name="locations[]" value="{{ $location->id }}"
                                    x-model="selectedLocations"
                                    class="h-4 w-4 rounded border-gray-300 text-green-600 focus:ring-green-500">
                                <label for="location_{{ $location->id }}"
                                    class="ml-3 block text-sm text-gray-700">{{ $location->name }}</label>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500 py-4">@lang('system.form_no_locations_found')</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="mt-8 flex items-center gap-4">
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium transition-colors">@lang('system.btn_update_schedule')</button>
                <a href="{{ route('officer.schedules.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium transition-colors">@lang('system.btn_cancel')</a>
            </div>
        </form>
    </div>
</x-layout>
