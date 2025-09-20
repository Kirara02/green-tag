@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.nav_group_master_data'), 'url' => '#'],
        ['label' => __('system.breadcrumb_bin_management'), 'url' => route('officer.bins.index')],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>
        @lang('system.bins_title')
    </x-slot>

    <div class="max-w-7xl mx-auto">
        <!-- Header Halaman -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">@lang('system.bins_title')</h1>
                <p class="text-sm text-gray-500 mt-1">@lang('system.bins_subtitle')</p>
            </div>
            <a href="{{ route('officer.bins.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 text-sm font-medium flex items-center gap-2 self-start">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5">
                    <path
                        d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>
                @lang('system.bins_add_new')
            </a>
        </div>

        <!-- Notifikasi -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4"
                role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                @lang('system.bins_table_asset_code')</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                @lang('system.nav_locations')</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                @lang('system.bins_table_qr_token')</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                @lang('system.bins_table_accepted_waste')</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                @lang('system.users_table_actions')</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bins as $bin)
                            <tr class="hover:bg-gray-50">
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 font-mono">
                                    {{ $bin->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $bin->location->name ?? 'N/A' }}</td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">
                                    {{ $bin->qr_token }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($bin->accepted_waste_types)
                                        @foreach (explode(',', $bin->accepted_waste_types) as $type)
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold bg-gray-100 text-gray-700 rounded-full mr-1 mb-1">{{ trim($type) }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                    <a href="{{ route('officer.bins.qr_code', $bin->id) }}"
                                        target="_blank"
                                        class="text-green-600 hover:text-green-900">@lang('system.bins_show_qr')</a>
                                    <a href="{{ route('officer.bins.edit', $bin->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900">@lang('system.action_edit')</a>
                                    <form action="{{ route('officer.bins.destroy', $bin->id) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('@lang('system.bins_delete_confirm')');">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900">@lang('system.action_delete')</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="px-6 py-4 text-center text-sm text-gray-500">
                                    @lang('system.bins_not_found')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">{{ $bins->links() }}</div>
    </div>
</x-layout>
