@php
    $breadcrumb = [
        ['label' => __('system.breadcrumb_dashboard'), 'url' => route('officer.dashboard.index')],
        ['label' => __('system.breadcrumb_operational'), 'url' => '#'],
        [
            'label' => __('system.breadcrumb_education_management'),
            'url' => route('officer.informations.index'),
        ],
        ['label' => __('system.breadcrumb_add_article'), 'url' => '#'],
    ];
@endphp

<x-layout :breadcrumb="$breadcrumb">
    <x-slot:page_title>@lang('system.educations_create_title')</x-slot>

    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">@lang('system.educations_create_title')</h1>
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

        <form action="{{ route('officer.informations.store') }}" method="POST"
            enctype="multipart/form-data">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700">@lang('system.form_article_title')</label>
                        <input type="text" id="title" name="title"
                            value="{{ old('title') }}" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <label for="content"
                            class="block text-sm font-medium text-gray-700">@lang('system.form_content')</label>
                        <input id="content" type="hidden" name="content"
                            value="{{ old('content') }}">
                        <trix-editor input="content"
                            class="trix-content mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500"></trix-editor>
                    </div>
                </div>
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-medium mb-4">@lang('system.form_metadata')</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="category"
                                    class="block text-sm font-medium text-gray-700">@lang('system.educations_table_category')</label>
                                <select id="category" name="category" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <option value="education" @selected(old('category') == 'education')>
                                        @lang('public.category_education')</option>
                                    <option value="news" @selected(old('category') == 'news')>
                                        @lang('public.category_news')</option>
                                    <option value="announcement" @selected(old('category') == 'announcement')>
                                        @lang('public.category_announcement')</option>
                                </select>
                            </div>
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700">@lang('system.educations_table_status')</label>
                                <select id="status" name="status" required
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                    <option value="published" @selected(old('status') == 'published')>
                                        @lang('system.form_status_published')</option>
                                    <option value="draft" @selected(old('status', 'draft') == 'draft')>
                                        @lang('system.form_status_draft')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h3 class="text-lg font-medium mb-4">@lang('system.form_main_image')</h3>
                        <input type="file" id="image" name="image"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-200 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100">
                    </div>
                </div>
            </div>
            <div class="mt-8 flex items-center gap-4">
                {{-- Tombol dengan sudut standar (bukan rounded-lg) --}}
                <button type="submit"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 font-medium">@lang('system.btn_save_article')</button>
                <a href="{{ route('officer.informations.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-medium">@lang('system.btn_cancel')</a>
            </div>
        </form>
    </div>
    @push('styles')
        <style>
            .trix-content {
                min-height: 20rem;
                background-color: #fff
            }

            .trix-button-group {
                border-color: #d1d5db
            }

            .trix-toolbar {
                background-color: #f9fafb;
                border-bottom: 1px solid #d1d5db
            }
        </style>
    @endpush
</x-layout>
