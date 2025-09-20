@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.breadcrumb_operational'), 'url' => '#'],
        [
            'label' => __('system.breadcrumb_complaint_management'),
            'url' => route('officer.complaints.index'),
        ],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>@lang('system.complaints_title')</x-slot>

    <div class="max-w-7xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">@lang('system.complaints_title')</h1>
            <p class="text-sm text-gray-500 mt-1">@lang('system.complaints_subtitle')</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 ...">{{ session('success') }}</div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left ...">@lang('system.educations_table_category')</th>
                            <th class="px-6 py-3 text-left ...">@lang('system.nav_locations')</th>
                            <th class="px-6 py-3 text-left ...">@lang('system.users_table_created_at')</th>
                            <th class="px-6 py-3 text-left ...">@lang('system.educations_table_status')</th>
                            <th class="px-6 py-3 text-left ...">@lang('system.users_table_actions')</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($complaints as $complaint)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 ...">@lang('system.category_' . $complaint->category)</td>
                                <td class="px-6 py-4 ...">
                                    {{ $complaint->bin->location->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 ...">
                                    {{ $complaint->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 ...">
                                    @if ($complaint->status == 'new')
                                        <span class="badge-red">@lang('system.status_new')</span>
                                    @elseif($complaint->status == 'in_progress')
                                        <span class="badge-yellow">@lang('system.status_in_progress')</span>
                                    @elseif($complaint->status == 'resolved')
                                        <span class="badge-green">@lang('system.status_resolved')</span>
                                    @else
                                        <span class="badge-gray">@lang('system.status_rejected')</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 ..."><a
                                        href="{{ route('officer.complaints.edit', $complaint->id) }}"
                                        class="text-indigo-600 ...">@lang('system.table_view_details')</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center ...">
                                    @lang('system.complaints_not_found')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">{{ $complaints->links() }}</div>
    </div>
    @push('styles')
        <style>
            ...
        </style>
    @endpush
</x-layout>
