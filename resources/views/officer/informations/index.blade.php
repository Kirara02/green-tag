@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.breadcrumb_operational'), 'url' => '#'],
        [
            'label' => __('system.breadcrumb_education_management'),
            'url' => route('officer.informations.index'),
        ],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>@lang('system.educations_title')</x-slot>

    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold">@lang('system.educations_title')</h1>
                <p class="text-sm text-gray-500 mt-1">@lang('system.educations_subtitle')</p>
            </div>
            <a href="{{ route('officer.informations.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded-lg flex items-center gap-2"><svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5">
                    <path
                        d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                </svg>@lang('system.educations_add_new')</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}</div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr class="text-left text-xs font-medium text-gray-500 uppercase">
                            <th class="px-6 py-3">@lang('system.educations_table_image')</th>
                            <th class="px-6 py-3">@lang('system.educations_table_title')</th>
                            <th class="px-6 py-3">@lang('system.educations_table_category')</th>
                            <th class="px-6 py-3">@lang('system.educations_table_status')</th>
                            <th class="px-6 py-3">@lang('system.educations_table_author')</th>
                            <th class="px-6 py-3">@lang('system.educations_table_actions')</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($articles as $article)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}"
                                            alt=""
                                        class="h-10 w-16 object-cover rounded">@else<div
                                            class="h-10 w-16 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                            No Img</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ Str::limit($article->title, 40) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">@lang('public.category_' . $article->category)</td>
                                <td class="px-6 py-4">
                                    @if ($article->status == 'published')
                                        <span
                                        class="badge-green">@lang('system.form_status_published')</span>@else<span
                                            class="badge-yellow">@lang('system.form_status_draft')</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $article->author->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 space-x-2 text-sm">
                                    <a href="{{ route('officer.informations.edit', $article->id) }}"
                                        class="text-indigo-600">@lang('system.action_edit')</a>
                                    <form
                                        action="{{ route('officer.informations.destroy', $article->id) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('@lang('system.educations_delete_confirm')');">@csrf
                                        @method('DELETE')<button type="submit"
                                            class="text-red-600">@lang('system.action_delete')</button></form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center">@lang('system.educations_not_found')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-6">{{ $articles->links() }}</div>
    </div>
    @push('styles')
        <style>
            .badge-yellow {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800;
            }

            .badge-green {
                @apply px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800;
            }
        </style>
    @endpush
</x-layout>
