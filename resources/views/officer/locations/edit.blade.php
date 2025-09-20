@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.nav_group_master_data'), 'url' => '#'],
        [
            'label' => __('system.breadcrumb_location_management'),
            'url' => route('officer.locations.index'),
        ],
        ['label' => __('system.breadcrumb_edit_location'), 'url' => '#'],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>
        @lang('system.locations_edit_title')
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">@lang('system.locations_edit_title')</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
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

            <form action="{{ route('officer.locations.update', $location->id) }}" method="POST"
                class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="code"
                        class="block text-sm font-medium text-gray-700">@lang('system.form_location_code')</label>
                    <input type="text" id="code" name="code"
                        value="{{ old('code', $location->code) }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="name"
                        class="block text-sm font-medium text-gray-700">@lang('system.form_location_name')</label>
                    <input type="text" id="name" name="name"
                        value="{{ old('name', $location->name) }}" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                </div>
                <div>
                    <label for="address"
                        class="block text-sm font-medium text-gray-700">@lang('system.form_full_address')</label>
                    <textarea id="address" name="address" rows="4" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('address', $location->address) }}</textarea>
                </div>
                <div class="flex items-center gap-4 pt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium transition-colors">@lang('system.btn_update_location')</button>
                    <a href="{{ route('officer.locations.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium transition-colors">@lang('system.btn_cancel')</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
