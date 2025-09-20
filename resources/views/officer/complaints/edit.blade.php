@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.breadcrumb_operational'), 'url' => '#'],
        [
            'label' => __('system.breadcrumb_complaint_management'),
            'url' => route('officer.complaints.index'),
        ],
        ['label' => __('system.breadcrumb_complaint_details'), 'url' => '#'],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>@lang('system.complaints_details_title')</x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">@lang('system.complaints_details_title')</h1>
            <p class="text-sm text-gray-500 mt-1">@lang('system.complaints_details_subtitle')</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">@lang('system.complaints_details_title')</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.educations_table_category')</label>
                            <p class="mt-1 ...">@lang('system.category_' . $complaint->category)</p>
                        </div>
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.nav_locations')</label>
                            <p class="mt-1 ...">{{ $complaint->bin->location->name }}</p>
                        </div>
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.complaints_bin_code')</label>
                            <p class="mt-1 ...">{{ $complaint->bin->code }}</p>
                        </div>
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.form_content')</label>
                            <p class="mt-1 ...">{{ $complaint->description }}</p>
                        </div>
                        @if ($complaint->photo)
                            <div><label
                                    class="text-sm font-medium text-gray-500">@lang('system.complaints_attached_photo')</label>
                                <div class="mt-2"><a href="..." target="_blank"><img
                                            src="..." alt="Foto Pengaduan" class="..."></a>
                                    <p class="text-xs ...">@lang('system.complaints_photo_enlarge')</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="bg-white shadow-md rounded-lg">
                    <div class="px-6 py-4 border-b">
                        <h3 class="text-lg font-semibold text-gray-800">@lang('system.complaints_reporter_info')</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.complaints_reporter_name')</label>
                            <p class="mt-1 ...">{{ $complaint->reporter_name }}</p>
                        </div>
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.complaints_reporter_phone')</label>
                            <p class="mt-1 ...">
                                {{ $complaint->reporter_phone ?? __('system.complaints_reporter_not_provided') }}
                            </p>
                        </div>
                        <div><label
                                class="text-sm font-medium text-gray-500">@lang('system.complaints_reporter_address')</label>
                            <p class="mt-1 ...">{{ $complaint->address_detail }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <form action="{{ route('officer.complaints.update', $complaint->id) }}"
                    method="POST" class="bg-white shadow-md rounded-lg lg:sticky lg:top-6">
                    @csrf @method('PUT')
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800">@lang('system.form_actions')</h3>
                        <p class="text-sm text-gray-500 mt-1">@lang('system.form_actions_subtitle')</p>
                    </div>
                    <div class="p-6 border-t space-y-4">
                        <div>
                            <label for="status"
                                class="block text-sm font-medium text-gray-700">@lang('system.form_set_status')</label>
                            <select id="status" name="status"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="new" @selected($complaint->status == 'new')>
                                    @lang('system.status_new')</option>
                                <option value="in_progress" @selected($complaint->status == 'in_progress')>
                                    @lang('system.status_in_progress')</option>
                                <option value="resolved" @selected($complaint->status == 'resolved')>
                                    @lang('system.status_resolved')</option>
                                <option value="rejected" @selected($complaint->status == 'rejected')>
                                    @lang('system.status_rejected')</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 ...">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="resolution_notes"
                                class="block text-sm font-medium text-gray-700">@lang('system.form_resolution_notes')</label>
                            <textarea id="resolution_notes" name="resolution_notes" rows="6"
                                placeholder="@lang('system.form_resolution_notes_placeholder')"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">{{ old('resolution_notes', $complaint->resolution_notes) }}</textarea>
                            @error('resolution_notes')
                                <p class="text-red-500 ...">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 ...">
                        <a href="{{ route('officer.complaints.index') }}"
                            class="text-sm font-medium ...">&larr; @lang('system.btn_back_to_list')</a>
                        <button type="submit"
                            class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-semibold text-sm transition-colors">@lang('system.btn_update_complaint')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
